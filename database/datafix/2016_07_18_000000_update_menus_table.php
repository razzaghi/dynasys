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
                'name'      => 'BaseInformation',
                'title'     => 'Base Information',
                'menu_type' => 2,
                'icon'      => 'fa-database',
                'parent_id' => NULL,
            ],
            [
                'id'        => 4,
                'position'  => 0,
                'name'      => 'Provider',
                'title'     => 'Provider',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => 3,
            ],
            [
                'id'        => 5,
                'position'  => 1,
                'name'      => 'Category',
                'title'     => 'Category',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => 3,
            ],
            [
                'id'        => 6,
                'position'  => 2,
                'name'      => 'Service',
                'title'     => 'Service',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => 3,
            ],
            [
                'id'        => 7,
                'position'  => 3,
                'name'      => 'Field',
                'title'     => 'Field',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => 3,
            ],
            [
                'id'        => 8,
                'position'  => 3,
                'name'      => 'ServiceProvider',
                'title'     => 'ServiceProvider',
                'menu_type' => 1,
                'icon'      => 'fa-database',
                'parent_id' => 3,
            ]
        ]);
    }
}
