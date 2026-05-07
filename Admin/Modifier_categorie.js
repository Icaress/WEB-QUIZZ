document.addEventListener('DOMContentLoaded', function(){
    const select = document.getElementById('select_cat');    
    select.addEventListener('change', function(){
        const nom_choisie = this.options[this.selectedIndex].text;
        document.getElementById('nom_cat').innerText = nom_choisie;
    });
});