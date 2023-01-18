///////affiche la modal
export function openAddModal(){
    console.log('open')
    $('.modal').css('display','block');
}
////permet d'ajouter un projet
export function add(){
    console.log('add')
    openAddModal();
    $('.modal-title').html('Ajouter un projet')
    $('.save').on('click',()=>manageProject("addProject"))

}
////permet de modifier un projet
export function edit(){
    openAddModal();
    $('.modal-title').html('Modifier un projet')
    let project_type = $(this).parents('.card-body').children('.type').children('.type_value').text() == "Professionel" ? true : false;
    $('input[name=name]').val($(this).parents('.card').children('h3').text())
    $('input[name=link]').val($(this).parents('.card-body').children('.link').children('.link_value').text())
    $('select').val($(this).parents('.card-body').children('.category').children('.category_name').text())
    $('input[type=checkbox]').prop('checked',project_type)
    $('.save').on('click',()=>manageProject("updateProject",parseInt($(this).parents('.card').prop('attributes').ref.value)))
}


///////////permet de supprimer un projet
export function deleteProject(){
    let data = {
        ref: "id",
        value : parseInt($(this).parents('.card').prop('attributes').ref.value)
    }
    fetch('./?path=projects&action=deleteProject',{
    method:'POST',
    body: JSON.stringify(data)
   }).then(res=> generateProjectCard())
}

///////permet d'afficher les différents projet
export async function generateProjectCard(){
    $('.card-container').html('');
    let projects = await fetch('./?path=projects&action=getAllProjects').then(res=>res.json()).then(res=>res)
    projects.map(project=>{
        $('.card-container').append(`
            <div class="card col-lg-5 col-md-7 col-10 m-3" ref=${project.id}>
                <h3 class="card-header name">${project.name}</h3>
                <div class="d-lg-flex p-3">
                    <img src="./imgs/${project.image}" class="card-img image" style="height: 200px;width: 200px;" alt="...">
                    <div class="card-body">
                    <h6 class="card-title category">Catégorie: <span class="category_name">${project.category}</span></h6>
                    <h6 class="card-title type">Type: <span class="type_value">${project.type}</span></h6>
                    <p class="card-text link">Lien: <span class="link_value">${project.link}</span></p>
                    <a href="#" class="btn btn-warning edit">Modifier</a>
                    <a href="#" class="btn btn-danger del">supprimer</a>
                    </div>
                </div>
            </div>
        `)
    })
    $('.del').on('click',deleteProject)
    $('.edit').on('click',edit)
}

///////////permet d'ajouter ou modifier un projet
export function manageProject(action,id=null){
    let data = {};
    if(id != null)
        data.id = id;
   for(const input of $('.input')){
       
       switch ($(input).prop("type")) {
           case 'checkbox':
               data.type = $(input).prop("checked") ? 'Professionnel' : "Personnel";
               break;
           case 'file':
               data.image = $(input).prop("files")[0];
               break;
           default:
               data[$(input).prop('name')] = $(input).val();
               break;
       }
    }
    let formData = new FormData();

    for (const key in data) {
        formData.append(key,data[key]);
    
    };
   fetch(`./?path=projects&action=${action}`,{
        method: 'POST', // or 'PUT'
        body: formData,
   })
   .then(res=>res.json())
   .then(res=>{
        closeModal();
        $('.alert').html('');
        res.map(val=>{
            $('.alert').append(`<p> La fonction: <span class="text-${ (val.result == true ? "success" : "danger") }"> "${val.function}"</span> à eu le résultat suivant:<span class="text-${ (val.result == true ? "success" : "danger") }"> ${val.result} </span></p>`)
        })
        $('.alert').removeClass('d-none');
        generateProjectCard();
   })
   $('.alert').on('click',()=>{
        $('.alert').addClass('d-none')
   })
   $('.save').off()
}
///////permet de cacher la modal
export function closeModal(){
    $('.modal').css('display','none')
    $('input[type=text]').val('')
    $('input[type=checkbox]').prop('checked',false)
    $('select').val(1)
}

////permet de générer des lien dans la bare lattérale

export async function  generatePluginCard(){
    $('.card-container').html('');
let plugins = await fetch('./?path=plugin&action=getAllPlugins').then(res=>res.json()).then(res=>res);
    plugins.map(plugin=>{
        $('.card-container').append(`
            <div class="card col-lg-5 col-md-7 col-10 m-3" ref=${plugin.id}>
                <h3 class="card-header name">${plugin.name}</h3>
                <div class="d-lg-flex p-3">
                    <img src="../../plugins/${plugin.name}/${plugin.image}" class="card-img image" style="height: 200px;width: 200px;" alt="...">
                    <div class="card-body">
                        <h6 class="card-api-key type">Clé API: <input type="text" class="form-control my-2 api-key" value="${plugin.api_key}" /></h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input input plugin-status" name="status" ${(plugin.status ? 'checked' : '')} type="checkbox" role="switch">
                            <label class="form-check-label status-label">${(plugin.status ? 'Désactiver' : 'Activer')}</label>
                        </div>
                        <button  class="btn btn-warning edit-plugin my-2">modifer</button>
                        <button  class="btn btn-danger del-plugin my-2">supprimer</button>
                    </div>
                </div>
            </div>
        `)
        $('.plugin-status').on('click',(e)=>{
            let status = $(e.target).prop('checked') == false ? 0 : 1 ;
            fetch("./?path=plugin&action=updatePlugin",{
                method: "POST",
                body: JSON.stringify({id:plugin.id,status: status})
            })
            ($(e.target).prop('checked') ? $('.status-label').html('Désactiver') : $('.status-label').html('Activer'))
        })
        $('.del-plugin').on('click',()=>{
            delPlugin(plugin.id,plugin.name);
        })
        $('.edit-plugin').on('click',()=>{
            editPlugin(plugin.id,$('.api-key').val())
        })
       
    })
    
}

export function addPlugin(){
    let formData = new FormData();
    let plugin = $('.plugin-input').prop("files")[0];
    formData.append('plugin',plugin);
    fetch('./?path=plugin&action=addPlugin',{
        method:'POST',
        body:formData
    }).then(res=> location.reload())
}
export function editPlugin(id,api_key){
    let data = {
        id: id,
        api_key: api_key
    }
    if(api_key != ""){

        fetch('./?path=plugin&action=updatePlugin',{
            method:'POST',
            body:JSON.stringify(data)
        }).then(res=> generatePluginCard())
    }
    
    
}

export function delPlugin(id,name){
    let data = {
        id: id,
        name : name
    }
    fetch('./?path=plugin&action=deletePlugin',{
    method:'POST',
    body: JSON.stringify(data)
   }).then(res=>location.reload())
}



