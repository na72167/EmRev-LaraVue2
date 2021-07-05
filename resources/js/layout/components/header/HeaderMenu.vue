<template>

  <span>
    <nev class="header__nav" v-if="user">
      <LoginUserHeaderNav
        :headerMenu="headerMenu"
      />
      <AboutMenu
        :class="aboutMenuState"
        :aboutMenus="aboutMenus"
      />
    </nev>

    <!-- TODO:・・・コンポーネントの再定義が上手く出来ていない。 -->
    <nav class="header__nav" v-if="!user">
      <GuestsUserHeaderNav
        :headerMenu="headerMenu"
      />
      <AboutMenu
        :class="aboutMenuState"
        :aboutMenus="aboutMenus"
      />
    </nav>
  </span>

</template>

<script scoped>
import LoginUserHeaderNav from '@/layout/components/header/headerNavigation/LoginUserHeaderNav'
import GuestsUserHeaderNav from '@/layout/components/header/headerNavigation/GuestsUserHeaderNav'
import AboutMenu from '@/layout/components/header/AboutMenu'
import { mapState } from "vuex";

export default {
  components: {
    LoginUserHeaderNav,
    GuestsUserHeaderNav,
    AboutMenu
  },
  computed: {
    ...mapState({
      user: state => state.users.userId,
      aboutMenuState: state => state.tool.aboutMenuState,
    }),
  },
  props: {
    headerMenu: {
      type: Array,
      required: true
    },
    aboutMenus: {
      type: Array,
      required: true
    },
  },
}
</script>

<style lang="scss" scope>
  .openAboutMenu{
    transition: all .5s;
    transform: translateX(100%);
  }
</style>
