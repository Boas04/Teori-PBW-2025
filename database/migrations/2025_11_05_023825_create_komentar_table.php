<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->string('pengunjung');
            $table->text('isi');
            $table->unsignedBigInteger('id_berita');
            $table->timestamps();

            $table->foreign('id_berita')->references('id')->on('news')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
