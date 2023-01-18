

$(document).ready(function(){
    $(".navbar .nav-link").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 700, function(){
                window.location.hash = hash;
            });
        } 
    });
});

// navbar toggle
$('#nav-toggle').click(function(){
    $(this).toggleClass('is-active')
    $('ul.nav').toggleClass('show');
});
let alertDiv = document.querySelector(".alert");
//envoie d'un e-mail
document.querySelector(".contact-form").addEventListener('submit',e=>{
        e.preventDefault();
        sendMail()
    }
)
$('.nav-link').on('click',selectProject)
fetch('./admin/api/?path=projects&action=getAllProjects').then(res=>res.json()).then(res=>{
    res.map(project=>{
        $('.project-container').append(projectCard(project))
    })
})
function sendMail(){
    let formData = {
        name: document.querySelector(".name").value,
        email: document.querySelector(".email").value,
        message: document.querySelector(".message").value
    }
   
    fetch("http://mailadmin.alwaysdata.net/mail.php",{
        method:"POST",
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
        },
        body:JSON.stringify(formData)
    }).then(res=> {
        if(res.status === 200){
            displayAlert("Votre email a bien été envoyé");
        }else{
            displayAlert("Une erreur est survenu le mail n'a pas pu être envoyé","alert-danger");
        }
    })
}
function displayAlert(message,color="alert-success"){

    alertDiv.innerHTML = message;
    alertDiv.classList.add(color)
    alertDiv.style.display="block";
    setTimeout(() => {
        alertDiv.innerHTML = "";
        alertDiv.style.display="none"; 
        alertDiv.classList.remove(color)
    }, 3000);
}
function projectCard(data){
    let card = `
    <div class="col-md-4 project ${data.type}">
        <a href="${data.link}" target="_blank" class="portfolio-card">
            <img src="./admin/api/imgs/${data.image}"  class="portfolio-card-img" alt="${data.name}">    
            <span class="portfolio-card-overlay">
                <span class="portfolio-card-caption">
                    <h4>${data.name}</h5>
                    <p class="font-weight-normal">Catégorie: ${data.category}</p>
                    <p class="font-weight-normal">Type: ${data.type}</p>
                </span>                         
            </span>                     
        </a>
    </div>
    `
    return card;
}
function selectProject(){
    $('.nav-link').removeClass('active')
    $(this).addClass('active')
    switch ($(this).text()) {
        case "Tout":
            $('.project').show('slow')
            break;
            case "Pro":
                $('.Professionel').show("slow")
                $('.Personnel').hide("slow")
            break;
            case "Perso":
                $('.Personnel').show("slow")
                $('.Professionel').hide("slow")
            break;
        default:
            break;
    }
}