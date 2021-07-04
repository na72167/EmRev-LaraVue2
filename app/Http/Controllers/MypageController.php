<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class MyPageController extends Controller
{

    // 後から使う

    // ログイン情報の確認
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function myPage(Request $t)
    {
    }
}
