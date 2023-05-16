<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;
    protected $table = 'user_verification';
    public $timestamps = true;
    protected $fillable = [
        'method',
        'image',
        'user_id',
        'verified_at',
        'verified_by',
    ];
}
