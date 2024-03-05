window.onload = init;

function init() {
    request = new XMLHttpRequest();
    request.open("GET", "dashboard.php");
    request.send();
    request.onreadystatechange = traitementReponse;
    document.getElementById('ouvert').style.display = 'block';
    document.getElementById('button1').classList.add('active')
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

    // If the same tab is clicked again
    if (dernierOngletClique === contentId) {
        if (selectedTabContent && selectedTabContent.style.display === "block") {
            selectedTabContent.style.display = "none";
            selectedTabContent.style.padding = "0";
            evt.currentTarget.classList.remove("active");
            tableauDiv.style.display = "block"; // Make sure tableauDiv is shown
            dernierOngletClique = null; // Reset the last clicked tab
        } else {
            selectedTabContent.style.display = "block";
            evt.currentTarget.classList.add("active");
            tableauDiv.style.display = "none"; // Make sure tableauDiv is hidden
            dernierOngletClique = contentId; // Update the last clicked tab
        }
    } else {
        // If a new tab is clicked
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
            selectedTabContent.style.padding = "0";
            evt.currentTarget.classList.add("active");
            tableauDiv.style.display = "none"; // Make sure tableauDiv is hidden
            dernierOngletClique = contentId; // Update the last clicked tab
        }
    }
}

//




