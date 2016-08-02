<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateServiceProviderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('serviceprovider',function(Blueprint $table){
            $table->increments("id");
            $table->integer("service_id")->references("id")->on("service");
            $table->integer("provider_id")->references("id")->on("provider");
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
        Schema::drop('serviceprovider');
    }

}