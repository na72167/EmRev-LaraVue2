<template>
  <div class="signup js-signup-style">
    <form class="signup-formStyle" @submit.prevent="signUp()">

      <h2 class="signup-title">SignUp</h2>
      <div class="signup-commonMsgArea">
        <!-- 接続エラー等のメッセージをここに出力させる。 -->
        <span class="#">
          <strong>{{ commonErrMsg }}</strong>
        </span>
      </div>

      <!-- メールアドレス入力欄 -->
      <div class="signup-emailaddressField">
        <label class="#">
          <input class="signup-emailForm" :class="{ errInput: emailErrMsg }" type="text" placeholder="Email" v-model="email">
          <div class="signup-areaMsg">
            <span class="#">
              <strong>{{ emailErrMsg }}</strong>
            </span>
          </div>
        </label>
      </div>

      <!-- パスワード入力 -->
      <div class="signup-passwardField">
        <label class="#">
          <input class="signup-passwordForm" :class="{ errInput: passwordErrMsg }" type="password" placeholder="Password" v-model="password">
          <div class="signup-areaMsg">
            <span class="#">
              <strong>{{ passwordErrMsg }}</strong>
            </span>
          </div>
        </label>
      </div>

      <!-- 確認用パスワード入力 -->
      <div class="signup-confirmationPasswardField">
        <!-- 後にphpでエラー時用のスタイルを付属させる様にする。 register-->
        <label class="#">
          <input class="signup-passwordConfirmationForm" :class="{ errInput: passwordConfirmation }" type="password" placeholder="Confirmation Password" v-model="passwordConfirmation">
        </label>
      </div>

      <div class="signup-registerBtnField">
        <button class="signup-registerBtnField"
          type="submit"
          :disabled="isSubmit"
        >
        {{ signUpButton }}
        </button>
      </div>

    </form>
  </div>
</template>

<script scoped>
import Cookies from "js-cookie";
import axios from "axios";
import { SIGNUP_NUM,SIGNUP_BUTTON,EmailFormErrMsg,PasswordFormErrMsg,CommonErrMsg } from '@/utils/auth-mapping';
import { validEmail,validHalfNumAlp,validMaxLen,validMinLen,validEmailDup } from '@/utils/validate';

export default {
  data() {
    return {
      email: '',
      password: '',
      passwordConfirmation: '',

      emailErrMsg: '',
      passwordErrMsg: '',
      commonErrMsg: '',

      sendEmailFlg: false,
      sendPasswordFlg: false,

      isSubmit: false,
      signUpButton: SIGNUP_BUTTON.REGISTER_BUTTON,
      registUser: {
        data:{
          id: '',
          email: '',
          roll: '',
        }
      },
      sesLimit: SIGNUP_NUM.SES_LIMIT,
    };
  },
  methods: {

    async signUp() {
        //Emailのバリデーション
      if (!this.email) {
        //空かどうかのバリテーション
        console.log("(signUp)メールアドレスの入力がありません");
        this.emailErrMsg = EmailFormErrMsg.emailErrMsgEmpty
      } else if(!validEmail(this.email)){
        // メールアドレスの形式確認
        console.log("(signUp)メールアドレスの形式が正しくありません");
        this.emailErrMsg = EmailFormErrMsg.emailErrMsgEmailFormat
      } else if(validHalfNumAlp(this.email)){
        //半角英数字のバリテーション
        console.log("(signUp)メールアドレスを半角英数で入力してください");
        this.emailErrMsg = EmailFormErrMsg.emailErrMsgHalfNumAlp
      } else if(validMaxLen(this.email,SIGNUP_NUM.SIGNUP_EMAIL_MAXLEN)){
        //最大文字数のバリテーション
        console.log("(signUp)メールアドレスを20文字以内にしてください");
        this.emailErrMsg = EmailFormErrMsg.emailErrMsgMaxLen
      } else if(validMinLen(this.email,SIGNUP_NUM.SIGNUP_EMAIL_MINLEN)){
        //最小文字数のバリテーション
        console.log("(signUp)メールアドレスは4文字以上にしてください");
        this.emailErrMsg = EmailFormErrMsg.emailErrMsgMinLen
      }
      // TODO:修正が必要
      // else if(!validEmailDup(this.email)){
      //   //重複確認のバリテーション
      //   console.log("(signUp)メールアドレスが重複しています");
      //   this.Validation.signUpEmailErrMsg = EmailFormErrMsg.emailErrMsgEmailDup
      // }
       else if(this.emailErrMsg === ''){
        //バリテーションがOKな場合
        console.log("(signUp)メールアドレスのバリテーションOKです");
        this.sendEmailFlg = true;
      }

      //パスワードのバリデーション
      if (!this.password) {
        //空文字チェック
        console.log("(signUp)パスワードを入力してください");
        this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgEmpty
      } else if(!validHalfNumAlp(this.password)) {
        //半角英数字チェック
        console.log("(signUp)パスワードは半角英数字で入力してください");
        this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgHalfNumAlp
      } else if(validMaxLen(this.password,SIGNUP_NUM.SIGNUP_PASSWORD_MAXLEN)){
        //最大文字数チェック
        console.log("(signUp)パスワードは20文字以内で入力してください");
        this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgMaxLen
      } else if(validMinLen(this.password,SIGNUP_NUM.SIGNUP_PASSWORD_MINLEN)){
        //最小文字数チェック
        console.log("(signUp)パスワードは6文字以上で入力してください");
        this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgMinLen
      } else if(this.password !== this.passwordConfirmation){
        //確認用パスワードと条件が合うか確認
        console.log("(signUp)確認用パスワードと一致しません");
        this.passwordErrMsg = PasswordFormErrMsg.passwordErrMsgPassMatch
      } else {
        //バリテーションOK
        console.log("(signUp)パスワードのバリテーションOKです");
        this.sendPasswordFlg = true;
      }

      // バリテーションが通っているかを確認。
      if(this.sendEmailFlg === true && this.sendPasswordFlg === true){
        console.log("ユーザー登録用バリテーションOKです。");

        try {

          this.isSubmit = true;
          this.signUpButton = SIGNUP_BUTTON.REGISTERING_BUTTON;
          // TODO:ロード画面実装
          this.$store.dispatch("tool/setLoading");
          console.log("登録処理に入りました。");

          //バリテーション結果の初期化
          this.emailErrMsg = '';
          this.passwordErrMsg = '';
          this.commonErrMsg = '';
          this.sendEmailFlg = false;
          this.sendPasswordFlg = false;

          const signUpParams = {
            email: this.email,
            password: this.password,
          }

          this.registUser = await axios.post('/api/register',signUpParams);
          console.dir(this.registUser);

          Cookies.set('user_id', this.registUser.data.id);
          Cookies.set('email', this.registUser.data.email);
          Cookies.set('roll', this.registUser.data.roll);
          this.$store.dispatch("users/setLoginUserInfo");
          // TODO:算出プロパティ部分を見直したのちヘッダー部分に下の処理を移動させる。
          this.$store.dispatch("header/setHeaderMenuLoggedIn");

          this.signUpButton = SIGNUP_BUTTON.REGISTER_BUTTON;
          this.isSubmit = false;
          this.$store.dispatch("tool/clearLoading");

          this.$router.push(`/mypage/${Cookies.get('user_id')}`)
        } catch (e) {
          console.log("登録処理中に例外エラーが発生しました。");
          this.commonErrMsg = CommonErrMsg.commonErrMsg;
          this.signUpButton = SIGNUP_BUTTON.REGISTER_BUTTON;
          this.isSubmit = false;
        }// 上手く動かない。
        // finally {
        //   this.isSubmit = false;
        //   this.signUpButton = '登録する';
        // }
      }
    }
  }
}
</script>

<style lang="scss" scope>
  .signup{
    height: 350px;
    width: 400px;
    background-color: #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    float: left;
    position: relative;
    top: 10px;
    left: 10px;
    z-index: 1;
    transition: all .5s;
    &-loginWrap{
      height: 367px;
      width: 420px;
      position: relative;
      top: 40px;
      right: 10px;
      overflow: hidden;
    }
    &-title{
      text-align: center;
      font-size: 22px;
      margin: 10px 0;
    }
    &-formStyle{
      height: 236px;
      width: 320px;
      margin: 40px auto;
    }
    &-emailaddressField{
      height: 57px;
      position: relative;
    }
    &-emailForm{
      border: 0;
      border-bottom: 1px solid #b4becb;
      width: 100%;
      padding: 3px;
      font-size: 16px;
      position: absolute;
      top:27px;
      &:focus{
        outline: none;
        border-bottom: 1px solid #047aed;
      }
    }
    &-passwardField{
      height: 57px;
      position: relative;
    }
    &-passwordForm{
      border: 0;
      border-bottom: 1px solid #b4becb;
      width: 100%;
      padding: 3px;
      font-size: 16px;
      position: absolute;
      top:27px;
      &:focus{
        outline: none;
        border-bottom: 1px solid #047aed;
      }
    }
    &-confirmationPasswardField{
      height: 57px;
      position: relative;
    }
    &-passwordConfirmationForm{
      border: 0;
      border-bottom: 1px solid #b4becb;
      width: 100%;
      padding: 3px;
      font-size: 16px;
      position: absolute;
      top:27px;
      &:focus{
        outline: none;
        border-bottom: 1px solid #047aed;
      }
    }

    &-registerBtnField{
      height: 57px;
      position: relative;
      padding: 0 105px;
    }
    &-registerBtn{
      position: absolute;
      top:30px;
      padding: 10px 30px;
      background-color: #047aed;
      border: none;
      border-radius: 5px;
      color: #fff;
    }
  }
</style>
