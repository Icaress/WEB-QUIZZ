const params = new URLSearchParams(window.location.search);
if(params.has("catégorie") && !params.has("section")) {
    window.location.href = "quizz.php?date=" + encodeURIComponent(date) + "&section=1";
}
