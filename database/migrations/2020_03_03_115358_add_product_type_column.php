<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('mtn_momo_tokens', function (Blueprint $table) {
            $config = Container::getInstance()->make(Repository::class);
            $table->enum('product_type',['collection','disbursement','remittance'])->default($config->get('mtn-momo.product','collection'))->nullable
            (false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mtn_momo_tokens', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
}
