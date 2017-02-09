<?php

use App\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	public function up()
	{
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type')->default('patient');;
            $table->timestamps();
            $table->rememberToken();
        });

        $this->addAdmin();
        $this->addOperator();
        $this->addPatient();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

	private function addAdmin()
    {
        User::create([
            "email" => "admin@domain.com",
            "name" => "root admin",
            "password" => bcrypt("admin"),
            "type" => "admin",
        ]);
    }

    private function addOperator()
    {
        User::create([
            "email" => "operator@domain.com",
            "name" => "operator",
            "password" => bcrypt("operator"),
            "type" => "operator",
        ]);
    }

    private function addPatient()
    {
        User::create([
            "email" => "patient@domain.com",
            "name" => "patient",
            "password" => bcrypt("patient"),
            "type" => "patient",
        ]);
    }

}
