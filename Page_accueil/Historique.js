const menu = document.querySelector("#filtre-toggle");
const boutons = document.querySelector("#filtre-container");

function toggler() {
    if (boutons.style.display == "block") {
        boutons.style.display = "none";
    } else {
        boutons.style.display = "block";
    }
}

function show_category(id) {
    document.querySelectorAll(".category_results").forEach((result) => {
        if (result.dataset.category == id) {
            result.style.display = "flex";
        } else {
            result.style.display = "none";
        }
    });
}

function show_all_category() {
    document.querySelectorAll(".category_results").forEach((result) => {
        result.style.display = "flex";
    });
}
