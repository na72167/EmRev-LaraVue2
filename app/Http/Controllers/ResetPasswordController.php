<?php

namespace App\Http\Controllers;

use \DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use app\Http\Models\User;

class ResetPasswordController extends Controller
{

    protected function resetPassword(Request $request)
    {
        Log::debug('パスワードリセット処理を行います。');
        $userProp = User::where('email',$request['email'])->where('deleted_at',null);
        if($userProp){
            Log::debug('メールアドレスが合致しました。');
            //認証用トークンの生成
            $access_token = Str::random(32);
            //メール送信情報
            //メールを送信
            $from = 'kaifayongakaunto@gmail.com';
            $to = $request['email'];
            $subject = '【パスワード再発行認証】｜Em_Rev-LaraVer-';
            //EOTはEndOfFileの略。ABCでもなんでもいい。先頭の<<<の後の文字列と合わせること。最後のEOTの前後に空白など何も入れてはいけない。
            //EOT内の半角空白も全てそのまま半角空白として扱われるのでインデントはしないこと
            $comment = <<<EOT
            本メールアドレス宛にパスワード再発行のご依頼がありました。
            下記のURLにて認証キーをご入力頂くとパスワードが再発行されます。

            パスワード再発行認証キー入力ページ：
            認証キー：{$access_token}
            ※認証キーの有効期限は30分となります

            認証キーを再発行されたい場合は下記ページより再度再発行をお願い致します。
            //URL記入
            EOT;

            //メール送信
            $sendMailResult = $this->sendMail($from, $to, $subject, $comment,$access_token);
            if($sendMailResult === true){
                return view('/password/passRemindReceive');
            }elseif($sendMailResult === false){
                // フラッシュメッセージに「メールを送信する事が出来ませんでした。」と表示
                return view('/password/passwordReminder');
            }
        }else{
            Log::debug('メールアドレスが合致しませんでした。');
        }
    }

    // メール送信処理
    protected function sendMail($from, $to, $subject, $comment,$access_token){
        //送信に必要な情報が一通り揃っているか
        if(!empty($to) && !empty($subject) && !empty($comment)){
            //文字化けしないように設定（お決まりパターン）
            mb_language("Japanese"); //現在使っている言語を設定する
            mb_internal_encoding("UTF-8"); //内部の日本語をどうエンコーディング（機械が分かる言葉へ変換）するかを設定

            //メールを送信（送信結果はtrueかfalseで返ってくる）
            $result = mb_send_mail($to, $subject, $comment, "From: ".$from);
            // 送信結果を判定
            // https://teratail.com/questions/80310
            if ($result === true) {
                Log::debug('メールを送信しました。');
                // Eloquentのメソッド saveとupdateは処理が異なる
                // https://qiita.com/gomaaa/items/91e5cbd319279a2db6ec
                //特定のusersレコードの認証キー情報を更新する。
                $UpdateUser = new User;
                $UpdateUser = User::where('email',$to)->where('deleted_at',null)->firstOrFail();
                $UpdateUser->emailToken = $access_token;
                $DateTime = new DateTime(date("Y-m-d H:i:s"));
                $UpdateUser->auth_key_limit = $DateTime->modify('+30 minutes'); //現在時刻より30分後のUNIXタイムスタンプを入れる
                $UpdateUser->update();
                return true;
            }elseif($result === false){
                Log::debug('【エラー発生】メールの送信に失敗しました。');
                //セッション内に「メールの送信に失敗しました。」と挿入する。
                return false;
            }
        }
    }
}
