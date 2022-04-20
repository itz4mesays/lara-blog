<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->index('id');
            $table->string('name')->unique();
            $table->string('email', 65)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 75);
            $table->smallInteger('status')->default(1);
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
        Schema::table('users', function(Blueprint $table){
            $table->dropIndex(['id']);
        });
        Schema::dropIfExists('users');
    }
};
