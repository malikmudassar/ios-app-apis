<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCategory extends Model
{
    use HasFactory;
    protected $table = 'profile_categories';
    protected $fillable = [
        'id',
        'enc_id',
        'category_name',
        'page',
        'parent_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

/*
    public function Category_Question()
    {
        return $this->hasMany(Category_Question::class, 'category_id');
    }
*/
    
}
