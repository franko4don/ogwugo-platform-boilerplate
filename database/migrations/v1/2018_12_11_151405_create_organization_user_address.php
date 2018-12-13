<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationUserAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_user_address', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('address');
            $table->integer('organization_user_id');
            $table->integer('organization_id');
            $table->string('city');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('default')->default(false);
            $table->string('phone')->nullable();
            $table->integer('state_id');
            $table->integer('country_id');
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
        Schema::dropIfExists('organization_user_address');
    }
}
