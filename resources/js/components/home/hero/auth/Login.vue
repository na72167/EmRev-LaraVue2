<template>
    <!-- ログイン関係 -->
  <div class="login js-login-style hidden">
    <form class="login-formStyle" @submit.prevent="login">
      <h2 class="login-title">Login</h2>
      <div class="login-commonMsgArea">
        <span class="#">
          <strong>{{ commonErrMsg }}</strong>
        </span>
      </div>

      <!-- メールアドレス入力欄 -->
      <div class="login-emailaddressField">
        <label class="#">
          <input class="login-emailForm" :class="{ errInput: emailErrMsg }" type="text" placeholder="Email" v-model="email">
          <div class="login-areaMsg">
            <span class="#">
                <strong>{{ emailErrMsg }}</strong>
            </span>
          </div>
        </label>
      </div>

      <!-- パスワード入力 -->
      <div class="login-passwardField">
        <label class="#">
          <!-- 後にphpでエラー時用のスタイルを付属させる様にする。 -->
          <input class="login-passwordForm" :class="{ errInput: passwordErrMsg }" type="password" placeholder="Password" v-model="password">
          <div class="login-areaMsg">
            <!-- エラーメッセージの出力 -->
            <span class="#">
              <strong>{{ passwordErrMsg }}</strong>
            </span>
          </div>
        </label>
      </div>

      <div class="login-registerBtnField">
        <button class="login-registerBtnField"
          type="submit"
          :disabled="isSubmit">
        {{ signUpButton }}
        </button>
      </div>
    </form>
  </div>
</template>

<script lang="ts" scoped>
import { Component, Vue } from 'vue-property-decorator';
import { emailErrMsg,passwordErrMsg,commonErrMsg,SignUpFormErrMsg,PasswordFormErrMsg,CommonErrMsg,RegistUser,signUpButton } from '@/utils/signUp';
import { SIGNUP_NUM } from '@/utils/auth-mapping';
import { validEmail,validHalfNumAlp,validMaxLen,validMinLen,validEmailDup } from '@/utils/validate';
import Cookies from "js-cookie";
import axios from "axios";

@Component
export default class Login extends Vue {
  public email = '';
  public password = '';

  public emailErrMsg = '';
  public passwordErrMsg = '';
  public commonErrMsg: commonErrMsg = '';

  public isSubmit: boolean = false;
  public signUpButton: signUpButton = '登録する';
  private loginUser = {
    data:{
      id: '',
      email: '',
      roll: '',
    }
  };
  private sesLimit: SIGNUP_NUM.SES_LIMIT;

  private async login() {
      //Emailのバリデーション
    if (!this.email) {
      //空かどうかのバリテーション
      console.log("(login)メールアドレスの入力がありません");
      this.emailErrMsg = SignUpFormErrMsg.emailErrMsgEmpty
    } else if(!validEmail(this.email)){
      // メールアドレスの形式確認
      console.log("(login)メールアドレスの形式が正しくありません");
      this.emailErrMsg = SignUpFormErrMsg.emailErrMsgEmailFormat
    } else if(validHalfNumAlp(this.email)){
      //半角英数字のバリテーション
      console.log("(login)メールアドレスを半角英数で入力してください");
      this.emailErrMsg = SignUpFormErrMsg.emailErrMsgHalfNumAlp
    } else if(validMaxLen(this.email,SIGNUP_NUM.SIGNUP_EMAIL_MAXLEN)){
      //最大文字数のバリテーション
      console.log("(login)メールアドレスを20文字以内にしてください");
      this.emailErrMsg = SignUpFormErrMsg.emailErrMsgMaxLen
    } else if(validMinLen(this.email,SIGNUP_NUM.SIGNUP_EMAIL_MINLEN)){
      //最小文字数のバリテーション
      console.log("(login)メールアドレスは4文字以上にしてください");
      this.emailErrMsg = SignUpFormErrMsg.emailErrMsgMinLen
      // TODO:ユーザー登録機能この部分が上手くいってないかも
    }
    // else if(await !validEmailDup(this.email)){
    //   //重複確認のバリテーション
    //   console.log("(signUp)メールアドレスが重複しています");
    //   this.emailErrMsg = SignUpFormErrMsg.emailErrMsgEmailDup
    // }
    else if(this.emailErrMsg === ''){
      //バリテーションがOKな場合
      console.log("(login)メールアドレスのバリテーションOKです");
    }

     //パスワードのバリデーション
    if (!this.password) {
      //空文字チェック
      console.log("(login)パスワードを入力してください");
      this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgEmpty
    } else if(!validHalfNumAlp(this.password)) {
      //半角英数字チェック
      console.log("(login)パスワードは半角英数字で入力してください");
      this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgHalfNumAlp
    } else if(validMaxLen(this.password,SIGNUP_NUM.SIGNUP_PASSWORD_MAXLEN)){
      //最大文字数チェック
      console.log("(login)パスワードは20文字以内で入力してください");
      this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgMaxLen
    } else if(validMinLen(this.password,SIGNUP_NUM.SIGNUP_PASSWORD_MINLEN)){
      //最小文字数チェック
      console.log("(login)パスワードは6文字以上で入力してください");
      this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgMinLen
    } else {
      //バリテーションOK
      console.log("(login)パスワードのバリテーションOKです");
    }

      // バリテーションが通っているかを確認。
    if(this.emailErrMsg === '' && this.passwordErrMsg === ''){
      console.log("ログイン用バリテーションOKです。");

      try {
        this.isSubmit = true;
        this.signUpButton = '登録中・・・';
        // TODO:ロード画面実装
        // this.$store.dispatch("app/setLoading");
        console.log("登録処理に入りました。");

        const loginParams = {
          email: this.email,
          password: this.password,
        }

        this.loginUser = await axios.post('/api/login',loginParams);
        console.dir(this.loginUser);

        Cookies.set('user_id', this.loginUser.data.id);
        Cookies.set('email', this.loginUser.data.email);
        Cookies.set('roll', this.loginUser.data.roll);

        //バリテーション結果の初期化
        this.loginUser.data.id = '';
        this.loginUser.data.email = '';
        this.loginUser.data.roll = '';

        // this.$store.dispatch("users/setLoginUserInfo");
        this.signUpButton = "登録する";
        this.isSubmit = false;

        // マイページへ飛ばすパスを書く。
        this.$router.push(`/mypage/${Cookies.get('user_id')}`)

      } catch (e) {
        console.log("登録処理中に例外エラーが発生しました。");
        this.commonErrMsg = CommonErrMsg.commonErrMsg;
        this.signUpButton = '登録する';
        this.isSubmit = false;
      }
      // 上手く動かない。
      // finally {
      //   this.isSubmit = false;
      //   this.signUpButton = '登録する';
      // }
    }
  }


}
</script>
<style lang="scss" scope>
  .login{
    height: 350px;
    width: 400px;
    padding: 20px 0;
    position: relative;
    left: 10px;
    background-color: #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 1;
    transition: all .5s;
    &-title{
      text-align: center;
      font-size: 22px;
      margin: 10px 0;
      height: 30px;
    }
    &-formStyle{
      height: 300px;
      width: 320px;
      margin: 0 40px;
      position: absolute;
    }
    &-emailaddressField{
      height: 57px;
    }
    &-emailForm{
      border: 0;
      border-bottom: 1px solid #b4becb;
      width: 100%;
      padding: 3px;
      font-size: 16px;
      position: absolute;
      top:97px;
      &:focus{
        outline: none;
        border-bottom: 1px solid #047aed;
      }
    }
    &-passwardField{
      height: 57px;
    }
    &-passwordForm{
      border: 0;
      border-bottom: 1px solid #b4becb;
      width: 100%;
      padding: 3px;
      font-size: 16px;
      position: absolute;
      top:177px;
      &:focus{
        outline: none;
        border-bottom: 1px solid #047aed;
      }
    }
    &-registerBtnField{
      height: 57px;
      padding: 0 105px;
    }
    &-registerBtn{
      position: absolute;
      top:250px;
      padding: 10px 30px;
      background-color: #047aed;
      border: none;
      border-radius: 5px;
      color: #fff;
    }
  }
</style>
