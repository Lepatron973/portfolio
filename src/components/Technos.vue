<template>
    <div id="technos" class="container d-flex flex-column justify-content-center">
        <div class="col-lg-12 d-flex flex-wrap justify-content-center">
        <h2 class="text-center bg-light col-lg-10 col-md-8 border rounded">Mes Technos</h2>
                <div v-for="(techno,name) in technos" :key="techno.text" class="col-lg-5 col-md-4 m-1 jumbotron descTech">
                        
                        <h4><i class=" bg-greeny p-2 text-light" :class="techno.icon"></i> {{name}}</h4>
                        <p>{{techno.text}}</p>
                        
                    
                </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Technos',
    data: ()=>{
        return {
            technos: {
                
                FRONT:{
                    text:"Mes technos Front sont le HTML,CSS, Javascript, la base. J'utilise les Frameworks Bootsrtap et Vue JS pour la performance. J'utilise aussi wordpress selon les projets et le contexte.",
                    icon:"fas fa-house-damage",
                },
                BACK:{
                    text:"Pour mon développement Back j'aime beaucoup utilisé Node JS, je le couple à Express. J'utilise aussi le développement Back avec PHP et le framework Symfony",
                    icon:"fab fa-php",
                },
                
                OS:{
                    text:"Fervant utilisateur de Linux je développe principalement sur ce système d'exploitation.",
                    icon:"fab fa-ubuntu"
                },
                BDD:{
                    text:"Selon les projets j'utilise différentes Base de données, Mysql pour les projets PHP et Node, MongoDB, Firebase pour Node et Vue js.",
                    icon:"fas fa-database"
                },
                SERVER:{
                    text:"Le server que j'utilise le plus souvent est apache, facile à prendre en main c'est le premier serveur avec lequel j'ai développé.",
                    icon:"fas fa-server"
                }
            }
        }
    }
}
</script>
<style scoped>
    .descTech:hover{
        box-shadow: 4px 6px 7px 10px  rosybrown;
        transform: scale(1.1,1.1);
        z-index: 1;
    
    border: 6px solid;
    border-image: url("https://i.gifer.com/77Y.gif") 10;
    padding: 20px;
}
.bg-greeny{
    background: #42b983;
    border-radius: 50%;
}
</style>