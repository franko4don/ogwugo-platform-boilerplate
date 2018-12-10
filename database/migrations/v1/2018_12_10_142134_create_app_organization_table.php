<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_organization', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->string('custom_subdomain');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('app_organization');
    }
}
