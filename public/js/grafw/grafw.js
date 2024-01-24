function populer(cible,liste,test,value){

    let frag = document.createDocumentFragment();
    liste.forEach(item => {
        if (item[test] === value ) {
            let option = document.createElement("option") ;
            option.value = item.id ;
            option.innerText = item.nom ;
            frag.appendChild(option);
        }
    });
    if (frag.hasChildNodes()){
        cible.appendChild(frag);
        cible.disabled = false ;
    }
}

function updateDrop(source,cible){

    cible.innerHTML = "";
    cible.disabled = true;

    grabApi(cible.id)
            .then((liste) => populer(cible,liste, source.id + "_id", source.value))
                .catch((erreur) => console.log(erreur));
}

let el_corpus = document.getElementById("corpus") ;
let el_versions = document.getElementById("versions") ;
let el_livres = document.getElementById("livres") ;

el_corpus.addEventListener("change", (event) => updateDrop(el_corpus,el_versions));
el_versions.addEventListener("change", (event) => updateDrop(el_versions,el_livres));