<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function authorUser()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'author');
    }
}