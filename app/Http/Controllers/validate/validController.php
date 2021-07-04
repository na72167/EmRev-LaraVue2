<?php

namespace App\Http\Controllers\Validate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class validController extends Controller
{
  protected function emailDup(Request $request)
  {

    Log::debug('Emailの重複検索を行います。');
    Log::debug('Requestの内容'.$request);
    $result = User::where('email',$request['email'])->first();

    Log::debug('検索結果'.$result);

    if($result){
      Log::debug('メールアドレスが一致しました。');
      return false;
    }else if(!$result){
      Log::debug('メールアドレスが一致しませんでした。');
      return response()->json(true,201);
    }
  }
}
