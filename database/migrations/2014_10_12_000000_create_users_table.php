<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('efaas_id');
            $table->string('name');
            $table->string('given_name');
            $table->string('family_name');
            $table->string('middle_name')->nullable();
            $table->string('gender');
            $table->string('idnumber')->unique();
            $table->string('email')->unique();
            $table->bigInteger('phone_number');
            $table->json('address');
            $table->string('fname_dhivehi');
            $table->string('mname_dhivehi')->nullable();
            $table->string('lname_dhivehi');
            $table->tinyInteger('user_type');
            $table->bigInteger('verification_level');
            $table->integer('user_state');
            $table->date('birthdate');
            $table->string('passport_number');
            $table->string('is_workpermit_active');
            $table->datetime('efaas_updated_at');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
