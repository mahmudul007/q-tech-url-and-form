<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $fillable =
        [
        'category_id',
        'user_id',
        'title',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function formOwner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function FormFieldSubmissions()
    {
        return $this->hasMany(FormField::class, 'form_id', 'id');
    }
}
