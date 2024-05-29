<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File  extends Model
{
    protected $table = 'files'; // モデルが関連付けるテーブルの名前

    protected $fillable = ['name', 'path']; // モデルのfillableプロパティに設定することで、Mass Assignment を有効にする

}
