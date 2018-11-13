<?php

namespace Modules\Currency\Entities;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
    	'slug', 'decimals', 'code', 'symbol', 'decimal_point', 'thousands_sep'
    ];
}
