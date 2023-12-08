<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letReadTheBibleVideo extends Model
{
    use HasFactory;
    public $table = 'let_read_the_bible_video';
    public $timestamps = false;


    protected $fillable = [
        'fullname', 'image', 'link', 'biblechapter', 'reg_date'
    ];
}
