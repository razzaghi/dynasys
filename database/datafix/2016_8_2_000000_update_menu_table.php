<?php

use Illuminate\Database\Migrations\Migration;
use Laraveldaily\Quickadmin\Models\Menu;

class UpdateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Menu::insert([
            [
                'id'        => 3,
                'position'  => 0,
                'name'      => 'Provider',
                'title'     => 'Provider',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => NULL,
            ],
            [
                'id'        => 4,
                'position'  => 1,
                'name'      => 'Category',
                'title'     => 'Category',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => NULL,
            ],

        ]);
    }
}
