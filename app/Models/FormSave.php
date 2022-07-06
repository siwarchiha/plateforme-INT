<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSave extends Model
{
    use HasFactory;
    protected $fillable = [
        'formJson',
        'name',
        'visibility',
        'id_fiche'
    ];
}
