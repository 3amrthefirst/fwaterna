<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
			$table->increments('id');
			$table->string('path');
			$table->enum('type', array('image', 'video', 'doc'));
			$table->string('usage')->nullable();
			$table->string('attachmentable_type');
			$table->integer('attachmentable_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('attachments');
	}
}