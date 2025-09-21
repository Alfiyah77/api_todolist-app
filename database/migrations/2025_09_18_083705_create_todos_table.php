<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');// Tanbahka ini
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['selesai','belum selesai'])->default(value:'belum selesai');
            $table->timestamps();

            $table->foreign('pengguna_id')
                  ->references('id')
                  ->on(table:'penggunas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
