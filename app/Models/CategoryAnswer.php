<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAnswer extends Model
{
    use HasFactory;
    protected $table = 'category_answers';
    protected $fillable = [
        'id',
        'category_id',
        'question_id',
        'answer_statement',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

/*
    public function Category_Question()
    {
        return $this->belongsTo(Category_Question::class, 'question_id');
    }
*/
}
