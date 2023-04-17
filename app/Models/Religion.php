<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    protected $table = 'religion';
    public $timestamps = true;
    protected $fillable = [
        'religion_id',
        'religion',
    ];
}
?>
