let avertissements = 0;
const MAX = 2;

// Anti-triche pour les changements de plein écran

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
    <p style="font-size:1.4rem; font-weight:800; margin:0;">Passez en plein écran pour commencer</p>
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
    document.getElementById("at-msg").textContent = message;
    const msg = document.getElementById("at-msg");
    msg.textContent = message;
    msg.style.color = "#ff4d4d";
    overlay.style.display = "flex";
}
 
function cacherOverlay() {
    overlay.style.display = "none";
}
 
// ── Plein écran ──────────────────────────────────────────────
document.addEventListener("fullscreenchange", function () {
    console.log("fullscreenchange déclenché, fullscreenElement:", document.fullscreenElement);
    if (!document.fullscreenElement) {
        avertissements++;
        if (avertissements > MAX) {
            alert("Tentative invalidée ! Vous avez quitté le plein écran trop de fois.");
            window.location.href = "../Page_accueil/Accueil.php";
        } else {
            afficherOverlay("Avertissement " + avertissements + "/" + MAX + " — Repassez en plein écran pour continuer.");
        }
    } else {
        cacherOverlay();
    }
});
 

// Anti-triche pour les changements d'onglet

let altTabCount = 0;

document.addEventListener("visibilitychange", function() {
    if (document.hidden) {
        altTabCount++;
        
        if (altTabCount >= 3) {
            alert("Tentative invalidée ! Vous avez changé d'onglet trop de fois.");
            window.location.href = "../Page_accueil/Accueil.php";
        } else {
            alert("Avertissement " + altTabCount + "/2 — Ne changez pas d'onglet !");
        }
    }
});

// Minuteur de 10 minutes
 
const timerDiv = document.createElement("div");
timerDiv.style.cssText = "position:fixed; top:10px; right:15px; background:#2e2e2e; color:white; padding:8px 16px; border-radius:10px; font-weight:bold; font-size:1rem; z-index:9998;";
document.body.appendChild(timerDiv);

const interval = setInterval(function () {

    seconds--;
    const hrs = String(Math.floor(seconds / 3600)).padStart(2, "0");
    const mins = String(Math.floor( (seconds % 3600) / 60)).padStart(2, "0");
    const secs  = String(Math.floor(seconds % 60)).padStart(2, "0");
    timerDiv.textContent = "⏱ " + mins + ":" + secs;
 
    if (seconds <= 60) timerDiv.style.background = "#cc0000";

    if (seconds <= 0) {
        clearInterval(interval);
        document.getElementById("end_quizz").click();
        alert("Temps écoulé ! La tentative est terminée.");
        clearInterval(timer);
    }
}, 1000);
