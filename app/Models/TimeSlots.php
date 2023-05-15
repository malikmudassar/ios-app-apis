<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;
    protected $table = 'availabilities_timeslots';
    protected $fillable = [
        'id',
        'name',
        'from_time',
        'to_time',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
?>
