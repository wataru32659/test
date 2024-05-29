<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Engineer;
use App\Models\File;

class EngineerController extends Controller
{
    public function index(Request $request)
    {
        $engineers = Engineer::where('delete_flg', 0)->simplePaginate(30);
        
        return view ('engineer.index',['engineers'=>$engineers]);

    }

    public function search(Request $request)
    {
        $maxAge = $request->input('ageMax');
        $minAge = $request->input('ageMin');
        $name = $request->input('name');
    
        // クエリの初期化
        $query = Engineer::query();
    
        if ($name !== null && $name !== '') {
            $query->where(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%");
            });
        }
    
        // 年齢の検索条件を追加
        if ($maxAge !== null) {
            $query->where('age', '<=', $maxAge);
        }
    
        if ($minAge !== null) {
            $query->where('age', '>=', $minAge);
        }
    
        // 検索を実行して結果を取得
        $engineers = $query->get();
    
        // ビューにデータを渡してエンジニア一覧を表示
        return view('engineer.index', compact('engineers'));
    }
    
    public function show(Engineer $engineer)
    {
        return view('engineer.show', ['engineer' => $engineer]);
    }

    public function edit(Engineer $engineer)
    {
        return view('engineer.edit', compact('engineer'));
    }

    public function update(Request $request, Engineer $engineer)
    {
        // エンジニアの情報を更新
        $engineer->update([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
        ]);
    
        // ファイルがアップロードされている場合の処理
        if ($request->hasFile('file')) {
            // エンジニアごとのフォルダを作成
            $engineerFolderPath = 'public/skillsheet/' . $engineer->id;
            Storage::makeDirectory($engineerFolderPath);
    
            // ファイルを保存
            $file = $request->file('file');
            $path = $file->store($engineerFolderPath);
    
            // 既存のファイルがあれば更新し、なければ新規作成する
            if ($engineer->file) {
                // 古いファイルを削除
                Storage::delete($engineer->file->path);
                // 既存のファイルを更新
                $engineer->file->update([
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            } else {
                // 新しいファイルを関連付けて保存
                $fileModel = new File;
                $fileModel->engineer_id = $engineer->id;
                $fileModel->name = $file->getClientOriginalName();
                $fileModel->path = $path;
                $fileModel->save();
            }
    
            // ファイルの保存が成功したら成功メッセージをセッションに格納する
            session()->flash('success', 'ファイルがアップロードされました。');
        }
    
        // インデックスページにリダイレクトする
        return redirect()->route('engineer.index')->with('success', 'エンジニア情報が更新されました');
    }

    public function updateFlag(Engineer $engineer)
    {
        $engineer->delete_flg = 1;
        $engineer->save();
    
        return redirect()->route('engineer.index')->with('success', 'エンジニアが削除されました');
    }

    // エンジニア登録フォームを表示するメソッド
    public function create()
    {
        return view('engineer.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        $engineer = new Engineer;
        $engineer->name = $validatedData['name'];
        $engineer->age = $validatedData['age'];
        $engineer->save();

        return redirect()->route('engineer.index')->with('success', 'エンジニアが登録されました！');
    }

    /*
    public function upload(Request $request)
    {
        // バリデーションなどの必要な処理を追加

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // ファイルを保存する処理
            $path = $file->store('storage/app/public/skillsheet');

            // ファイルの保存が成功したら成功メッセージを返す
            return back()->with('success', 'ファイルがアップロードされました。');
        }

        // ファイルがアップロードされていない場合はエラーメッセージを返す
        return back()->with('error', 'ファイルが選択されていません。');
    }
    */
}
