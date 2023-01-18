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

export function Plugin(){
    let projectPage = `
    <section class="add-plugin-section">
        <h2 class="text-center">Gestion des plugins</h2>
        
        
            <div class="p-3">
                <label for="formFile" class="form-label px-2">Ajouter un plugin</label>
                <input class="form-control plugin-input px-2" name="plugin" type="file" id="formFile">
                <button class="btn btn-primary add-plugin my-3 px-2">Enregistrer</button>
            </div>
        
    </section>
    <section class="plugin-list">
        <h2 class="text-center">Liste des plugins</h2>
        
        <div class="d-lg-flex card-container d-md-flex overflow-x-scroll">
            
        </div>
    </section>
    `;
    $('.root').html(projectPage);
}