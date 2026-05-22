/// On récupère les scores actuels dans le sessionStorage, ou 0 s'ils n'existent pas encore
let avertissements = parseInt(sessionStorage.getItem("at_fullscreen_warns")) || 0;
let altTabCount = parseInt(sessionStorage.getItem("at_tab_warns")) || 0;
const MAX = 2;

// Variables de contrôle pour éviter les faux positifs
let isSubmitting = false;
let isAlerting = false; 
let pageJustLoaded = true;

// Bloquer les détections pendant le chargement initial (1.5s)
setTimeout(() => { pageJustLoaded = false; }, 1500);

// Écouter la soumission des formulaires pour autoriser le changement de page
document.querySelectorAll(".quizz-form").forEach(form => {
    form.addEventListener("submit", () => {
        isSubmitting = true;
    });
});

window.addEventListener("beforeunload", () => {
    isSubmitting = true;
    isAlerting = true;
});

// ── Création de l'overlay de blocage ──────────────────────────────────
const overlay = document.createElement("div");
overlay.style.cssText = `
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.95);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-family: sans-serif;
    text-align: center;
    gap: 1rem;
    display: none;
`;
overlay.innerHTML = `
    <p style="font-size:1.4rem; font-weight:800; margin:0;">Plein écran requis</p>
    <p style="font-size:0.9rem; margin:0;">Le plein écran est obligatoire pour valider ce quizz.</p>
    <p id="at-msg" style="color:#ff4d4d; font-size:0.9rem; margin:0; font-weight:bold;"></p>
    <button id="at-btn" style="background:#0d6efd; color:white; border:none; border-radius:8px; padding:0.8rem 2rem; font-size:1rem; font-weight:700; cursor:pointer; margin-top:10px;">
        ⛶ Activer le plein écran
    </button>
`;
document.body.appendChild(overlay);
 
// Clic sur le bouton de l'overlay
document.getElementById("at-btn").addEventListener("click", function () {
    document.documentElement.requestFullscreen()
        .then(() => {
            overlay.style.display = "none"; // On cache l'overlay UNIQUEMENT si ça a marché
        })
        .catch((err) => {
            console.log("Échec du plein écran demandé par l'utilisateur :", err);
        });
});

// Fonction pour l'affichage des avertissements
function verifierEtAfficherOverlay() {
    if (!document.fullscreenElement) {
        const msgElement = document.getElementById("at-msg");
        if (avertissements === 0) {
            msgElement.textContent = "Cliquez sur le bouton pour commencer le quizz.";
        } else {
            msgElement.textContent = "Avertissement " + avertissements + "/" + MAX + " — Repassez en plein écran.";
        }
        overlay.style.display = "flex";
    }
}

// Lancement automatique au chargement de la page
if (!document.fullscreenElement) {
    // On tente le coup en douce...
    document.documentElement.requestFullscreen()
        .then(() => { overlay.style.display = "none"; })
        .catch(() => { 
            // Si le navigateur refuse le mode auto (bloqué), on affiche l'overlay proprement
            verifierEtAfficherOverlay(); 
        });
}

// ── Gestion du Plein écran (Pendant le jeu) ───────────────────────────
document.addEventListener("fullscreenchange", function () {
    if (isSubmitting || pageJustLoaded || isAlerting) return;

    if (!document.fullscreenElement) {
        avertissements++;
        sessionStorage.setItem("at_fullscreen_warns", avertissements);

        if (avertissements > MAX) {
            sessionStorage.clear();
            isAlerting = true;
            alert("Tentative invalidée ! Vous avez quitté le plein écran trop de fois.");
            window.location.href = "../Page_accueil/Accueil.php";
        } else {
            verifierEtAfficherOverlay();
        }
    } else {
        overlay.style.display = "none";
    }
});

// ── Gestion des changements d'onglet ──────────────────────────────────────
document.addEventListener("visibilitychange", function() {
    if (isSubmitting || isAlerting) return;

    if (document.hidden) {
        altTabCount++;
        sessionStorage.setItem("at_tab_warns", altTabCount);
        
        if (altTabCount >= 3) {
            sessionStorage.clear();
            isAlerting = true;
            alert("Tentative invalidée ! Vous avez changé d'onglet trop de fois.");
            window.location.href = "../Page_accueil/Accueil.php";
        } else {
            isAlerting = true;
            alert("Avertissement " + altTabCount + "/2 — Ne changez pas d'onglet !");
            setTimeout(() => { isAlerting = false; }, 500);
        }
    }
});

// Nettoyer les sessions à la fin légitime du quizz
document.getElementById("end_quizz")?.addEventListener("click", () => {
    sessionStorage.clear();
});

// ── Minuteur ────────────────────────────────────────────────
const timerDiv = document.createElement("div");
timerDiv.style.cssText = "position:fixed; top:10px; right:15px; background:#2e2e2e; color:white; padding:8px 16px; border-radius:10px; font-weight:bold; font-size:1rem; z-index:9998;";
document.body.appendChild(timerDiv);

const interval = setInterval(function () {
    seconds--;
    const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
    const secs = String(Math.floor(seconds % 60)).padStart(2, "0");
    timerDiv.textContent = "⏱ " + mins + ":" + secs;
 
    if (seconds <= 60) timerDiv.style.background = "#cc0000";

    if (seconds <= 0) {
        clearInterval(interval);
        sessionStorage.clear();
        isAlerting = true;
        document.getElementById("end_quizz").click();
        alert("Temps écoulé ! La tentative est terminée.");
    }
}, 1000);