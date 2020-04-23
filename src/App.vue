<template>
  <div id="app">
    <Header class=""/>
      <Home />
      <Technos class="mt-5"/>
      <About class="mt-5"/>
      <Projects class="mt-5"/>
      <Footer />
  </div>
</template>

<script>
import Header from './components/Header'
import Home from './components/Home'
import Technos from './components/Technos'
import About from './components/About'
import Projects from './components/Projects'
import Footer from './components/Footer'
export default {
  name: 'App',
  components: {
    Header,
    Home,
    Technos,
    About,
    Projects,
    Footer
  }
}
</script>

<style>
  html, #app{
    background: url("https://i.pinimg.com/originals/16/02/b2/1602b26c05ee78120695d592a68b8912.gif");
  }
  html{
    margin: 0px;
    padding: 0px;
  }
  h2,h3{
    color: #42b983;
  }
</style>
