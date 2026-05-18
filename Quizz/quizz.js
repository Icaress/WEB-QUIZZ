const params = new URLSearchParams(window.location.search);
if(params.has("catégorie") && !params.has("section")) {
    window.location.href = "quizz.php?date=" + encodeURIComponent(date) + "&section=1";
}

let time_display = document.getElementById("time_display");
let timer;

timer = setInterval( () => {
    seconds--;
    const hrs = String(Math.floor(seconds / 3600)).padStart(2, "0");
    const mins = String(Math.floor( (seconds % 3600) / 60)).padStart(2, "0");
    const secs  = String(Math.floor(seconds % 60)).padStart(2, "0");
    time_display.textContent = mins +":"+ secs ;

    if (seconds <= 0){
        clearInterval(timer);
        document.getElementById("end_quizz").click();
    }

},1000);