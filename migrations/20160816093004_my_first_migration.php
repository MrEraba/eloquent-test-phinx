<?php

use \MyProject\Migration\Migration;
//use Illuminate\Database\Migrations\Migration;

class MyFirstMigration extends Migration
{
    public function up()
    {
        $this->schema->create('users', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- userType [admin | masajista]
            $table->enum('user_type', array('admin', 'massagist'));
            //- name
            $table->string('name');
            //- surnames
            $table->string('surnames');
            //- password*
            $table->string('password');
            //- color
            $table->string('color');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('tokens', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- token
            $table->string('token',100);
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('emails', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- email
            $table->string('email');
            $table->unique('email');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('addresses', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- direccion
            $table->string('address');
            //- main (bool)
            $table->boolean('main_address');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('phones', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- number
            $table->string('number');
            //- type [home | cellphone]
            $table->enum('type', array('phone', 'cellphone'));
            //- main
            $table->boolean('main');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('social', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- application
            $table->string('application');
            //- uri
            $table->string('uri');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('roles', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- name
            $table->string('name');
            //- description
            $table->string('description');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('callendars', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- start day
            $table->date('start');
            //- end day
            $table->date('end');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('days', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- name
            $table->enum('day_name', array('sunday','monday','tuesday','wednesday','thursday','friday','saturday'));
            //- callendar_id
            $table->integer('callendar_id')->unsigned();
            $table->foreign('callendar_id')->references('id')->on('callendars')->onDelete('cascade');
            // time stamps
            $table->timestamps();
        });

        $this->schema->create('hours', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            //- role_id
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            //- user_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //- day
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('users')->onDelete('cascade');
            //- hour
            $table->integer('hour');
            // time stamps
            $table->timestamps();
        });
    }
    public function down()
    {
        $this->schema->drop('users');
        $this->schema->drop('tokens');
        $this->schema->drop('emails');
        $this->schema->drop('addresses');
        $this->schema->drop('phones');
        $this->schema->drop('social');
        $this->schema->drop('roles');
        $this->schema->drop('callendars');
        $this->schema->drop('days');
        $this->schema->drop('hours');
    }
}
