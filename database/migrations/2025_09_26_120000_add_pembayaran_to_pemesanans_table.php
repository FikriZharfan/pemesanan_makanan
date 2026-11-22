<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembayaranToPemesanansTable extends Migration
{
    public function up()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            if (!Schema::hasColumn('pemesanans', 'pembayaran')) {
                $table->string('pembayaran')->after('bangku')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('pembayaran');
        });
    }
}
