
<template>
  <!-- TODO:表示がうまくいっていない -->
  <nav class="header__nav">
    <!-- v-for・v-ifで表示させてもいいかも -->
    <li class="header__nav-list" @click="switchMenuState">{{ headerMenu[0].text }}</li>
      <!-- TODO:ここ問題あり -->
      <router-link :to="headerMenu[1].link" class="menuAbout__itemWrap-lineNone">
        <li class="header__nav-list">{{ headerMenu[1].text }}</li>
      </router-link>
    <li class="header__nav-list" @click="logout">{{ headerMenu[2].text }}</li>
  </nav>
</template>

<script scoped>
import Cookies from "js-cookie";
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      aboutMenuState: state => state.tool.aboutMenuState
    }),
  },
  props: {
    headerMenu: {
      type: Array,
      required: true
    },
  },
  methods: {
    switchMenuState() {
      this.switchingMenuState = this.aboutMenuState === false ? 'openAboutMenu' : false;
      this.$store.dispatch("tool/changeAboutMenuState",this.switchingMenuState);
    },
    logout() {
      // TODO:動作未確認
      Cookies.remove('user_id');
      Cookies.remove('email');
      Cookies.remove('roll');
      this.$store.dispatch("header/setHeaderMenuGuests");
      this.$router.push('/');
    },
    changeSignUpComp() {
      this.$store.dispatch("tool/setSignUpCompInfo");
    },
  }
}
</script>
