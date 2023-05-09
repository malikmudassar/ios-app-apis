<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Question extends Model
{
    use HasFactory;
    protected $table = 'category__questions';
    protected $fillable = [
        'id',
        'category_id',
        'question',
        'upto',
        'sortOrder',
        'has_info',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /*
    public function ProfileCategory()
    {
        return $this->belongsTo(ProfileCategory::class, 'category_id');
    }

    public function CategoryAnswer()
    {
        return $this->hasMany(CategoryAnswer::class, 'question_id');
    }
    */
    
}
