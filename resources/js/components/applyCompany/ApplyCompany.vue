<template>

  <section class="revcrReviewCompanyRegistration">
    <div class="revcrReviewCompanyRegistration__content">
      <div class="revcrReviewCompanyRegistration__title">Review Company Registration</div>
      <div class="revcrReviewCompanyRegistration__infoWrap">

        <div class="#">
          <!-- 接続エラー等のメッセージをここに出力させる。 -->
          <span class="#">
            <strong>{{ applyCompanyCommonErrMsg }}</strong>
          </span>
        </div>

        <form @submit.prevent="applyCompany">
          <div class="revcrReviewCompanyRegistration__inputComp">会社名
            <input :class="{ errInput: companyNameErrMsg}" v-model="companyName" type="text" placeholder="入力してください">
            <div class="revcrReviewCompany-areaMsg">
              <span class="#">
                <strong>{{ companyNameErrMsg }}</strong>
              </span>
            </div>
          </div>

          <div class="">
            <div class="">代表者
              <input :class="{ errInput: representativeErrMsg}" v-model="representative" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ representativeErrMsg }}</strong>
                </span>
              </div>
            </div>

            <div class="">所在地
              <input :class="{ errInput: locationErrMsg}" v-model="location" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ locationErrMsg }}</strong>
                </span>
              </div>
            </div>
          </div>

          <div class="">
            <div class="">業界
              <input :class="{ errInput: industryErrMsg}" v-model="industry" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ industryErrMsg }}</strong>
                </span>
              </div>
            </div>
            <div class="">設立年度
              <input :class="{ errInput: yearOfEstablishmentErrMsg}" v-model="yearOfEstablishment" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ yearOfEstablishmentErrMsg }}</strong>
                </span>
              </div>
            </div>
          </div>

          <div class="">
            <div class="">上場年
              <input :class="{ errInput: listedYearErrMsg}" v-model="listedYear" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ listedYearErrMsg }}</strong>
                </span>
              </div>
            </div>

            <div class="">従業員数
              <input :class="{ errInput: numberOfEmployeesErrMsg}" v-model="numberOfEmployees" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ numberOfEmployeesErrMsg }}</strong>
                </span>
              </div>
            </div>
          </div>

          <div class="">
            <div class="">平均年収
              <input :class="{ errInput: averageAnnualIncomeErrMsg}" v-model="averageAnnualIncome" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ averageAnnualIncomeErrMsg }}</strong>
                </span>
              </div>
            </div>

            <div class="">平均年齢
              <input :class="{ errInput: averageAgeErrMsg}" v-model="averageAge" type="text" placeholder="入力してください">
              <div class="revcrReviewCompany-areaMsg">
                <span class="#">
                  <strong>{{ averageAgeErrMsg }}</strong>
                </span>
              </div>
            </div>
          </div>

          <div>
            <div>
              <button type="submit" class="">
                  {{ cancelButton }}
              </button>
            </div>
            <div>
              <button type="submit" class="">
                  {{ submitButton }}
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>

</template>

<script scoped>
import { APPLYCOMPANY_NUM,APPLY_COMPANY_BUTTON,CompanyNameFormErrMsg,IndustryErrMsg,
YearOfEstablishmentErrMsg,ListedYearErrMsg,NumberOfEmployeesErrMsg,AverageAnnualIncomeErrMsg,
AverageAgeErrMsg } from '@/utils/applyCompany-mapping';
import { validHalfNumAlp,validMaxLen,validMinLen } from '@/utils/validate';

export default {
  data () {
    return {
      // フォーム情報の保持
      companyName: '',
      representative: '',
      location: '',
      industry: '',
      yearOfEstablishment: '',
      listedYear: '',
      numberOfEmployees: '',
      averageAnnualIncome: '',
      averageAge: '',

      // エラーメッセージを保持
      companyNameErrMsg: '',
      representativeErrMsg: '',
      locationErrMsg: '',
      industryErrMsg: '',
      yearOfEstablishmentErrMsg: '',

      listedYearErrMsg: '',
      numberOfEmployeesErrMsg: '',
      averageAnnualIncomeErrMsg: '',
      averageAgeErrMsg: '',

      applyCompanyCommonErrMsg: '',

      // フラグに書き換え
      sendFlgOne: false,
      sendFlgTwo: false,

      //連続で登録処理をさせない用
      isSubmit: false,
      submitButton: APPLY_COMPANY_BUTTON.REGISTER_BUTTON,
      cancelButton: APPLY_COMPANY_BUTTON.CANCEL_BUTTON,
      RegistUser: null,
      sesLimit: null,
      debug: null,
    }
  },
  methods: {
    async applyCompany(){
      //会社名
      if (!this.companyName) {
        //未入力チェック
        console.log("(applyCompany)会社名が未入力です");
        this.companyNameErrMsg = CompanyNameFormErrMsg.CompanyNameErrMsgEmpty
      } else if(!validHalfNumAlp(this.companyName)){
        // 半角英数時チェック
        console.log("(applyCompany)会社名は半角英数字で入力してください");
        this.companyNameErrMsg = '会社名は半角英数字で入力してください'
      } else if(validMaxLen(this.companyName,APPLYCOMPANY_NUM.COMPANYNAME_MAXLEN)){
        // 最大文字数チェック
        console.log("(applyCompany)会社名は20文字以内にしてください");
        this.companyNameErrMsg = '会社名は20文字以内にしてください'
      } else if(validMinLen(this.companyName,APPLYCOMPANY_NUM.COMPANYNAME_MINLEN)){
        // 最小文字数チェック
        console.log("(applyCompany)会社名は最小4文字以内にしてください");
        this.companyNameErrMsg = '会社名は最小4文字以上にしてください'
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)会社名のバリテーションOKです");
        this.companyNameErrMsg = ""
      }

      //代表者欄
      if (!this.representative) {
        //未入力チェック
        console.log("(applyCompany)代表者欄が未入力です。");
        this.representativeErrMsg = RepresentativeErrMsg.RepresentativeErrMsgEmpty
      } else if(!validHalfNumAlp(this.representative)){
        // 半角英数時チェック
        console.log("(applyCompany)代表者欄は半角英数字で入力してください");
        this.representativeErrMsg = RepresentativeErrMsg.RepresentativeErrMsgHalfNumAlp
      } else if(validMaxLen(this.representative,APPLYCOMPANY_NUM.REPRESENTATIVE_MAXLEN)){
        // 最大文字数チェック
        console.log("(applyCompany)代表者欄は20文字以内にしてください");
        this.representativeErrMsg = RepresentativeErrMsg.RepresentativeErrMsgMaxLen
      } else if(validMinLen(this.representative,APPLYCOMPANY_NUM.REPRESENTATIVE_MINLEN)){
        // 最小文字数チェック
        console.log("(applyCompany)代表者欄は最小4文字以内にしてください");
        this.representativeErrMsg = RepresentativeErrMsg.RepresentativeErrMsgMinLen
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)代表者欄のバリテーションOKです");
      }

      //所在地欄
      if (!this.location) {
        //未入力チェック
        console.log("(applyCompany)所在地欄が未入力です。");
        this.locationErrMsg = LocationErrMsg.LocationErrMsgEmpty
      } else if(!validHalfNumAlp(this.location)){
        // 半角英数時チェック
        console.log("(applyCompany)所在地欄は半角英数字で入力してください");
        this.locationErrMsg = LocationErrMsg.LocationErrMsgHalfNumAlp
      } else if(validMaxLen(this.location,APPLYCOMPANY_NUM.LOCATION_MAXLEN)){
        // 最大文字数チェック
        console.log("(applyCompany)所在地欄は20文字以内にしてください");
        this.locationErrMsg = LocationErrMsg.LocationErrMsgMaxLen
      } else if(validMinLen(this.location,APPLYCOMPANY_NUM.LOCATION_MINLEN)){
        // 最小文字数チェック
        console.log("(applyCompany)所在地欄は最小4文字以上にしてください");
        this.locationErrMsg = LocationErrMsg.LocationErrMsgMinLen
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)所在地欄のバリテーションOKです");
      }

      //業界欄
      if (!this.industry) {
        //未入力チェック
        console.log("(applyCompany)業界欄が未入力です");
        this.industryErrMsg = IndustryErrMsg.IndustryErrMsgEmpty
      } else if(!validHalfNumAlp(this.industry)){
        // 半角英数時チェック
        console.log("(applyCompany)業界欄は半角英数字で入力してください");
        this.industryErrMsg = IndustryErrMsg.IndustryErrMsgHalfNumAlp
      } else if(validMaxLen(this.industry,APPLYCOMPANY_NUM.INDUSTRY_MAXLEN)){
        // 最大文字数チェック
        console.log("(applyCompany)業界欄は20文字以内にしてください");
        this.industryErrMsg = IndustryErrMsg.IndustryErrMsgMaxLen
      } else if(validMinLen(this.industry,APPLYCOMPANY_NUM.INDUSTRY_MINLEN)){
        // 最小文字数チェック
        console.log("(applyCompany)業界欄は最小4文字以上にしてください");
        this.industryErrMsg = IndustryErrMsg.IndustryErrMsgMinLen
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)業界欄のバリテーションOKです");
      }

      //設立年度欄
      if (!this.yearOfEstablishment) {
        //未入力チェック
        console.log("(applyCompany)設立年度欄が未入力です");
        this.yearOfEstablishmentErrMsg = YearOfEstablishmentErrMsg.YearOfEstablishmentErrMsgEmpty
      } else if(!validHalfNumAlp(this.yearOfEstablishment)){
        // 半角英数時チェック
        console.log("(applyCompany)設立年度欄は半角英数字で入力してください");
        this.Validation.yearOfEstablishmentErrMsg = YearOfEstablishmentErrMsg.YearOfEstablishmentErrMsgHalfNumAlp
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)設立年度欄のバリテーションOKです");
      }

      //上場年
      if (!this.listedYear) {
        //未入力チェック
        console.log("(applyCompany)上場年度欄が未入力です");
        this.listedYearErrMsg = ListedYearErrMsg.ListedYearErrMsgEmpty
      } else if(!validHalfNumAlp(this.listedYear)){
        // 半角英数時チェック
        console.log("(applyCompany)上場年度欄は半角英数字で入力してください");
        this.listedYearErrMsg = ListedYearErrMsg.ListedYearErrMsgHalfNumAlp
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)上場年度欄のバリテーションOKです");
      }

      //従業員数欄
      if (!this.numberOfEmployees) {
        //未入力チェック
        console.log("(applyCompany)従業員数欄が未入力です");
        this.numberOfEmployeesErrMsg = NumberOfEmployeesErrMsg.NumberOfEmployeesErrMsgEmpty
      } else if(!validHalfNumAlp(this.numberOfEmployees)){
        // 半角英数時チェック
        console.log("(applyCompany)従業員数欄は半角英数字で入力してください");
        this.numberOfEmployeesErrMsg = NumberOfEmployeesErrMsg.NumberOfEmployeesErrMsgHalfNumAlp
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)従業員数欄のバリテーションOKです");
      }

      //平均年収
      if (!this.averageAnnualIncome) {
        //未入力チェック
        console.log("(applyCompany)平均年収欄が未入力です。");
        this.averageAnnualIncomeErrMsg = AverageAnnualIncomeErrMsg.AverageAnnualIncomeErrMsgEmpty
      } else if(!validHalfNumAlp(this.averageAnnualIncome)){
        // 半角英数時チェック
        console.log("(applyCompany)平均年収は半角英数字で入力してください");
        this.averageAnnualIncomeErrMsg = AverageAnnualIncomeErrMsg.AverageAnnualIncomeErrMsgHalfNumAlp
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)平均年収のバリテーションOKです");
      }

      //平均年齢
      if (!this.averageAge) {
        //未入力チェック
        console.log("(applyCompany)平均年齢欄が未入力です");
        this.averageAgeErrMsg = AverageAgeErrMsg.AverageAgeErrMsgEmpty
      } else if(!validHalfNumAlp(this.averageAge)){
        // 半角英数時チェック
        console.log("(applyCompany)平均年齢は半角英数字で入力してください");
        this.averageAgeErrMsg = AverageAgeErrMsgEmpty.AverageAgeErrMsgHalfNumAlp
      } else {
        //バリテーションがOKな場合
        console.log("(applyCompany)平均年齢のバリテーションOKです");
      }

      //TODO:素書き版を元に見直し。
      // エラーメッセージの確認
      if(this.companyNameErrMsg === '' && this.representativeErrMsg === '' && this.locationErrMsg === ''
      && this.industryErrMsg === '' && this.yearOfEstablishmentErrMsg === ''){
        this.sendFlgOne = true;
        this.sendFlgTwo = true;
      }

      // バリテーションが通っているかを確認。
      if(this.sendFlgOne === true && this.sendFlgTwo === true){
        console.log("ユーザー登録用バリテーションOKです。");

        try {

          this.isSubmit = true;
          // this.signUpButton = SIGNUP_BUTTON.REGISTERING_BUTTON;
          // TODO:ロード画面実装
          this.$store.dispatch("tool/setLoading");
          console.log("会社情報登録処理に入りました。");

          //バリテーション結果の初期化
          this.companyNameErrMsg = '';
          this.representativeErrMsg = '';
          this.locationErrMsg = '';
          this.industryErrMsg = '';
          this.yearOfEstablishmentErrMsg = '';

          this.sendFlgOne = false;
          this.sendFlgTwo = false;

          const applyCompanyParams = {
            companyName: this.companyName,
            representative: this.representative,
            location: this.location,
            industry: this.industry,
            yearOfEstablishment: this.yearOfEstablishment,
            listedYear: this.listedYear,
            numberOfEmployees: this.numberOfEmployees,
            averageAnnualIncome: this.averageAnnualIncome,
            averageAge: this.averageAge,
          }

          this.applyCompany = await axios.post('/api/applyCompany',applyCompanyParams);
          console.dir(this.applyCompany);

          this.submitButton = APPLY_COMPANY_BUTTON.REGISTER_BUTTON;
          this.isSubmit = false;
          this.$store.dispatch("tool/clearLoading");

          this.$router.push(`/mypage/${Cookies.get('user_id')}`)

        } catch (e) {
          console.log("登録処理中に例外エラーが発生しました。");
          this.commonErrMsg = CommonErrMsg.commonErrMsg;
          this.signUpButton = APPLY_COMPANY_BUTTON.REGISTER_BUTTON;
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
  .revcrReviewCompanyRegistration{
    &__content{
      position: relative;
      top: -30px;
      height: 600px;
      width: 1400px;
      background-color: #fff;
      border-radius: 3px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
      margin: 0 auto;
    }
    &__title{
      padding:20px 0;
      text-align: center;
      font-size: 2rem;
    }
    &__inputComp{
      height: 27px;
      width: 250px;
      margin: 0 auto;
      padding-left: 10px;
      border: 0;
      border-bottom: 1px solid #b4becb;
      &::placeholder{
        font-size: 15px;
      }
      &:last-child{
        margin-bottom: 0px;
      }
      &:focus{
        outline: none;
        border-bottom: 1px solid #0082e6;
      }
    }
    &__infoWrap{
      width: 550px;
      margin: 0 auto;
    }
    &__bottom-return{
      padding: 10px 45px;
      background-color: #fff;
      color: #06D1EC;
      border: none;
      border: 1px solid #06D1EC;
    }
    &__bottom-next{
      padding: 10px 47px;
      margin-left: 50px;
      background-color: #06D1EC;
      color: #fff;
      border: none;
      border: 1px solid #fff;
    }
  }
</style>

