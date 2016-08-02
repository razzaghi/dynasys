<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'provider';
    
    protected $fillable = ['Name'];
    

    public static function boot()
    {
        parent::boot();

        Provider::observe(new UserActionsObserver);
    }
    
    
    
    
}