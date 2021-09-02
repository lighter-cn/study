<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    public function users () {
        return $this->belongsToMany(User::class)
            ->as('prefer') // pivot名のカスタム
            ->withPivot('created_at'); // 中間テーブルのカラム取得
    }
}
