<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('site_name');
            $table->text('about_us');
            $table->text('goal');
            $table->text('our_services_sub_title');
            $table->text('commercial_issues_sub_title');
            $table->text('our_team_sub_title');
            $table->text('our_clients_sub_title');
            $table->text('faq_sub_title');
            $table->text('blog_sub_title');
            $table->smallInteger('expert_laywers');
            $table->smallInteger('closed_cases');
            $table->smallInteger('successful_casses');
            $table->smallInteger('trusted_client');
            $table->text('phone');
            $table->text('email');
            $table->text('twitter');
            $table->text('linkedin');
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
        Schema::dropIfExists('settings');
    }
}
