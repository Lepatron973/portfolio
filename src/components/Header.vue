<template>
  <div id="header" class="sticky-top">
    <!-- navbar desktop -->
    <ul class="nav navbar bg-light desktop">
        <li class="nav-item"><a href="#technos"><i class="far fa-file-code"></i><span class="ml-2">Technos</span></a></li>
        <li class="nav-item"><a href="#about"><i class="fas fa-address-card"></i><span class="ml-2">À mon sujet</span></a></li>
        <li class="nav-item"><a href="#home"><i class="fas fa-home"></i><span class="ml-2">Jeremy Joseph</span></a></li>
        <li class="nav-item"><a href="#project"><i class="fas fa-project-diagram"></i><span class="ml-2">Mes projets</span></a></li>
        <li class="nav-item"><a href="#contact"><i class="fas fa-file-signature"></i><span class="ml-2" >Contact</span></a></li>
    </ul>
    <!-- navbar mobile -->
     <ul class="nav navbar bg-light mobile">
        <li class="nav-item"><a href="#home"><i class="fas fa-home"></i><span class="ml-2">Jeremy Joseph</span></a><button id="btnSlideNav" class="ml-3" @click="collapse"><i class="fas fa-bars"></i></button></li>
    </ul>
   <!-- sideNav -->
    <nav class="bg-dark " id="sideNav" :class="[navBar ? 'slideShow' : 'slideHide']">
        <li class="nav-item m-2"><a href="#technos" ><i class="far fa-file-code"></i><span class="ml-2">Technos</span></a> <a href="#close" class="close" @click="collapse"><i class="fas fa-window-close float-right"></i></a></li>
        <li class="nav-item m-2"><a href="#about" ><i class="fas fa-address-card"></i><span class="ml-2">À mon sujet</span></a></li>
        <li class="nav-item m-2"><a href="#home" ><i class="fas fa-home"></i><span class="ml-2">Accueil</span></a></li>
        <li class="nav-item m-2"><a href="#project" ><i class="fas fa-project-diagram"></i><span class="ml-2">Mes projets</span></a></li>
        <li class="nav-item m-2"><a href="#contact" ><i class="fas fa-file-signature"></i><span class="ml-2" >Contact</span></a></li>
    </nav>
   <!-- end sideNav -->
    
  </div>
</template>

<script>
export default {
  name: 'Header',
  props: {
    msg: String
  },
  data: function(){
    return {
      navBar: false
    }
  },
  methods: {
    collapse: function(e){
      this.navBar = !this.navBar;
      let btnSLide = document.getElementById("btnSlideNav");
      btnSLide.addEventListener('click',this.timeoutSlide(e)) 
    },
    timeoutSlide: function(event){
      event.preventDefault();
      let sideNav = document.getElementById("sideNav")
      let state = this.navBar ? "block" : "none";
      if (this.navBar) {
        sideNav.style.display = state
      }else{
        setTimeout(()=>{sideNav.style.display = state},1000)
      }    
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@keyframes head{
  from {
    background: wheat;
    border:1px solid rosybrown;
    border-radius: 10px;
    color: #42b983;
  }
  to{
    
    border:1px solid rebeccapurple;
    border-radius: 7px;
    background: green;
    color: white;
  }
}
@keyframes slideHide{
  from{
    right: 0%;
  }
  to{
    right: -55%;
  }
}
@keyframes slideShow{
  from{
    right: -55%;
  }
  to{
    right: 0%;
  }
}

a {
  color: #42b983;
  font-size: 20px;
}
a:not(.close):hover{
  padding:2px;
  border-radius: 8px;
  box-shadow: 4px 8px 6px teal;
  animation: head 2s linear;
}
.mobile{
  display: none;
}
#sideNav{
  display: none;
}
#btnSlideNav{
  border-radius: 7px;
  background: whitesmoke;
  color: #42b983;
}

@media screen and (max-width: 700px) {
  
  .desktop{
    display: none !important;
  }
  .mobile{
    display: flex;
    justify-content: center;
  }
  #sideNav{
    height: 80vh;
    float: right;
    right: 0%;
    position: absolute;
    width: 55%;
    padding: 5px;
    
  }
  .slideShow{
    animation: slideShow 1s linear forwards;
  }
  .slideHide{
    animation: slideHide 1s linear forwards;
  }

  li{
    list-style: none;
  }
  
}
</style>
