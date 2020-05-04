<template>
    <div id="project" class="container jumbotron">
        <h3 class="text-center">Mes projets</h3>
        <div class="d-flex justify-content-center">
            <nav class="nav nav-tabs justify-content-center bg-light mb-3 col-lg-4 p-1 rounded">
                <li class="nav-item">
                    <a class="nav-link tous" :class="{active: isActive }"  href="#tous" @click="changeCurrentClass">Tous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js" href="#js" @click="changeCurrentClass">Js</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link php" href="#php" @click="changeCurrentClass">Php</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link wordpress" href="#wp" @click="changeCurrentClass">Wordpress</a>
                </li>
            </nav>
        </div>
        <ul id="myProject" class="col-12 d-flex flex-wrap bg-light p-3">
            <template v-if="curTarget.hash == '#tous' || curTarget == 'tous' ">  
                <li class=" text-center col-lg-4 col-sm-12" v-for="project in projects" :key="project.name">
                    <div class="card">
                        <img :src="project.image" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"> {{project.name}} </h5>
                            <p class="card-text">{{project.description}}</p>
                            <button class="btn btn-primary"><a :href="project.lien" target="_blank">Découvrir</a></button>
                        </div>
                    </div>
                </li>
            </template>
            <template v-else-if="curTarget.hash == '#js'">  
                <li class=" text-center col-lg-4 col-sm-12" v-for="project in projects" :key="project.name">
                    <template v-if=" project.class[1] == 'js'">
                        <div class="card">
                            <img :src="project.image" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"> {{project.name}} </h5>
                                <p class="card-text">{{project.description}}</p>
                                <button class="btn btn-primary"><a :href="project.lien" target="_blank">Découvrir</a></button>
                            </div>
                        </div>
                    </template>
                </li>
            </template>
             <template v-else-if="curTarget.hash == '#php'">  
                <li class=" text-center col-lg-4 col-sm-12" v-for="project in projects" :key="project.name">
                    <template v-if=" project.class[1] == 'php'">
                        <div class="card">
                            <img :src="project.image" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"> {{project.name}} </h5>
                                <p class="card-text">{{project.description}}</p>
                                <button class="btn btn-primary"><a :href="project.lien" target="_blank">Découvrir</a></button>
                            </div>
                        </div>
                    </template>
                </li>
            </template>
             <template v-else-if="curTarget.hash == '#wp'">  
                <li class=" text-center col-lg-4 col-sm-12" v-for="project in projects" :key="project.name">
                    <template v-if=" project.class[1] == 'wordpress'">
                        <div class="card">
                            <img :src="project.image" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"> {{project.name}} </h5>
                                <p class="card-text">{{project.description}}</p>
                                <button class="btn btn-primary"><a :href="project.lien" target="_blank">Découvrir</a></button>
                            </div>
                        </div>
                    </template>
                </li>
            </template>
             <!-- <template v-else-if="curTarget.hash == '#wp'">  
                <li class="card text-center col-lg-4 col-sm-12" v-for="project in projects" :key="project.name">
                    <template v-if=" project.class[1] == 'wordpress'">
                        <div class="card">
                            <img src="../assets/screen_yanaswag.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"> {{project.name}} </h5>
                                <p class="card-text">{{project.description}}</p>
                                <a :href="project.lien" class="btn-btn-primary"></a>
                            </div>  
                        </div>
                    </template>
                </li>
            </template> -->
          
        </ul>

    </div>
</template>
<script>
export default {
    name: "Projects",
    data: ()=>{
        return {
            activeClass: "tous",
            curTarget: "tous",
            prevTarget: document.getElementsByClassName('tous'),
            isActive: true,
            projects: [
                {
                    name:"space-bullet",
                    class:["tous","js"],
                    image:"img/space.png",
                    description:"Ce projets à été conçu lors de la GameJam 2019 qui s'est déroulé à l'ifa lors de ma formation de développeur web. C'est un petit jeu web créé avec le framework phaser. J'ai créé ce jeu avec un collègue: Cédric Famibelle, le jeu est hébergé sur son serveur.",
                    show: true  ,
                    lien:"https://cedric-famibelle.fr/space_bullet/"                 
                },
                // {
                //     name:"tchat-room",
                //     class:["tous","js"],
                //     image:"/img/tchat.png",
                //     description:'C\'est une petite application de tchat instantané que j\'ai créé avec Node js, Express et Socket.io. ',
                //     show: true,
                //     lien:'http://localhost:8000'
                // },
                {
                    name:"shop_template",
                    class:["tous","php"],
                    image:"img/shop_theme.png",
                    description:'Ce site est le projet actuel sur lequel je travail. C\'est un template personnalisable de boutique en ligne full responsive, l\'accès à l\'espace admin est libre pour avoir un aperçu. Il est développé from scratch sans framework en POO avec l\'architecture MVC. ',
                    show: true,
                    lien:'http://jeremy-joseph.cf'
                },
                {
                    name:"yanaswag",
                    class:["tous","wordpress" ] ,
                    image:'img/screen_yanaswag.png',
                    description:"Ce projet est une boutique en ligne que j'ai créé pour un client. J'ai utilisé wordpress pour créer le site, j'ai hébergé le site sur un serveur google que j'ai moi même paramétré. J'ai ainsi du acheter le nom de domaine et le certifier avec letsencrypt.",
                    show: true,
                    lien:"https:www.yanaswag.ml"                   
                }
            ]
                
            
        }
    },
    methods:{
        changeCurrentClass: function(e){
            
            this.activeClass = e.target.innerHTML.toLowerCase();
            e.target.classList.remove("active");
            e.target.classList.add('active');
            this.curTarget = e.target;
            
            

            if(this.curTarget != this.prevTarget[0] && this.prevTarget[0] != undefined){
                this.prevTarget[0].classList.remove("active");
                this.prevTarget = this.curTarget
                
            }else if(this.prevTarget != undefined && this.prevTarget[0] == undefined ){
                
                this.prevTarget.classList.remove("active");
                this.prevTarget = this.curTarget
                
            }
            
        },
        test: function(e){
            alert(e.target)
        }
    }
}
</script>
<style  scoped>

a{
    color:black;
}
a:hover{
    color: #42b983;
}
li{
    list-style: none;
}
.card{
    border: 6px solid;
    border-image: url("https://i.gifer.com/77Y.gif") 10;
    padding: 20px;
}
</style>