<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'information';
    protected $fillable = [
        'info_id',
        'info_content',
        'question_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
