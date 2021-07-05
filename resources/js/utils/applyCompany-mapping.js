// ========会社情報申請画面=========
//バリテーション関係

export const APPLYCOMPANY_NUM = {
  COMPANYNAME_MAXLEN: 20,
  COMPANYNAME_MINLEN: 4,

  REPRESENTATIVE_MAXLEN: 20,
  REPRESENTATIVE_MINLEN: 4,

  LOCATION_MAXLEN: 20,
  LOCATION_MINLEN: 4,

  INDUSTRY_MAXLEN: 20,
  INDUSTRY_MINLEN: 4,

  SES_LIMIT: 604800
};


export const SIGNUP_NAME = {
  SIGNUP: "signUp"
};

export const APPLY_COMPANY_BUTTON = {
  REGISTER_BUTTON: '申請する',
  REGISTERING_BUTTON: '申請中です...',
  CANCEL_BUTTON: 'キャンセル',
};

//========ユーザー認証時のエラーメッセージ========

export const CompanyNameFormErrMsg = {
  CompanyNameErrMsgEmpty: '会社名が未入力です',
  CompanyNameErrMsgHalfNumAlp: '会社名は半角英数字で入力してください',
  CompanyNameErrMsgMaxLen: '会社名は20文字以内にしてください',
  CompanyNameErrMsgMinLen: '会社名は最小4文字以上にしてください',
};

export const RepresentativeErrMsg = {
  RepresentativeErrMsgEmpty: '代表者欄が未入力です',
  RepresentativeErrMsgHalfNumAlp: '代表者欄は半角英数字で入力してください',
  RepresentativeErrMsgMaxLen: '代表者欄は20文字以内にしてください',
  RepresentativeErrMsgMinLen: '代表者欄は最小4文字以上にしてください',
};

export const LocationErrMsg = {
  LocationErrMsgEmpty: '所在地欄が未入力です',
  LocationErrMsgHalfNumAlp: '所在地欄は半角英数字で入力してください',
  LocationErrMsgMaxLen: '所在地欄は20文字以内にしてください',
  LocationErrMsgMinLen: '所在地欄は最小4文字以上にしてください',
};

export const IndustryErrMsg = {
  IndustryErrMsgEmpty: '業界欄が未入力です',
  IndustryErrMsgHalfNumAlp: '業界欄は半角英数字で入力してください',
  IndustryErrMsgMaxLen: '業界欄は20文字以内にしてください',
  IndustryErrMsgMinLen: '業界欄は最小4文字以上にしてください',
};

export const YearOfEstablishmentErrMsg = {
  YearOfEstablishmentErrMsgEmpty: '設立年度欄が未入力です',
  YearOfEstablishmentErrMsgHalfNumAlp: '設立年度欄は半角英数字で入力してください',
  YearOfEstablishmentErrMsgMaxLen: '設立年度欄は20文字以内にしてください',
  YearOfEstablishmentErrMsgMinLen: '設立年度欄は最小4文字以上にしてください',
};

export const ListedYearErrMsg = {
  ListedYearErrMsgEmpty: '上場年度欄が未入力です',
  ListedYearErrMsgHalfNumAlp: '上場年度欄は半角英数字で入力してください',
  ListedYearErrMsgMaxLen: '上場年度欄は20文字以内にしてください',
  ListedYearErrMsgMinLen: '上場年度欄は最小4文字以上にしてください',
};

export const NumberOfEmployeesErrMsg = {
  NumberOfEmployeesErrMsgEmpty: '従業員数欄が未入力です',
  NumberOfEmployeesErrMsgHalfNumAlp: '従業員数欄は半角英数字で入力してください',
  NumberOfEmployeesErrMsgMaxLen: '従業員数欄は20文字以内にしてください',
  NumberOfEmployeesErrMsgMinLen: '従業員数欄は最小4文字以上にしてください',
};

export const AverageAnnualIncomeErrMsg = {
  AverageAnnualIncomeErrMsgEmpty: '平均年収欄が未入力です',
  AverageAnnualIncomeErrMsgHalfNumAlp: '平均年収欄は半角英数字で入力してください',
  AverageAnnualIncomeErrMsgMaxLen: '平均年収欄は20文字以内にしてください',
  AverageAnnualIncomeErrMsgMinLen: '平均年収欄は最小4文字以上にしてください',
};

export const AverageAgeErrMsg = {
  AverageAgeErrMsgEmpty: '平均年収欄が未入力です',
  AverageAgeErrMsgHalfNumAlp: '平均年収欄は半角英数字で入力してください',
  AverageAgeErrMsgMaxLen: '平均年収欄は20文字以内にしてください',
  AverageAgeErrMsgMinLen: '平均年収欄は最小4文字以上にしてください',
};

export const CommonErrMsg = {
  commonErrMsg: '接続エラーが発生しました。時間を置いたのち再度送信して下さい',
};

// ========ログイン=========
//ログイン時のバリテーション関係
export const LOGIN_NUM = {
  LOGIN_EMAIL_MAXLEN: 20,
  LOGIN_EMAIL_MINLEN: 4,
  LOGIN_PASSWORD_MAXLEN: 20,
  LOGIN_PASSWORD_MINLEN: 6,
  SES_LIMIT: 604800
};

export const LOGIN_NAME = {
  LOGIN: "login"
};
