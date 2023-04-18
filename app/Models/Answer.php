<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'category_answers';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'enc_id',
        'category_id',
        'question_id',
        'answer_statement',
    ];
}
?>
