<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('ringkasan');
            $table->text('isi');
            $table->unsignedBigInteger('id_wartawan');
            $table->timestamps();

            $table->foreign('id_wartawan')->references('id')->on('wartawan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
