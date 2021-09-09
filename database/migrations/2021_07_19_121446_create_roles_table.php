<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rolename');
            $table->foreignId('client_id')->onDelete('cascade');
            $table->string('status')->comment('0-Pending,1-Active,2-Inactive,3-Deleted');
            $table->integer('deleted_by');
            $table->softDeletesTz('deleted_at');
            $table->unique('rolename', 'client_id');
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
        Schema::dropIfExists('roles');
    }
}
