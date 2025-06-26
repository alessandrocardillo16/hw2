<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'article_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
?>