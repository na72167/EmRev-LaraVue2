<template>

  <div>
    <div v-for="reviewCompany in reviewCompanys" :key="reviewCompany.id">
      <div class="rigisRigisterReviewList__mainContent">

        <div class="rigisRigisterReviewList__imgComInfoWrap">
          <div class="rigisRigisterReviewList__imgStyle">
            <img class="rigisRigisterReviewList__img"
            src="<?php echo etc::showImg(etc::sanitize($val['pic1'])); ?>">
          </div>

          <div class="rigisRigisterReviewList__companyWrap">
            <div class="rigisRigisterReviewList__industryClassification">{{ settingsReviewCompany.industryClassification }}<span>{{ reviewCompany.industry }}</span></div>
            <div class="rigisRigisterReviewList__companyName">{{ settingsReviewCompany.companyName }}<span>{{ reviewCompany.company_name }}</span></div>
            <div class="rigisRigisterReviewList__location">{{ settingsReviewCompany.location }}<span>{{ reviewCompany.location }}</span></div>
          </div>
          <div class="rigisRigisterReviewList__reviewLink">{{ settingsReviewCompany.numberOfReviews }}<span>{{ reviewCompany.numberOfReviews }}</span>){{ settingsReviewCompany.case }}</div>
        </div>

        <div class="rigisRigisterReviewList__userDetail">
          <div class="rigisRigisterReviewList__name">(総合的な会社の印象が出力される予定)</div>
          <div class="rigisRigisterReviewList__dmIncumbentWrap">
            <div class="rigisRigisterReviewList__age">{{ settingsReviewCompany.postedDate }}<span>{{ reviewCompany.created_at }}</span></div>
            <div class="rigisRigisterReviewList__dm">{{ settingsReviewCompany.generalComment }}<span>サンプルサンプルサンプルサンプル<br>サンプルサンプルサンプルサンプルサ...</span><h1 class="rigisRigisterReviewList__userProfLink">{{ settingsReviewCompany.details }}</h1></div>
          </div>
          <div class="rigisRigisterReviewList__userNameAgeFavoliteWrap">
            <div class="rigisRigisterReviewList__userNameAgeWrap">:<span>ユーザー名</span>{{ settingsReviewCompany.mr }}<span>〇〇</span>{{ settingsReviewCompany.age }}</div>
            <div class="rigisRigisterReviewList__favorite">{{ settingReviewCompany.star }}</div>
          </div>
        </div>

        <form method="post">
          <!-- <input type="hidden" name="company_id" value=<?php echo $val['id'] ?>> -->
          <input class="#" type="submit" value=settingsReviewCompany.makeReview >
        </form>

      </div>
    </div>
  </div>

</template>

<script>

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
}
</script>
