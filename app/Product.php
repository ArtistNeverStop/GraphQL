<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'user_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $queryable = [
        'id', 'name', 'price', 'user_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $alwaysSelect = [
        'id',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo('App\User');
    }
}
