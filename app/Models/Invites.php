<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    use HasFactory;
    protected $table = 'invites';
    public $timestamps = true;
    protected $fillable = [
        'is_accepted',
    ];
    protected $hidden = [
        'to_user',
        'spot_id',
        'from_user',
        'created_at',
        'updated_at',
    ];

    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spot_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

}
