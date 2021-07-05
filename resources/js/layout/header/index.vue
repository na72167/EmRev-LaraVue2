<template>
  <!-- ヘッダー関係 -->
  <header id="index-top" class="header">
    <div class="header__content-wrap">
      <div>
        <HeaderTitle
          :headerTitle="headerTitle"
        />
      </div>
      <div>
        <HeaderMenu
          :headerMenu="headerMenu"
          :aboutMenus="aboutMenus"
        />
      </div>
    </div>
  </header>
</template>

<script scoped>
import HeaderTitle from '@/layout/components/header/HeaderTitle'
import HeaderMenu from '@/layout/components/header/HeaderMenu'
import { mapState } from "vuex";
import { headerTitle,aboutMenus } from '@/utils/header-mapping';

export default {
  components: {
    HeaderTitle,
    HeaderMenu
  },
  computed: {
    ...mapState({
      user: state => state.users.userId,
      headerMenu: state => state.header.headerMenu,
    }),
  },
  data () {
    return {
      headerTitle: headerTitle,
      aboutMenus: aboutMenus,
    }
  },
}
</script>

<style lang="scss" scope>
  .header{
    height: 70px;
    background-color: #047aed;
    overflow: hidden;
    width: 100%;
    &__content-wrap{
      height: 100%;
      margin: 0 auto;
      max-width: 1100px;
    }
    &__title{
      display: inline;
      font-size: 2em;
      position: relative;
      color:#fff;
      top: calc(70px / 2 - 51px / 2);
      margin-left: 67px;
      font-weight: 300;
    }
    &__title-link{
      color:#fff;
      text-decoration: none;
      &:link{
      color:#fff;
      }
      &:visited{
      color:#fff;
      }
    }
    &__nav{
      float: right;
      position: relative;
      margin-right: 67px;
      // top: calc(70px / 2 - 25px / 2);
      &-list{
      list-style-type: none;
      float: left;
      margin-right: 10px;
      color:#fff;
      &:last-child{
          margin-right: 0px;
      }
      &:hover {
          border-bottom: 2px #fff solid;
      }
      }
    }
  }
  .openAboutMenu{
    transition: all .5s;
    transform: translateX(100%);
  }
</style>
