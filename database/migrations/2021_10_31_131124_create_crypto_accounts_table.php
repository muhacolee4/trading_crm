<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
class CreateCryptoAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(User::class);
            $table->float('btc', 8, 2);
            $table->float('eth', 8, 2);
            $table->float('ltc', 8, 2);
            $table->float('xrp', 8, 2);
            $table->float('link', 8, 2);
            $table->float('bat', 8, 2);
            $table->float('aave', 8, 2);
            $table->float('usdt', 8, 2);
            $table->float('xlm', 8, 2);
            $table->float('bch', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_accounts');
    }
}
