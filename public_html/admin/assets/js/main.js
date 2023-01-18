import { ManageProjectPage,Home,Plugin } from "./pages.js";
import {closeModal,add,generateProjectCard,generatePluginCard,addPlugin} from  './utilities.js';
// $('.nav-link').on('click',()=>{
//     console.log($('body').append('<script src="../../plugins/php-stripe/public/assets/js/main.js"></script>'))
// })
/////évènements////////

$('.close').on('click',closeModal)
$('.leave').on('click',disconect)
$('.nav-link').on('click',navigation)
// ///afichahe page d'accueil
Home();

//////////////////////Functions///////////////////////
function navigation(){
    $('.plugin-script').html('')
    switch ($(this).prop('hash')) {
        case "#dashboard":
            Home();
            break;
        case "#portfolio":
            ManageProjectPage();
            generateProjectCard();
            $('.add').on('click',add)
           $('.modal').removeClass('d-none')
            break;
        case "#plugins":
            Plugin()
            generatePluginCard()
            $('.add-plugin').on('click',addPlugin)
            break;
        default:
            $('.plugin-script').html(`<script src="../../plugins/${$(this).text().trim()}/public/assets/js/main.js"></script>`)
            break;
    }
}

function disconect(){
    localStorage.removeItem('connexion');
    location.reload();
}
