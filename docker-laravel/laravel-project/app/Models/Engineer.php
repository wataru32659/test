<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    protected $fillable = ['name','age','updated_at ']; 
    /**
     * 一覧画面表示用にEngineersテーブルから全てのデータを取得
     */
    public function findAllEngineers()
    {
        return Engineer::all();
    }

    /**
     * 登録処理
     */
    public function InsertEngineer($request)
    {
        // リクエストデータを基に管理マスターユーザーに登録する
        return $this->create([
            'name' => $request->Engineer_name,
        ]);
    }

    /**
     * 詳細
     */
    public function showengineer($request, $engineer)
    {
        $result = $Engineer->fill([
            'name' => $request->engineer_name
        ])->save();

        return $result;
    }
    /**
     * 更新処理
     */
    public function updateEngineer($request, $engineer)
    {
        $result = $Engineer->fill([
            'name' => $request->engineer_name
        ])->save();

        return $result;
    }
        
    // 年齢での検索
    public static function search($minAge, $maxAge)
    {
        $query = self::query();

        // 年齢の最小値が指定されている場合は条件を追加
        if ($minAge !== null) {
        $query->where('age', '>=', $minAge);
        }

        // 年齢の最大値が指定されている場合は条件を追加
        if ($maxAge !== null) {
            $query->where('age', '<=', $maxAge);
        }

        // 検索を実行して結果を返す
        return $query->get();
    }

        
        public function file()
        {
            return $this->hasOne(File::class);
        }
}
