<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortner extends Model
{
    use HasFactory;
    protected $table = 'url_shortners';
    protected $fillable = [
        'url',
        'short_code',
        'user_id',
        'hits',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
