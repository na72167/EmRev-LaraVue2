<template>
  <span>
    <li class="header__nav-list" @click="switchMenuState">{{ headerMenu[0].text }}</li>
    <li class="header__nav-list active-login-menu" @click="changeLoginComp">{{ headerMenu[1].text }}</li>
    <li class="header__nav-list active-signup-menu" @click="changeSignUpComp">{{ headerMenu[2].text }}</li>
  </span>
</template>

<script scoped>
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
    changeLoginComp() {
      this.$store.dispatch("tool/setLoginUserInfo");
    },
    changeSignUpComp() {
      this.$store.dispatch("tool/setSignUpCompInfo");
    },
  }
}
</script>
