

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
document.querySelector("form").addEventListener('submit',e=>{
        e.preventDefault();
        sendMail()
    }
)
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