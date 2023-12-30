// TODO Transformer en un seul objet avec différentes méthodes ?

const getTextes = async (rqt) => {
    let url = "http://localhost/api/textes/" + encodeURI(rqt) ;
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
    let versets = "";
    json.forEach(element => { versets += "<br>" + element["texte"] });
    versets = versets.trim();
    document.getElementById(element).innerHTML = 
    document.getElementById(element).innerHTML.replace("|+" + rqt + "+|", versets);
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