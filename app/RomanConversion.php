<?php

namespace RomanAPI;

use Illuminate\Database\Eloquent\Model;

class RomanConversion extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roman_conversion';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'integer', 'roman', 'count',
    ];

    public $timestamps = true;
}
