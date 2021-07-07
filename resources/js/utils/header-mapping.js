export const headerTitle = [
  { logo: 'EmRev',link: '/' },
];

export const headerMenuLoggedIn = [
  { type: 'LoggedIn', text: 'MENU', link: '#' },
  { type: 'LoggedIn', text: 'REVIEW POSTING', link: '`/reviewPosting/${this.query}`' },
  { type: 'LoggedIn', text: 'LOGOUT', link: '#' },
];

export const headerMenuGuests = [
  { type: 'Guests', text: 'MENU', link: '#' },
  { type: 'Guests', text: 'LOGIN', link: '/messages' },
  { type: 'Guests', text: 'SIGNUP', link: '/groups' },
];

export const aboutMenus = [
  { text: 'マイページ', link: '`/mypage/${this.loginUserId}`' },
  { text: 'お気に入りレビュー一覧', link: '#' },
  { text: '投稿されたレビュー一覧', link: '#' },
  { text: '閲覧履歴', link: '#' },
  { text: '登録社員一覧', link: '#' },
  { text: 'パスワード変更', link: '#' },
  { text: 'レビュー会社登録申請', link: '/ApplyCompany' },
  { text: '退会する', link: '#' },
];
