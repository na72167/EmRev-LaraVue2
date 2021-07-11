<template>
  <div>
    <div class="rigisRigisterReviewList">
      <div class="rigisRigisterReviewList__header">
        <h1 class="rigisRigisterReviewList__title">{{ settingsReviewCompany.title }}</h1>
        <h3>検索結果:<span>{{ reviewCompanys.data.count }}</span>件</h3>
      </div>
      <DataTable
        :reviewCompanys="reviewCompanys.data.data.data"
        :settingsReviewCompany="settingsReviewCompany"
      />
      <!-- 保留 -->
      <Pagination
      />
    </div>
  </div>
</template>

<script>
import DataTable from '@/components/dataTable/ComponayReview'
import Pagination from '@/components/pagination/Pagination'

export default {
  props: {
    // 名前関係
    settingsReviewCompany: {
      type: Object,
      required: true
    },
    // 会社情報を纏めたデータ
    reviewCompanys: {
      type: Object,
      required: true
    },
  },
  components: {
    DataTable,
    Pagination
  },
}
</script>
