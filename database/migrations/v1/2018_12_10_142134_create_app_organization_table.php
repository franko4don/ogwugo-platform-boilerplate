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
            $table->uuid('app_id');
            $table->uuid('organization_id');
            $table->uuid('subscription_id')->nullable();
            $table->string('custom_subdomain');
            $table->string('secure_custom_subdomain', 100)->unique()->nullable();
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
