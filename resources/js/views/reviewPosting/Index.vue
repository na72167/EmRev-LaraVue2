<template>
  <div>
    <Intro/>
    <CompanySearchForm/>
    <CompanySort/>
    <SelectReviewCompany
      v-if="reviewCompanys && initializing"
      :settingsReviewCompany="settingsReviewCompany"
      :reviewCompanys="reviewCompanys"
    />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Intro from '@/components/intro/Intro'
import CompanySearchForm from '@/components/searchForm/CompanySearchForm'
import CompanySort from '@/components/searchForm/CompanySort'
import SelectReviewCompany from '@/components/selectMenu/SelectMenu'
import { SETTINGS_REVIEW_COMPANY } from '@/utils/selectMenu/selectReviewCompany-mapping'

export default {
  data: function() {
    return {
      initializing: false,
      settingsReviewCompany: SETTINGS_REVIEW_COMPANY,
    }
  },
  components: {
    Intro,
    CompanySearchForm,
    CompanySort,
    SelectReviewCompany
  },
  methods: {

    //次はここから(ページネーションに関係するEmitの処理を書く)
    //その後検索用コンポーネントを書いて、検索結果一覧に関係するStoreを更新する。

    // movePage(id) {
    //   // search URL queries saving vuex
    //   const queries = window.location.hash.split(/(?=\?)/g);
    //   if( queries[1] ) {
    //       this.$store.dispatch('vehicles/setSearchQueries', queries[1]);
    //   }
    //   const moveLink = path.join('/vehicles', "/", id);
    //   this.$store.dispatch("app/setLoading");
    //   this.$router.push(moveLink);
    // },

    async fetchData() {
      this.$store.dispatch("tool/setLoading");
      try {
        // ここで下のreviewCompanys用の処理に関係するデータの取得。セットを行う。
        // TODO:検索部分まで一通り出来たら取り掛かる。
        await this.$store.dispatch("reviewPostings/setReviewCompanys");
        this.$store.dispatch("tool/clearLoading");
        this.initializing = true;
      } catch (e) {
        // handleApiError(e);
      }
    },

  },
  //コンポーネント作成時発火(初期データ表示の為の処理)
  created: async function() {
    this.fetchData();
  },
  computed: {
    // 検索用コンポーネントを経由して更新した表示データを取得する。
    ...mapGetters({
      reviewCompanys: 'reviewPostings/reviewCompanys',
    })
  },
}
</script>
