<template>
  <div>
    <Hero/>
    <Review/>
    <About/>
    <Contact/>
  </div>
</template>

<script scoped>
import Hero from '@/components/home/hero/Index';
import Review from '@/components/home/review/Index';
import About from '@/components/home/about/Index';
import Contact from '@/components/home/contact/Index';

export default {
  components: {
    Hero,
    Review,
    About,
    Contact
  },
}
</script>
