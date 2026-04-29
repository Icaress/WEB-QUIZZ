document.addEventListener('DOMContentLoaded', function(){
    console.log('JS chargé');
    const select = document.getElementById('select_cat');
    console.log(select); // doit afficher l'élément select
    
    select.addEventListener('change', function(){
        const nom_choisie = this.options[this.selectedIndex].text;
        console.log(nom_choisie); // doit afficher le nom quand tu changes
        document.getElementById('nom_cat').innerText = nom_choisie;
    });
});