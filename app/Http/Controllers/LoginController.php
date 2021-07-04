<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    //useで引っ張ってきたクラスはサービスプロパイダを経由して
    //インスタンス化されている。(型宣言は基本アノテーションを使って行う。)
    //https://qiita.com/yuzgit/items/5df7924d62ba4c788279

    // 【Laravel】DB登録値取得時のfind()、get()、first()の返り値早見表
    // https://qiita.com/sola-msr/items/fac931c72e1c46ae5f0f
    protected function login(Request $request)
    {
        Log::debug('ログイン情報に対してバリテーションを行います。');

        $loginUser = User::where('email',$request['email'])->where('password',$request['password'])->first();

        Log::debug("ログイン結果の内容".$loginUser);
        return response()->json($loginUser,201);
    }
}
