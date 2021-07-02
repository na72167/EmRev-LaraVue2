<template>
  <span  v-if="headerMenuGuests">
    <li class="header__nav-list" @click="switchMenuState">{{ headerMenuGuests[0].text }}</li>
    <li class="header__nav-list active-login-menu" @click="changeLoginProp">{{ headerMenuGuests[1].text }}</li>
    <li class="header__nav-list active-signup-menu" @click="changeSignUpProp">{{ headerMenuGuests[2].text }}</li>
  </span>
</template>

<script lang="ts" scoped>
import { Component,Prop,Vue } from 'vue-property-decorator';
import { HeaderMenus } from '@/store/models.d';
import { toolStoreModule } from '@/store/modules/tool';
import { headerMenuGuests } from '@/utils/header';
import { SIGNUP_NAME,LOGIN_NAME } from '@/utils/auth-mapping';

@Component
export default class GuestsUserHeaderNav extends Vue {

  private headerMenuGuests: HeaderMenus[] = headerMenuGuests;

  public changeLoginProp(): void{
    toolStoreModule.changeLoginComponents(LOGIN_NAME.LOGIN);
  }

  public changeSignUpProp(): void{
    toolStoreModule.changeSignUpComponents(SIGNUP_NAME.SIGNUP);
  }
}
</script>
