<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->date('tanggal_masuk');
            $table->date('tanggal_ambil')->nullable();
            $table->decimal('sub_total', 12, 2);
            $table->integer('diskon')->default(0);
            $table->decimal('total', 12, 2);
            $table->enum('status', ['baru', 'proses', 'selesai'])->default('baru');
            $table->enum('jenis_pembayaran', ['tunai', 'transfer', 'debit', 'kredit'])->nullable();
            $table->enum('status_bayar', ['lunas', 'belum'])->default('belum');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};