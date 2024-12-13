<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAdmin extends Model
{
    
    protected $fillable = [
        'email_admin'
    ];

    use HasFactory;
}
