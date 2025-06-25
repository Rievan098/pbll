<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang'); // Nama barang
            $table->integer('stok')->default(0); // Stok barang
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs'); // Drop tabel jika rollback
    }
}
