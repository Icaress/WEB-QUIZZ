// Récupération des scores sauvegardés d'une page à l'autre (ou 0 par défaut)
let avertissements = parseInt(sessionStorage.getItem("anticheat_fs")) || 0;
let altTabCount = parseInt(sessionStorage.getItem("anticheat_tab")) || 0;
const MAX = 2;

// On vérifie si on vient d'un changement de page provoqué par le bouton "Répondre"
const estLegitime = sessionStorage.getItem("changement_page_legitime");

if (estLegitime === "true") {
    // C'était un rechargement normal, on consomme le ticket/flag pour la suite
    sessionStorage.removeItem("changement_page_legitime");
}

// Configuration de l'overlay de triche
const overlay = document.createElement("div");
overlay.style.cssText = `
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.92);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-family: sans-serif;
    text-align: center;
    gap: 1rem;
`;
overlay.innerHTML = `
    <p style="font-size:1.4rem; font-weight:800; margin:0;">Passez en plein écran pour continuer le quiz</p>
    <p style="font-size:0.9rem; margin:0;">Le plein écran est requis pour éviter les triches et distractions.</p>
    <p id="at-msg" style="color:#aaa; font-size:0.9rem; margin:0;"></p>
    <button id="at-btn" style="background:#2e2e2e; color:white; border:none; border-radius:12px; padding:0.8rem 2rem; font-size:1rem; font-weight:700; cursor:pointer;">
        ⛶  Passer en plein écran
    </button>
`;

document.body.appendChild(overlay);
 
document.getElementById("at-btn").addEventListener("click", function () {
    document.documentElement.requestFullscreen();
});
 
function afficherOverlay(message) {
    const msg = document.getElementById("at-msg");
    msg.textContent = message;
    msg.style.color = "#ff4d4d";
    overlay.style.display = "flex";
}
 
function cacherOverlay() {
    overlay.style.display = "none";
}

// Si l'utilisateur n'est pas en plein écran au chargement (et que ce n'est pas un changement légitime)
if (!document.fullscreenElement && estLegitime !== "true") {
    afficherOverlay("Plein écran requis.");
} else if (document.fullscreenElement) {
    cacherOverlay();
}
 
// ── GESTION DU PLEIN ÉCRAN ──────────────────────────────────────────────
document.addEventListener("fullscreenchange", function () {
    if (!document.fullscreenElement) {
        // On n'applique la sanction QUE si ce n'est pas un rechargement légitime de question
        if (sessionStorage.getItem("changement_page_legitime") !== "true") {
            avertissements++;
            sessionStorage.setItem("anticheat_fs", avertissements); // Sauvegarde du score

            if (avertissements > MAX) {
                sessionStorage.clear(); // On vide tout avant d'éjecter
                alert("Tentative invalidée ! Vous avez quitté le plein écran trop de fois.");
                window.location.href = "../Page_accueil/Accueil.php";
            } else {
                afficherOverlay("Avertissement " + avertissements + "/" + MAX + " — Repassez en plein écran pour continuer.");
            }
        }
    } else {
        cacherOverlay();
    }
});
 
// ── GESTION DES CHANGEMENTS D'ONGLET ────────────────────────────────────
document.addEventListener("visibilitychange", function() {
    if (document.hidden) {
        // Idem, on ne punit pas si la page est en train de se recharger légitimement
        if (sessionStorage.getItem("changement_page_legitime") !== "true") {
            altTabCount++;
            sessionStorage.setItem("anticheat_tab", altTabCount); // Sauvegarde du score
            
            if (altTabCount >= 3) {
                sessionStorage.clear();
                alert("Tentative invalidée ! Vous avez changé d'onglet trop de fois.");
                window.location.href = "../Page_accueil/Accueil.php";
            } else {
                alert("Avertissement " + altTabCount + "/2 — Ne changez pas d'onglet !");
            }
        }
    }
});

// ── MINUTEUR DE 10 MINUTES (Persistant au rechargement) ──────────────────
let secondes = parseInt(sessionStorage.getItem("anticheat_timer")) || (10 * 60);
 
const timerDiv = document.createElement("div");
timerDiv.style.cssText = "position:fixed; top:10px; right:15px; background:#2e2e2e; color:white; padding:8px 16px; border-radius:10px; font-weight:bold; font-size:1rem; z-index:9998;";
document.body.appendChild(timerDiv);
 
const interval = setInterval(function () {
    const m = Math.floor(secondes / 60).toString().padStart(2, "0");
    const s = (secondes % 60).toString().padStart(2, "0");
    timerDiv.textContent = "⏱ " + m + ":" + s;
 
    if (secondes <= 60) timerDiv.style.background = "#cc0000";
 
    if (secondes <= 0) {
        clearInterval(interval);
        sessionStorage.clear();
        alert("Temps écoulé ! La tentative est terminée.");
        window.location.href = "../Page_accueil/Accueil.php";
    }
    
    secondes--;
    sessionStorage.setItem("anticheat_timer", secondes); // Sauvegarde le temps restant
}, 1000);