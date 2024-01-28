<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'lmspayment';
    protected $fillable = [
        'userID',
        
    ];
    public $timestamps = false;
}
