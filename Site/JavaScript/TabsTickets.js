window.onload = init;

function init() {
    request = new XMLHttpRequest();
    request.open("GET", "dashboard.php");
    request.send();
    request.onreadystatechange = traitementReponse;
}

function traitementReponse() {
    if (request.readyState === 4 && request.status === 200) {
        let i;
        console.log("Réponse dashboard.php!");

        let tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        let tab = document.getElementById("tab");
        let tabenfant = tab.children;

        for (i = 0; i < tabenfant.length; i++) {
            let currentTab = tabenfant[i];
            currentTab.onclick = function(evt) {
                openTicketButton(evt);
            };
        }
    }
}

let dernierOngletClique = null;
function openTicketButton(evt) {
    let contentId = evt.currentTarget.getAttribute('data-content-id');
    let selectedTabContent = document.getElementById(contentId);
    let tableauDiv = document.getElementById("tableau");

    // Si le même onglet est cliqué deux fois
    if (dernierOngletClique === contentId) {
        if (selectedTabContent && selectedTabContent.style.display === "block") {
            selectedTabContent.style.display = "none"; // Fermez l'onglet
            selectedTabContent.style = "none"
            tableauDiv.style.display = "block"; // Affichez tableauDiv
        } else {
            selectedTabContent.style.display = "block"; // Affichez l'onglet
            tableauDiv.style.display = "none"; // Fermez tableauDiv
        }
    } else {
        let i;
// Si un nouvel onglet est cliqué
        dernierOngletClique = contentId;
        let tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }


        let tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        if (selectedTabContent) {
            selectedTabContent.style.display = "block";
        }

        tableauDiv.style.display = "none"; // Assurez-vous que tableauDiv est caché
        evt.currentTarget.classList.add("active");
    }

    // Mettre à jour le dernier onglet cliqué
    dernierOngletClique = contentId;
}

//




