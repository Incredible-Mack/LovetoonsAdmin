<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biblevideo extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'name','email','links','reg_date','status','deleteStatus'

    ];
}
