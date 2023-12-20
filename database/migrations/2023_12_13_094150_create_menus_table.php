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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);     // メニュー名
            $table->double('weight')->unsigned();       // 重さ kg
            $table->foreignId('part_id')->constrained()->onDelete('cascade');       // ユーザID
            $table->foreignId('user_id')->constrained()->onDelete('cascade');       // ユーザID
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
        Schema::dropIfExists('menus');
    }
};
