<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model 
{
    use HasFactory;

    protected $fillable = [
        'bcname', 'waktu', 'message', 'image', 'showbutton','namabutton', 'link'
    ];
}
