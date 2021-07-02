<template>
  <!-- タイトル -->
  <h1 class="header__title">
    <router-link to="/" class="header__title-link">
      {{headerTitle[0].logo}}
    </router-link>
  </h1>
</template>

<script lang="ts" scoped>
import { Component,Prop,Vue} from 'vue-property-decorator';
import { HeaderLogo } from '@/store/models.d';
@Component
export default class HeaderTitle extends Vue {

  @Prop(Array)
  private headerTitle!: HeaderLogo[];

}
</script>
