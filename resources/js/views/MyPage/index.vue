<template>
  <div>
    <Intro/>
    <DesignSpace/>
    <MiddleElement/>
    <MypeUserProfile/>
    <MypeMyReviewList/>
    <MypeDmList/>
    <MypeMyFavoriteList/>
  </div>
</template>

<script lang="ts" scoped>
import { Component, Vue } from 'vue-property-decorator';

import Intro from '@/components/intro/Intro'
import DesignSpace from '@/components/etc/DesignSpace'
import MypeUserProfile from '@/components/mypage/MypeUserProfile'
import MypeMyReviewList from '@/components/mypage/MypeMyReviewList'
import MypeDmList from '@/components/mypage/MypeDmList'
import MypeMyFavoriteList from '@/components/mypage/MypeMyFavoriteList'

@Component({
  components: {
    Intro,
    DesignSpace,
    MypeUserProfile,
    MypeMyReviewList,
    MypeDmList,
    MypeMyFavoriteList
  },
})
export default class MyPage extends Vue {}
</script>
