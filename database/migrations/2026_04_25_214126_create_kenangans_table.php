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
       Schema::create('kenangans', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('deskripsi');
    $table->string('foto')->nullable();
    $table->string('nama_teman');
    $table->timestamps(); // ini otomatis created_at & updated_at
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kenangans');
    }
};
