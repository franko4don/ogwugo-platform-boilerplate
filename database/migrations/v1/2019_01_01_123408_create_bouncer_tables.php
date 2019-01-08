<?php

use Silber\Bouncer\Database\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouncerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Models::table('abilities'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->uuid('entity_id')->nullable();
            $table->uuid('organization_id')->nullable();
            $table->string('entity_type')->nullable();
            $table->boolean('only_owned')->default(false);
            $table->json('options')->nullable();
            $table->uuid('scope')->nullable()->index();
            $table->timestamps();
        });

        Schema::create(Models::table('roles'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->integer('level')->unsigned()->nullable();
            $table->integer('scope')->nullable()->index();
            $table->timestamps();

            $table->unique(
                ['name', 'scope'],
                'roles_name_unique'
            );
        });

        Schema::create(Models::table('assigned_roles'), function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->index();
            $table->uuid('entity_id');
            $table->string('entity_type');
            $table->integer('restricted_to_id')->unsigned()->nullable();
            $table->string('restricted_to_type')->nullable();
            $table->integer('scope')->nullable()->index();

            $table->index(
                ['entity_id', 'entity_type', 'scope'],
                'assigned_roles_entity_index'
            );

            $table->foreign('role_id')
                  ->references('id')->on(Models::table('roles'))
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create(Models::table('permissions'), function (Blueprint $table) {
            $table->integer('ability_id')->unsigned()->index();
            $table->uuid('entity_id');
            $table->uuid('organization_id');
            $table->string('entity_type');
            $table->boolean('forbidden')->default(false);
            $table->uuid('scope')->nullable()->index();

            $table->index(
                ['entity_id', 'entity_type', 'scope', 'organization_id'],
                'permissions_entity_index'
            );

            $table->foreign('ability_id')
                  ->references('id')->on(Models::table('abilities'))
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Models::table('permissions'));
        Schema::drop(Models::table('assigned_roles'));
        Schema::drop(Models::table('roles'));
        Schema::drop(Models::table('abilities'));
    }
}