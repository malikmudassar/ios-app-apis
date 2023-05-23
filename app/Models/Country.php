<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';
    public $timestamps = true;
    protected $fillable = [
        'country_id',
        'country',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'country_id',
    ];
}
?>
