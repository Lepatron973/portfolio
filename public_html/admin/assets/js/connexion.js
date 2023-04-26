
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit',(e)=>{
        e.preventDefault();
        let data = {
            ref: "pseudo",
            value: document.querySelector('.pseudo').value,
            password: document.querySelector('.password').value
        }
        fetch('./api/?path=user&action=connexion',{
            method:'POST',
            body: JSON.stringify(data)
        })
        .then(res=>res.json())
        .then(res=>{
            res = res[0];
            if(res.result){
                document.querySelector('form').submit()
            }
            
        })
    })
}, false);