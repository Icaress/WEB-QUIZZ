function show(section){
    document.querySelectorAll('.section').forEach(el => el.style.display = 'none');
    document.getElementById(section).style.display = "block";

    document.querySelectorAll('.nbr').forEach(el => el.classList.remove('active'));
    const btn = document.querySelector(`.nbr[onclick="show('${section}')"]`);
    if(btn) btn.classList.add('active');
}
