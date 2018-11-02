<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    // 关闭Eloquent默认的 updated_at、created_at 两个字段
    public $timestamps = false;
}
