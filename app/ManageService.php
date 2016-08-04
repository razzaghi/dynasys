<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class ManageService extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'manageservice';
    
    protected $fillable = [
          'service_id',
          'field_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        ManageService::observe(new UserActionsObserver);
    }
    
    public function service()
    {
        return $this->hasOne('App\Service', 'id', 'service_id');
    }


    public function field()
    {
        return $this->hasOne('App\Field', 'id', 'field_id');
    }


    
    
    
}