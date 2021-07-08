<template>
  <!-- メニューバー -->
  <div class="rigisRigisterReviewList__pageTransition">
    <div class="rigisRigisterReviewList__pageTransition-contentWrap">
      <span class="rigisRigisterReviewList__pageTransition-leftArrow">◁</span>

        <div class="rigisRigisterReviewList__pageTransition-guideNumber">

          <li
            v-for="page in frontPageRange"
            :key="page"
          >{{ page }}</li>
          <li
            v-for="page in middlePageRange"
            :key="page"
          >{{ page }}</li>
          <li
            v-for="page in endPageRange"
            :key="page"
          >{{ page }}</li>

        </div>
      <span class="rigisRigisterReviewList__pageTransition-rightArrow">▷</span>
    </div>
  </div>


</template>
<script>
export default {
  data() {
    return {
      companyDate: [],
      current_page: 2,
      last_page: 20,
      range: 5,
    };
  },
  computed: {
    frontPageRange() {
      return this.calRange(1, 2);
    },
    middlePageRange() {
      let start = "";
      let end = "";
      if (this.current_page <= this.range) {
        start = 3;
        end = this.range + 2;
      } else if (this.current_page > this.last_page - this.range) {
        start = this.last_page - this.range - 1;
        end = this.last_page - 2;
      } else {
        start = this.current_page - Math.floor(this.range / 2);
        end = this.current_page + Math.floor(this.range / 2);
      }
      return this.calRange(start, end);
    },
    endPageRange() {
      return this.calRange(this.last_page - 1, this.last_page);
    },
  },
  methods: {
    async getUsers() {
      const result = await axios.post('/api/reviewCompanySearch');
      console.dir(result);
      const companyDate = result.data;
      console.dir(companyDate);
      // this.current_page = users.current_page;
      this.last_page = companyDate.last_page;
      this.companyDate = companyDate.data;
    },
    calRange(start, end) {
      const range = [];
      for (let i = start; i <= end; i++) {
        range.push(i);
      }
    return range;
    },
  },
  created() {
    this.getUsers();
  },
};
</script>

<style lang="scss" scope>
.revliReviewList{
  height: 100%;
  width: 720px;
  padding: 20px 20px;
  background-color: #fff;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  margin-top: -950px;
  margin-left: 870px;
  margin-right: auto;

  &__pageTransition{
    height: 50px;
    border-top: 1px solid #b4becb;
    border-bottom: 1px solid #b4becb;
  }
  &__pageTransition-contentWrap{
    width: 80px;
    margin: 10px auto 0;
  }
  &__pageTransition-leftArrow{
    float: left;
  }
  &__pageTransition-guideNumber{
    float: left;
  }
  &__pageTransition-rightArrow{
    float: left;
  }
}
