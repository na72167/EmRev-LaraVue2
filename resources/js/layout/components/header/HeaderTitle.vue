<template>
  <!-- タイトル -->
  <h1 class="header__title">
    <router-link to="/" class="header__title-link">
      {{headerTitle[0].logo}}
    </router-link>
  </h1>
</template>

<script scoped>
export default {
  props: {
    headerTitle: {
      type: Array,
      required: true
    }
  },
}
</script>
