<template>
  <div>
    <ReviewRegisterJr
      v-if="formType === 'JoiningRoute' && initializing"
      :setting="setting"
    />
    <ReviewRegisterIc
      v-if="formType === 'InternalSystemsAndCorporateCulture' && initializing"
      :setting="setting"
    />
    <ReviewRegisterGj
      v-if="formType === 'GapsAndJobSatisfactionAfterJoiningTheCompany' && initializing"
      :setting="setting"
    />
    <ReviewRegisterGc
      v-if="formType === 'GeneralComment' && initializing"
      :setting="setting"
    />
    <ReviewRegisterPc
      v-if="formType === 'PostingCheck' && initializing"
      :setting="setting"
    />
    <ReviewRegisterSc
      v-if="formType === 'SubmissionComplete' && initializing"
      :setting="setting"
    />
  </div>
</template>
<script>
import ReviewRegisterJr from '@/components/reviewPosting/ReviewRegister-jr'
import ReviewRegisterIc from '@/components/reviewPosting/ReviewRegister-ic'
import ReviewRegisterGj from '@/components/reviewPosting/ReviewRegister-gj'
import ReviewRegisterGc from '@/components/reviewPosting/ReviewRegister-Gc'
import ReviewRegisterPc from '@/components/reviewPosting/ReviewRegister-Pc'
import ReviewRegisterSc from '@/components/reviewPosting/ReviewRegister-Sc'

export default {
  data () {
    return {
      initializing: true,
      formType: this.formType,
      setting: '',
    }
  },
  props:{
    formType: {
      type: String,
      required: true
    },
    setting: {
      type: Array,
      required: true
    },
  },
  components: {
    ReviewRegisterJr,
    ReviewRegisterIc,
    ReviewRegisterGj,
    ReviewRegisterGc,
    ReviewRegisterPc,
    ReviewRegisterSc
  }
}
</script>

<style lang="scss" scoped>
</style>
