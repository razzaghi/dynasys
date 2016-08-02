<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'service';
    
    protected $fillable = [
          'Name',
          'Image',
          'Description',
          'category_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        Service::observe(new UserActionsObserver);
    }
    
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }


    
    
    
}