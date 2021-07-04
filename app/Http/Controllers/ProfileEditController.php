<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use app\Http\Models\User;

class profileEditController extends Controller
{
    protected function profileEditAction(Request $request){

        //ユーザーのログイン状況を確認。
        log::debug('ログインユーザーのID情報を取得します。');
        if(!Auth::check()){
            //セッション内処理に「ログインしてください」と入力する。
            //ログインしていなかった場合ルーティング内のname(‘login’)を通してログインページに返す処理を走らせる。
            return redirect('home');
        }

        // プロフィール編集ページ内でキャンセル・変更どちらを押したかを$requestの各name属性を確認。処理の分岐を行う。
        if ($request->get('cancel-button')){
            log::debug('プロフィールの変更をキャンセルしました');
            //フラッシュ用セッションに「プロフィールの変更をキャンセルしました」と記入する。
            return redirect('/myPage/'.Auth::id());
        }elseif ($request->get('update-button')){
            log::debug('送信情報のバリテーションを開始します。');
            //バリテーション
            $request->validate([
                'age' => 'integer|nullable|max:255',
                'tel' => 'integer|nullable|max:255',
                'profImg' => 'nullable|max:255',
                'zip' => 'integer|nullable|max:255',
                'addr' => 'nullable|max:255',
            ]);
            log::debug('ユーザー登録を開始します。');
            // ログイン中のユーザーのID情報を元に一般会員情報を取得・更新。
            $Users = User::find(Auth::id())->general_prof()->where('age','tel','profImg','zip','addr')->get();
            $Users->fill($request->all())->save();
            //フラッシュ用セッションに「プロフィールを変更しました」と入力する。
            return redirect('/myPage/'.Auth::id());
        }

    }
}
