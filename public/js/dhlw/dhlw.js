class Txts extends HTMLElement {
    constructor() {
        super() ;
    }
}

class Pericope extends HTMLElement {
    constructor() {
        super();
    }
}

class Assembleur extends HTMLDivElement {

  constructor() {
    // Always call super first in constructor
    self = super();
  }

  connectedCallback() {
    self.contentEditable = true ;
    self.spellcheck = false;
    
    const placeHold = document.createElement("p");
    placeHold.innerText = "Texte ici ?";
    
    self.appendChild(placeHold);
    console.log("Custom element added to page.");
  }

  attributeChangedCallback(name, oldValue, newValue) {
    console.log(`Attribute ${name} has changed from ${oldValue} to ${newValue}.`);
  }
}

customElements.define("t-xt-s", Txts);
customElements.define("peri-cope", Pericope);
customElements.define("a-ssembleur", Assembleur, { extends:"div"});

function checkRef() {
    // Traverse childNode("p") ;
    // Compare Début du node avec liste de Corpus, puis liste CorpusDefault.Version, puis liste VersionDefault.Livre[Abbr]
    // Si true, change "p" en "peri-cope"
    
}