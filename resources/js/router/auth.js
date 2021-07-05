import Cookies from "js-cookie";
// import Dayjs from "dayjs";
import router from "@/router/index";
import store from "@/store/index";
// import {AUTH_ROUTER_NUM} from "./utils/auth_route_num"

// ゲスト判定かログイン判定か
const AuthFilter = () => {

  // let isEmail = Cookies.get('email');
  // let isPublic = Cookies.get('user_id');
  // let isRoll = Cookies.get('roll');
  // let isLoginData = Cookies.get('login_date');
  // let isLoginLimit = Cookies.get('login_limit');

  // JavaScriptで値が数値かどうかチェックする：isNaN()
  // https://uxmilk.jp/46961
  // JavaScriptにおける配列の空要素除去filterパターン
  // https://qiita.com/akameco/items/1636e0448e81e17e3646
  // .fillter(Boolean)が上手く動作しないので、上の変数の配列管理は後回しにする。

  // ユーザー認証チェック
  // if (isPublic) {
  //   console.log('ログイン済みユーザーです。');
  //   console.log(isPublic);

  //   if(isLoginLimit < Dayjs()){
  //     console.log('ログイン有効期限外です。');
      // TODO:フラッシュメッセージで「ログイン有効期限外です。再度ログインし直して下さい。」と表示。
      // TODO:配列で纏める。https://webrandum.net/js-cookie/
      // userStateの更新

    //   Cookies.remove('email');
    //   Cookies.remove('user_id');
    //   Cookies.remove('roll');
    //   Cookies.remove('login_date');
    //   Cookies.remove('login_limit');
    //   store.dispatch("users/setLoginUserInfo");
    //   router.push('/', () => {});
    // }else if(isLoginLimit > Dayjs()){
    //   console.log('ログイン有効期限内です。');
    //   console.log(isLoginLimit);
      // Cookies.set('login_date',Dayjs(),{expires: AUTH_ROUTER_NUM.LOGON_LIMIT});
      // Cookies.set('login_limit',Dayjs()+AUTH_ROUTER_NUM.SES_LIMIT, {expires: AUTH_ROUTER_NUM.LOGON_LIMIT});
      //userState情報の再挿入(ページ遷移ごとに再挿入させる事でvuex内のuserStateを永続化させている。)
      store.dispatch("users/setLoginUserInfo");
      store.dispatch("header/setHeaderMenuLoggedIn");

    // }
  // }else if(!isPublic){
  //   //TODO:フラッシュメッセージで「ログイン情報がありません。ホームに戻ります。」と表示。
  //   console.log('ログイン情報がありません。');
  //   store.dispatch("users/setLoginUserInfo");
  //   router.push('/', () => {});
  // }

};

export { AuthFilter };
