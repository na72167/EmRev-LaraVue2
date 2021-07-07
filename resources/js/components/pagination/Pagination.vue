<template>

  <div>


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
    <li v-show="front_dot" class="inactive">...</li>
    <li
      v-for="page in middlePageRange"
      :key="page"
      @click="changePage(page)"
      :class="(isCurrent(page)) ? 'active' : 'inactive'"
    >{{ page }}</li>
    <li v-show="end_dot" class="inactive">...</li>
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

  </div>

</template>
<script>
import axios from "axios";
import { PAGINATION } from '@/utils/pagination-mapping'

export default {
  data() {
    return {
    users: [],
    current_page: 1,
    last_page: "",
    range: 5,
    front_dot: false,
    end_dot: false
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
      if (!this.sizeCheck) return [];
      let start = "";
      let end = "";
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
    async fetchData() {

      const result = {
        data: [
          { id: 1, name: "test1" },
          { id: 2, name: "test3" },
          { id: 3, name: "test3" },
          { id: 4, name: "test4" },
          { id: 5, name: "test5" },
        ],
        current_page: [
          { id: 1 },
        ],
        last_page: [
          { id: 5 },
        ],
      };

      const users = result;
      this.current_page = users.current_page;
      this.last_page = users.last_page;
      this.users = users.data;
      console.dir(this.users);
    },

    calRange(start, end) {
      const range = [];
      for (let i = start; i <= end; i++) {
        range.push(i);
      }
      return range;
    },

    changePage(page) {
    if (page > 0 && page <= this.last_page) {
      this.current_page = page;
      this.getUsers();
    }
  },

  isCurrent(page) {
    return page === this.current_page;
  },

  },

  created: function() {
    this.fetchData();
  },
}
</script>

