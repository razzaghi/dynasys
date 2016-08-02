<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'serviceprovider';
    
    protected $fillable = [
          'service_id',
          'provider_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        ServiceProvider::observe(new UserActionsObserver);
    }
    
    public function service()
    {
        return $this->hasOne('App\Service', 'id', 'service_id');
    }


    public function provider()
    {
        return $this->hasOne('App\Provider', 'id', 'provider_id');
    }


    
    
    
}