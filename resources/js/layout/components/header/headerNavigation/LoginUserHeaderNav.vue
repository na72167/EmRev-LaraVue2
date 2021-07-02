
<template>
  <!-- TODO:表示がうまくいっていない -->
  <nav class="header__nav" v-if="headerMenu">
    <!-- v-for・v-ifで表示させてもいいかも -->
    <li class="header__nav-list" @click="switchMenuState()">{{headerMenuLoggedIn[0].text}}</li>
      <!-- TODO:ここ問題あり -->
      <router-link :to="headerMenuLoggedIn[1].link" class="menuAbout__itemWrap-lineNone">
        <li class="header__nav-list" @click="switchMenuState()">{{headerMenuLoggedIn[1].text}}</li>
      </router-link>
    <li class="header__nav-list" @click="logout">{{headerMenuLoggedIn[2].text}}</li>
  </nav>
</template>

<script lang="ts" scoped>
import { Component,Prop,Vue } from 'vue-property-decorator';
import { toolStoreModule } from '@/store/modules/tool';
import { HeaderMenus,AboutMenus } from '@/store/models.d';
import { headerMenuLoggedIn } from '@/utils/header';
import { OpenAboutMenu } from '@/store/models.d';

@Component
export default class LoginUserHeaderNav extends Vue {

  private aboutMenuState: OpenAboutMenu = false;
  private switchingMenuState?: OpenAboutMenu;

  private headerMenu?: HeaderMenus[] = headerMenuLoggedIn;

  @Prop(Array)
  private aboutMenu?: AboutMenus[];

  public switchMenuState(){
    // aboutMenuState内の要素を反転させる。
    this.switchingMenuState = this.aboutMenuState === false ? 'openAboutMenu' : false;
    toolStoreModule.switchMenuComponent(this.switchingMenuState);
  }

}
</script>
