<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('kode_member')->unique(); // MEM001, MEM002, dll
            $table->string('nama_member');
            $table->string('no_hp');
            $table->string('email')->unique()->nullable();
            $table->text('alamat');
            $table->enum('jenis_member', ['reguler', 'silver', 'gold', 'platinum'])->default('reguler');
            $table->integer('diskon')->default(0); // Persentase diskon 0-50
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};