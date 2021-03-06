<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('password',200);
            $table->string('remember_token',200)->nullable();
            $table->boolean('admin')->nullable();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('content');
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('slug',100);
            $table->text('body');
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip',100);
            $table->dateTime('date_access',6);
            $table->string('page',100);
        });   

        DB::table('users')->insert([
            'name' =>'admin',
            'email' =>'admin@admin.com',
            'password'=>Hash::make('1234'),
            'remember_token'=>'',
            'admin'=>1,
        ]);

        DB::table('users')->insert([
            'name' =>'user',
            'email' =>'user@user.com',
            'password'=>Hash::make('1234'),
            'remember_token'=>'',
            'admin'=>0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('visitors');
    }
}
