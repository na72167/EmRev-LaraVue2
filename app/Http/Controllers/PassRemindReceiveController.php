<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use app\Http\Models\User;

class PassRemindReceiveController extends Controller
{
    protected function passRemindReceive(Request $request){
        // ResetPasswordControllerから取得
        log::debug('送信されたEmail情報・token情報を確認します');
        $ReceiveUser = new User;
        $ReceiveUser->where('email',$request['email'])->where('emailToken',$request['token'])->where('deleted_at',null)->first();
        if($ReceiveUser == false){
            //フラッシュメッセージで「送信Emailもしくは認証コードに該当するユーザーは存在しませんでした」と表示。
            log::debug('送信Emailもしくは認証コードに該当するユーザーは存在しません');
            return view('/password/passRemindReceive');
        }elseif($ReceiveUser == true){
            log::debug('認証メール送信から30分以上経過しているか確認します。');
            $IssetEmailUser = new User;
            $IssetEmailUser->where('email',$request['email'])->where('auth_key_limit','>=',Carbon::now())->where('deleted_at',null)->first();
                if($IssetEmailUser == false){
                    //フラッシュメッセージで「認証メール送信から30分以上経過しています。改めてメールを送信し直して下さい。」と表示。
                    log::debug('認証メール送信から30分以上経過しています。改めてメールを送信し直して下さい。');
                    return view('/password/passwordReminder');
                }elseif($IssetEmailUser == true){
                    $IssetEmailUser->password = $request['password'];
                    $IssetEmailUser->update();
                    //フラッシュメッセージで「パスワードを変更しました。」と表示。
                    log::debug('パスワードを変更しました。');
                    return view('/home');
                }
        }
    }
}
