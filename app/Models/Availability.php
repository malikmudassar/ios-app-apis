<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    protected $table = 'availabilites';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'spot_id',
        'date',
        'time_slot',
    ];
}
