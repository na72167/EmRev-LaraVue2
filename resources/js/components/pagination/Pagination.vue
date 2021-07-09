<template>
  <div>
    <ul>
      <!-- 現在地点から一つ戻す -->
      <li
        class="inactive"
        :class="(current_page == 1) ? 'disabled' : ''"
        @click="changePage(current_page-1)"
      >«</li>

      <!-- changePage()・・・クリック時点をcurrent_pageに代入する。 -->
      <li
        v-for="page in frontPageRange"
        :key="page"
        @click="changePage(page)"
        :class="(isCurrent(page)) ? 'active' : 'inactive'"
      >{{ page }}</li>

      <li v-show="front_dot" class="inactive disabled">...</li>
      <li
        v-for="page in middlePageRange"
        :key="page"
        @click="changePage(page)"
        :class="(isCurrent(page)) ? 'active' : 'inactive'"
      >{{ page }}</li>
      <li v-show="end_dot" class="inactive disabled">...</li>

      <!-- changePage()・・・クリック時点をcurrent_pageに代入する。 -->
      <!-- :class・・・出力された数字とcurrent_pageプロパティが一致した場合、色付けする。 -->
      <li
        v-for="page in endPageRange"
        :key="page"
        @click="changePage(page)"
        :class="(isCurrent(page)) ? 'active' : 'inactive'"
      >{{ page }}</li>

      <!-- 現在地点から一つ進む -->
      <li
        class="inactive"
        :class="(current_page >= last_page) ? 'disabled' : ''"
        @click="changePage(current_page+1)"
      >»</li>

    </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      companyDate: [],
      current_page: 1,
      last_page: 5,
      range: 5,
      front_dot: false,
      end_dot: false,
      size: 4,
    };
  },
  computed: {
    // 先頭2つのページネーションを出力
    frontPageRange() {
      if (!this.sizeCheck) {
        return this.calRange(1, this.last_page);
      }
      return this.calRange(1, 2);
    },
    //中間のページネーションを出力
    middlePageRange() {
      let start = "";
      let end = "";
      if (!this.sizeCheck) return [];
      // 現在地が指定範囲内の場合
      if (this.current_page <= this.range) {
        start = 3;
        end = this.range + 2;
        this.front_dot = false;
        this.end_dot = true;
      // 現在地が最後尾周辺の場合
      } else if (this.current_page > this.last_page - this.range) {
        start = this.last_page - this.range - 1;
        end = this.last_page - 2;
        this.front_dot = false;
        this.end_dot = true;
      // 現在地が中間の場合
      } else {
        start = this.current_page - Math.floor(this.range / 2);
        end = this.current_page + Math.floor(this.range / 2);
        this.front_dot = false;
        this.end_dot = true;
      }
      return this.calRange(start, end);
    },
    //最後尾2つのページネーションを出力
    endPageRange() {
      return this.calRange(this.last_page - 1, this.last_page);
    },
  },
  methods: {
    //サーバーサイドからデータ取得。各プロパティにセットする。
    async getUsers() {
      const result = await axios.post('/api/reviewCompanySearch');
      console.dir(result);
      const companyDate = result.data;
      console.dir(companyDate);
      // this.current_page = users.current_page;
      this.last_page = companyDate.last_page;
      this.companyDate = companyDate.data;
    },

    //ページに出力する配列を出力(ここのrangeはコンポーネント内プロパティのrangeとは関係無い。)
    calRange(start, end) {
      const range = [];
      for (let i = start; i <= end; i++) {
        range.push(i);
      }
    return range;
    },

    changePage(page) {
      // バリテーション的な意味合いのif
      if (page > 0 && page <= this.last_page) {
        // クリックした数字を現在ページに設定したのちgetUsersを再発火
        this.current_page = page;
        this.getUsers();
      }
    },

    //現在のページング地点に色付けする。
    isCurrent(page) {
      return page === this.current_page;
    },

    sizeCheck() {
      if (this.last_page < this.size) {
        return false;
      }
      return true;
    },
  },
  created() {
    this.getUsers();
  },
};
</script>

<style lang="scss" scoped>
  .pagination {
    display: flex;
    list-style-type: none;
    &li {
      border: 1px solid #ddd;
      padding: 6px 12px;
      text-align: center;
    }
  }
  .disabled {
  cursor: not-allowed;
  }
</style>
