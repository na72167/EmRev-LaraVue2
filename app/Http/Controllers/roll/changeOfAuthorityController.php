<?php

namespace App\Http\Controllers\roll;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class changeOfAuthorityController extends Controller
{
    // 投稿者登録処理
    protected function contributorRegistration(Request $request)
    {
        Log::debug("対象ユーザーに投稿者権限の付与します");
        Log::debug($request);
        $UpdateUser = User::where('email',$request['email'])->update(['roll' => 50]);
        Log::debug($UpdateUser);
        if($UpdateUser){
            Log::debug("投稿者権限の付与に成功しました");
            return response()->json($UpdateUser,201);
        }else if(!$UpdateUser){
            Log::debug("投稿者権限の付与に失敗しました");
            return false;
        }
    }
}
