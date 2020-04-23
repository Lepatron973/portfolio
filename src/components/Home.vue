<template>
    <div id="home" class="bg-light container-fluid">
        <div class="d-flex justify-content-center pt-4">
            <div class="jumbotron col-lg-5">
                <h1>Je suis {{user.name}} {{user.first_name}}</h1>
                <h4>{{user.status}} situé à {{user.place}}</h4>
                <h5>{{user.description}}</h5>
                <div class="col-12 d-flex justify-content-center pt-3">
                    <button class="btn btn-success"><a href="#project" class="text-light">Mes créations</a></button>
                </div>
            </div>
            <img class="col-lg-5 jumbotron d-none d-lg-block d-md-block" :src="user.image" alt="">
        </div>
    </div>
</template>
<script>
export default {
    name: "Home",
    data: ()=>{
        return {
            user: {
                name: 'Joseph',
                first_name: 'Jeremy',
                status: "Développeur Web",
                description:"Passionné par la programmation j'aspire à acquérir des compétences dans plusieurs domaines, telles que le front-end, back-end , environement serveur. Je suis actuellement une formation de développeur d'application PHP/Symfony avec OpenClassroom afin de me spécialiser sur ce Framework, mais mon engouement pour les autres technos est toujours le même. Ce site est crée avec le framework Vue-js et Bootstrap.",
                place: "Metz",
                image: "https://www.mikecodeur.com/wp-content/uploads/2019/08/developer-coding-in-php_4460x4460-e1565856272388.jpg"
            }
        }
    }
}
</script>
<style scoped>
    #home{
        background-size: cover;
        height: 60em;
        
    }
    @media screen and (max-width: 600px){
        #home{
            height: 50em;
        }
    }
    
</style>