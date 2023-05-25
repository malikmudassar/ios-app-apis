<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;
    protected $table = 'spots';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function invites()
    {
        return $this->hasMany(Invites::class, 'spot_id');
    }
}
