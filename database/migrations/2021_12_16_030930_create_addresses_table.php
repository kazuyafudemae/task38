<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (Schema::hasTable('addresses')) {
			// テーブルが存在していればリターン
			return;
		}
        Schema::create('addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->nullable()->change();
			$table->string('name');
			$table->integer('first_code');
			$table->integer('last_code');
			$table->string('state');
			$table->string('city');
			$table->string('street');
			$table->string('tel');
			$table->softDeletes();
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
        Schema::dropIfExists('addresses');
    }
}
