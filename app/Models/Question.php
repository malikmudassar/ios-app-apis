<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'category__questions';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'enc_id',
        'category_id',
        'question',
        'upto',
        'sortOrder',
        'addButton',
    ];
}
?>
