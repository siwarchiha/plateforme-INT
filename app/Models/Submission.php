<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submission extends Model
{
    use HasFactory;
    protected $fillable = [
        //'form_id',
       // 'user_id',
        'formJson',
        
    ];
}
