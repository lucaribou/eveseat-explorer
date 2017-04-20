<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateExplorerTables extends Migration
{
	public function up()
	{
		Schema::create('explorer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id', 300);
            $table->string('secret_key', 300);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('explorer_settings');
	}
}
