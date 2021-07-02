<template>
  <footer class="footer">
    <div class="footer__element-wrap">
      <div class="footer__element-copyright">
        <h1 class="footer__element-copyrightTitle">EmRev</h1>
        Copyright © Y.H<br>All Rights Reserved
      </div>
      <div class="footer__element-link">
        sample<br>
        sample<br>
        sample
      </div>
      <div class="footer__element-sns">
        sample<br>
        sample<br>
        sample
      </div>
    </div>
  </footer>
</template>
<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
@Component
export default class Footer extends Vue {
}
</script>
<style lang="scss" scoped>
  .footer{
  background-color: #002240;
  // 「em」は「親要素に対してn倍」という感じで数字が決まる。
  // 「rem」とは、「root」+「em」をあわせた単位。「root要素(htmlタグ)に対してn倍」という感じで数字が決まる。
  // 多分padding・marginをremで指定する際はhtml要素(root)に記入した「font-size」に依存する?
  // html要素に特に指定していない場合はブラウザで「font-size:16px」となる。
  // 今回の場合「padding:4rem 0」だと16×4で64pxになる。
  // でもなんで「font-size」なのかが分からないので本当にこれが依存先なのかもう少し調べる。
  padding: 4rem 0;
  margin-top: 20px;
  &__element-wrap{
    max-width: 1000px;
    overflow: hidden;
    margin:0 auto;
  }
  &__element-copyrightTitle{
    font-size: 2em;
  }
  &__element-copyright{
    height: 103px;
    width: 326px;
    color: #fff;
    margin-right: 10px;
    float: left;
  }
  &__element-link{
    height: 93px;
    width: 326px;
    color: #fff;
    margin-right: 10px;
    float: left;
  }
  &__element-sns{
    height: 93px;
    width: 326px;
    color: #fff;
    float: left;
  }
}
</style>
