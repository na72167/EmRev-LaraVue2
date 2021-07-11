<template>
  <!-- レビュー登録機能の途中経路(jr~gcまで)を主に管理する -->
  <div>
    <Intro
      :introTextTitle="introTextTitle"
      :introTextSub="introTextSub"
      :introImg="introImg"
    />
    <ChangeReviewPostingForm
      v-if="formType && initializing"
      :formType="formType"
      :setting="setting"
    />
    <SelectButton
    />
  </div>
</template>

<script>
import Intro from '@/components/intro/Intro'
import ChangeReviewPostingForm from '@/components/reviewPosting/changeReviewPostingForm'
import SelectButton from '@/components/button/SelectButton'

import introImg from '@/assets/img/docs.png'
import { SETTINGS_JOINING_ROUTE,SETTINGS_INTERNAL_SYSTEMS_AND_CORPORATE_CULTURE,
SETTINGS_GAPS_AND_JOB_SATISFACTION_AFTER_JOINING_THE_COMPANY,SETTINGS_GENERAL_COMMENT,
SETTINGS_POSTING_CHECK } from '@/utils/reviewPosting-mapping'

export default {
  data () {
    return {
      formType: SETTINGS_JOINING_ROUTE.formType,
      initializing: true,
      setting: SETTINGS_REVIEW_COMPANY,
      introTextTitle: SETTINGS_JOINING_ROUTE.introTextTitle,
      introTextSub: SETTINGS_JOINING_ROUTE.introTextSub,
      introImg: introImg,
    }
  },
  components: {
    Intro,
    ChangeReviewPostingForm,
    SelectButton
  }
};
</script>

<style lang="scss" scoped>
</style>
