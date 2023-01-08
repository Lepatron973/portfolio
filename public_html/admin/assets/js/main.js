import { ManageProjectPage,Home } from "./pages.js";
import {closeModal,add,generateProjectCard} from  './utilities.js';
/////évènements////////
$('.close').on('click',closeModal)
$('.leave').on('click',disconect)
$('.nav-link').on('click',navigation)
///afichahe page d'accueil
Home();
//////////////////////Functions///////////////////////
function navigation(){
    switch ($(this).prop('hash')) {
        case "#home":
            Home();
            break;
        case "#projects":
            ManageProjectPage();
            generateProjectCard();
            $('.add').on('click',add)
           $('.modal').removeClass('d-none')
            break;
        default:
            break;
    }
}

function disconect(){
    localStorage.removeItem('connexion');
    location.reload();
}