<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Blog extends Model implements Likeable
{
    use HasFactory;
    use Likes;
    use Commentable;

    protected $fillable = [
        'title',
        'beschrijving',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
