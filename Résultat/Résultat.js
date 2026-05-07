function CreeCases(nbrQuestion, reponse){
    let conteneur = document.getElementById("case");

    for(let i = 1; i <= nbrQuestion; i++){
        let CaseDiv = document.createElement("div");
        CaseDiv.textContent = i;
        CaseDiv.classList.add("case");

        if(reponse[i] == true){
            CaseDiv.classList.add("Correct");
        }else{
            CaseDiv.classList.add("Incorrect");
        }

        conteneur.appendChild('CaseDiv');
    }
}