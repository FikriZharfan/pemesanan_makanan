<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriToProduksTable extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('kategori')->default('makanan_berat');
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
}
