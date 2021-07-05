<template>
  <div>
    <Header/>
      <!-- TODO:ローディング画面の実装 -->
      <!-- <div class="#" v-show="loading"> -->
        <RouterView />
      <!-- </div> -->
    <Footer/>
  </div>
</template>

<script>
//コンポーネントから別ファイルなどを読み込み際には元のコンポーネントファイルの位置がルートになる。
// import { mapGetters } from "vuex";
import Header from '@/layout/header/index'
import Footer from '@/layout/footer/index'

export default {
  components: {
    Header,
    Footer
  }
}
</script>
