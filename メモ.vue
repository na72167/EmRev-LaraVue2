<template>
  <ul class="pagination">
    <li
      class="inactive"
      :class="(current_page == 1) ? 'disabled' : ''"
      @click="changePage(current_page-1)"
    >«</li>


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
    <li
      v-for="page in endPageRange"
      :key="page"
      @click="changePage(page)"
      :class="(isCurrent(page)) ? 'active' : 'inactive'"
    >{{ page }}</li>


    <li
      class="inactive"
      :class="(current_page >= last_page) ? 'disabled' : ''"
      @click="changePage(current_page+1)"
    >»</li>
  </ul>
</template>



<script>
export default {

  data() {
    return {
      data() {
        return {
          users: [],
          current_page: 6,
          last_page: 20,
          range: 5,
          front_dot: false,
          end_dot: false,
          size: 5
        }
      },
    };
  },

  computed: {
    frontPageRange() {
      if (!this.sizeCheck) {
        return this.calRange(1, this.last_page);
      }
      return this.calRange(1, 2);
    },
    middlePageRange() {
      let start = "";
      let end = "";
      // 総ページ数が5以下の場合、middlePageRange()の処理を打ち切る。
      if (!this.sizeCheck) return [];
      if (this.current_page <= this.range) {
        start = 3;
        end = this.range + 2;
        this.front_dot = false;
        this.end_dot = true;
      } else if (this.current_page > this.last_page - this.range) {
        start = this.last_page - this.range - 1;
        end = this.last_page - 2;
        this.front_dot = true;
        this.end_dot = false;
      } else {
        start = this.current_page - Math.floor(this.range / 2);
        end = this.current_page + Math.floor(this.range / 2);
        this.front_dot = true;
        this.end_dot = true;
      }
      return this.calRange(start, end);
    },
    endPageRange() {
      return this.calRange(this.last_page - 1, this.last_page);
    },

    sizeCheck() {
      if (this.last_page < this.size) {
        return false;
      }
      return true;
    },
  },


  methods: {
    async getUsers() {
      const result = {
        data: [
          { id: 1, name: "test1" },
          { id: 2, name: "test3" },
          { id: 3, name: "test3" },
          { id: 4, name: "test4" },
          { id: 5, name: "test5" },
        ],
        current_page:[3],
      };
      const users = result;
      this.current_page = users.current_page;
      this.last_page = users.last_page;
      this.users = users.data;
    },
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
    isCurrent(page) {
      return page === this.current_page;
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
}
.pagination li {
  border: 1px solid #ddd;
  padding: 6px 12px;
  text-align: center;
}
.pagination li + li {
  border-left: none;
}
.disabled {
  cursor: not-allowed;
}
</style>

