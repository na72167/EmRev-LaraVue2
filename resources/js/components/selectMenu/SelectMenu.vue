<template>
  <div>
    <div class="rigisRigisterReviewList">
      <div class="rigisRigisterReviewList__header">
        <h1 class="rigisRigisterReviewList__title">{{ settingsReviewCompany.title }}</h1>
        <h3>検索結果:<span>{{ reviewCompanys.data.count }}</span>件</h3>
      </div>
      <DataTable
        :reviewCompanys="reviewCompanys.data.data"
        :settingsReviewCompany="settingsReviewCompany"
      />
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
    settingsReviewCompany: {
      type: Object,
      required: true
    },
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
