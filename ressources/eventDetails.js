const buttonsEvent = document.querySelectorAll('.eventB');
const dialog = document.querySelector("dialog");
const dialogClose = document.querySelector("#dialogClose");
let title, text, place, date, gps, opac;

buttonsEvent.forEach(buttonE => {
    buttonE.addEventListener('click', async function (event) {
        const file = await fetch("ressources/events.json");
        const jData = await file.json();

        jData["evenements"].forEach(function (element) {
            if (element["date"] == buttonE.id) {
                title = document.createElement('h3');
                title.textContent = element["titre"];
                dialog.appendChild(title);

                text = document.createElement('p');
                text.textContent = element["description"];
                dialog.appendChild(text);

                place = document.createElement('p');
                place.textContent = 'L\'évènement se situe à ' + element["ville"];
                dialog.appendChild(place);

                date = document.createElement('p');
                date.textContent = 'L\'évènement se déroule le: ' + element["date"];
                dialog.appendChild(date);

                gps = document.createElement('p');
                gps.textContent = 'Lattitude: ' + element["latitude"] + '| Longitude: ' + element["longitude"];
                dialog.appendChild(gps);
            }
        });

        dialog.showModal();
        dialog.style.opacity = '0%';
        opac = 0;

        let fondu = setInterval(function () {
            if (opac >= 100) {
                opac = 100;
                dialog.style.opacity = '100%';
                clearInterval(fondu);
            }
            else {
                opac += 10;
                dialog.style.opacity = opac + '%';
            }
        }, 10);
    });
});

dialogClose.addEventListener('click', function (event) {
    dialog.style.opacity = '100%';
    opac = 100;

    let fondu = setInterval(function () {
        if (opac <= 0) {
            dialog.style.opacity = '0%';
            let child = dialog.lastElementChild;
            while (child) {
                dialog.removeChild(child);
                child = dialog.lastElementChild;
            }
            dialog.appendChild(dialogClose);
            dialog.close();
            clearInterval(fondu);
        }
        else {
            opac -= 10;
            dialog.style.opacity = opac + '%';
        }
    }, 10);
});