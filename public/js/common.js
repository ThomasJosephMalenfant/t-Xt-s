// TODO Transformer en un seul objet avec différentes méthodes ?
const getTextes = async (rqt) => {
let url = "/api/textes/" + encodeURI(rqt) ;
const reponse = await fetch(url, {
        credentials: 'same-origin',
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
            },
        mode: "same-origin",
    });
    if (reponse.ok) {
        return reponse.json();
    }
    throw new Error("Erreur fatale");
}

// FIXME : curseur retourne au début du textarea cf. https://stackoverflow.com/questions/6249095/how-to-set-the-caret-cursor-position-in-a-contenteditable-element-div

function remplacer(element,rqt,json){
    const pericope = document.createElement("txts-pericope");
    const titre = document.createElement("h3");
    titre.textContent = rqt ;
    pericope.appendChild(titre);
    json.forEach(jsonElement => {
        let tVerset = document.createElement("txts-verset");
        tVerset.dataset.id =  jsonElement["id"] ;
        tVerset.dataset.chapitre =  jsonElement["chapitre"] ;
        tVerset.dataset.verset = jsonElement["verset"] ;
        tVerset.dataset.livre =  jsonElement["livres_id"] ;
        tVerset.textContent = jsonElement["texte"] ;
        pericope.appendChild(tVerset);
    });
    document.getElementById(element).appendChild(pericope);
}

function checkContent() {
    let element = "editeur";
    let tests = {
        "tXts" : {
            "in" : "|+",
            "out": "+|",
        },
        "bold" : {
            "in" : "**",
            "out": "**",
        },
    }

    let inner = document.getElementById(element).innerHTML ;
    
    for (test in tests) {
        //FIXME Plus robuste si cherche explicitement le "out" après le "in"
        let test_in = inner.indexOf(tests[test]["in"]) + 2 ;
        let test_out = inner.indexOf(tests[test]["out"]);

        if (test_out > test_in) {
            let rqt = inner.substring(test_in,test_out) ;
            getTextes(rqt)
            .then((resultat) => remplacer(element,rqt, resultat))
                .catch((erreur) => console.log(erreur));
        }
    }
}
