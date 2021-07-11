<template>
  <div>
    <div class="revRegistJr-content__form-element">
      <div class="revRegistJr-content__form-wrap">
        <h4 class="revRegistJr-content__title">{{ setting.contentTitle }}</h4>
        <h1 class="revRegistJr-content__sub">{{ setting.contentSubTitle }}</h1>
        <InputForm
          :setting="setting"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Intro from '@/components/intro/Intro'
import InputForm from '@/components/inputForm/inputForm'
export default {
  components: {
    Intro,
    InputForm
  },
  props:{
    setting: {
      type: Array,
      required: true
    },
  },
};
</script>

<style lang="scss" scoped>
.revRegistJr-content{
  height: 880px;
  width: 100%;
  background-color: #fff;
  overflow: hidden;
  &__wrap{
    max-width: 1000px;
    margin: 30px auto;
  }
  &__form-element{
    height: 830px;
    width: 630px;
    margin-left: 70px;
    border-radius: 10px;
    float: left;
    background-color: #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  }
  &__form-wrap{
    margin: 50px auto;
    max-width: 480px;
  }
  &__title{
    font-size: 2rem;
    text-align: center;
  }
  &__sub{
    text-align: center;
  }
  &__form{
    margin: 40px;
  }
  &__input{
    height: 27px;
    width: 100%;
    margin-bottom: 40px;
    display: block;
    border: 0;
    border-bottom: 1px solid #b4becb;
    &::placeholder{
      font-size: 15px;
    }
    &:last-child{
      margin-bottom: 0px;
    }
    &:focus{
      outline: none;
      border-bottom: 1px solid #047aed;
    }
  }
  &__bottom-wrap{
    margin-top: 60px;
    height: 41px;
    width: 412px;
  }
  &__bottom-link{
    text-decoration: none;
  }
  &__bottom-cancel{
    padding: 10px 15px;
    background-color: #fff;
    color: #06D1EC;
    border: none;
    border: 1px solid #06D1EC;
  }
  &__bottom-next{
    padding: 10px 47px;
    margin-left: 50px;
    background-color: #06D1EC;
    color: #fff;
    border: none;
    border: 1px solid #fff;
  }
}
</style>
