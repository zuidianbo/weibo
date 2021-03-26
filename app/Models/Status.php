<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
//微博模型中，指明一条微博属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    指定可使用的字段
    protected $fillable = ['content'];

}
