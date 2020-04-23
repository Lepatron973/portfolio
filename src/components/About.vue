<template>
    <div id="about" class="container">
        <div class="jumbotron">
            <h3><i class="fas fa-info-circle"></i> À propos de moi</h3>
            <div class="d-flex">
                <p class="col-lg-6"> {{info.text}} </p>
                <img class="col-lg-6 d-lg-block d-md-block d-none" :src="info.image" alt="">

            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "About",
    data: ()=>{
        return {
            info: {
                text:"Je suis un développeur super enthousiaste, joyeux et très sociable.J'ai découvert le développement web lors d'une initiation aux métiers de l'informatique et depuis je ne peux plus m'en passer.",
                image:"https://amp.agoravox.fr/local/cache-vignettes/L570xH311/Matrix01-6cb89.jpg"
           }
        }
    }
}
</script>