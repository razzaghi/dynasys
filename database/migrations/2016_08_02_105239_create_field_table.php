<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateFieldTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('field',function(Blueprint $table){
            $table->increments("id");
            $table->string("Name");
            $table->integer("category_id")->references("id")->on("category");
            $table->text("Description")->nullable();
            $table->tinyInteger("IsInFiltering")->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('field');
    }

}