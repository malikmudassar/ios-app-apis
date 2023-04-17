<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'profile_categories';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'page',
        'category_name',
    ];
}
?>
