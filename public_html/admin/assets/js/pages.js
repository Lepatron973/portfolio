export function ManageProjectPage(){
    let projectPage = `
    <section class="project-list">
        <h2 class="text-center">Liste des projets</h2>
        <button class="btn btn-success add mx-3">Ajouter</button>
        <div class="d-lg-flex card-container d-md-flex overflow-x-scroll">
            
        </div>
    </section>
    `;
    $('.root').html(projectPage);
}

export function Home(){
    let projectPage = `
    <section class="home-page">
        <h2 class="text-center">Bienvenu sur le panel d'administration</h2>
    </section>
    `;
    $('.root').html(projectPage);
}