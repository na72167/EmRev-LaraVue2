<template>

  <span>
    <nev class="header__nav" v-if="user">
      <LoginUserHeaderNav/>
      <AboutMenu
        :class="aboutMenuState"
      />
    </nev>

    <!-- TODO:・・・コンポーネントの再定義が上手く出来ていない。 -->
    <nav class="header__nav" v-if="!user">
      <GuestsUserHeaderNav/>
      <AboutMenu
        :class="aboutMenuState"
      />
    </nav>
  </span>

</template>

<script lang="ts" scoped>
import { Component,Prop,Watch,Vue } from 'vue-property-decorator';
import LoginUserHeaderNav from '@/layout/components/header/headerNavigation/LoginUserHeaderNav';
import GuestsUserHeaderNav from '@/layout/components/header/headerNavigation/GuestsUserHeaderNav';
import AboutMenu from '@/layout/components/header/AboutMenu';
import { toolStoreModule } from '@/store/modules/tool';
import { AuthModule } from '@/store/modules/auth';
import { User,HeaderMenus } from '@/store/models.d';
import { OpenAboutMenu } from '@/store/models.d'
import { SignUpOrLogin } from '@/store/models.d';

@Component({
  components: {
    LoginUserHeaderNav,
    GuestsUserHeaderNav,
    AboutMenu
  }
})

export default class HeaderMenu extends Vue {

  private user: any = AuthModule.getLoginUserDate;

  private aboutMenuState: OpenAboutMenu = false;

  public getAboutMenuState(){
    return this.aboutMenuState = toolStoreModule.isAboutMenuState
  }


  // public changeLoginProp(){

  // }

  // public changeSignUpProp(){

  // }

}
</script>
