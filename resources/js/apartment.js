// Selezione elementi input

const formElement = document.getElementById("custom-form");

const titleElement = document.getElementById("title");

const imageElement = document.getElementById("image");

const descriptionElement = document.getElementById("description");

const roomElement = document.getElementById("rooms");

const bathroomElement = document.getElementById("bathrooms");

const bedElement = document.getElementById("beds");

const sqmtElement = document.getElementById("square_meters");

const addressElement = document.getElementById("address");

const checkboxElement = document.querySelectorAll(".multi-check-box");

const checkboxArray = Array.from(checkboxElement);

// Selezione errori element input

const titleSpanElement = document.getElementById("span-title");

const imageSpanElement = document.getElementById("span-image");

const descriptionSpanElement = document.getElementById("span-description");

const roomSpanElement = document.getElementById("span-rooms");

const bathroomSpanElement = document.getElementById("span-bathrooms");

const bedSpanElement = document.getElementById("span-beds");

const sqmtSpanElement = document.getElementById("span-square_meters");

const addressSpanElement = document.getElementById("span-address");

const checkboxSpanElement = document.getElementById("span-multi-check-box");

const admitFormats = [".jpg", ".jpeg", ".png", ".bmp"];

formElement.addEventListener("submit", (e) => {
    titleSpanElement.classList.add("d-none");
    imageSpanElement.classList.add("d-none");
    descriptionSpanElement.classList.add("d-none");
    roomSpanElement.classList.add("d-none");
    bathroomSpanElement.classList.add("d-none");
    bedSpanElement.classList.add("d-none");
    sqmtSpanElement.classList.add("d-none");
    addressSpanElement.classList.add("d-none");
    checkboxSpanElement.classList.add("d-none");

    const atLeastOneChecked = checkboxArray.some(function (checkboxElement) {
        return checkboxElement.checked;
    });

    if (!isNaN(titleElement.value)) {
        e.preventDefault();
        titleSpanElement.classList.remove("d-none");
    }
    /*     for (let i = 0; i < admitFormats.length; i++) {
        const format = admitFormats[i];
        if (imageElement.includes(format)) {
            return;
        } else if(!imageElement.value.includes(format)){
            e.preventDefault();
            imageSpanElement.classList.remove("d-none");
        }
    } */
    /*     if(descriptionSpanElement.value){
        e.preventDefault();
        SpanElement.classList.remove('d-none');
    } */

    // Aggiungi un listener per l'evento change dell'input
    /* imageElement.addEventListener("change", function () {
        // Controlla se è stato selezionato un file
        if (imageElement.files && imageElement.files.length > 0) {
            // Ottieni il primo file selezionato
            const file = imageElement.files[0];

            // Ottieni il tipo del file
            const fileType = file.type;

            // Controlla il tipo del file
            if (
                fileType === "image/bmp" ||
                fileType === "image/jpg" ||
                fileType === "image/jpeg" ||
                fileType === "image/png"
            ) {
                console.log("Il file è un'immagine JPEG o PNG.");
            } else {
                console.log("Il tipo di file non è supportato.");
            }
        } else {
            // Nessun file selezionato
            console.log("Nessun file selezionato!");
        }
    }); */

    if (
        (!isNaN(roomElement.value) && roomElement.value < 1) ||
        (!isNaN(roomElement.value) && roomElement.value > 50) ||
        isNaN(roomElement.value)
    ) {
        e.preventDefault();
        roomSpanElement.classList.remove("d-none");
    }
    if (
        (!isNaN(bathroomElement.value) && bathroomElement.value < 1) ||
        (!isNaN(bathroomElement.value) && bathroomElement.value > 50) ||
        isNaN(bathroomElement.value)
    ) {
        e.preventDefault();
        bathroomSpanElement.classList.remove("d-none");
    }
    if (
        (!isNaN(bedElement.value) && bedElement.value < 1) ||
        (!isNaN(bedElement.value) && bedElement.value > 50) ||
        isNaN(bedElement.value)
    ) {
        e.preventDefault();
        bedSpanElement.classList.remove("d-none");
    }
    if (
        (!isNaN(sqmtElement.value) && sqmtElement.value < 30) ||
        (!isNaN(sqmtElement.value) && sqmtElement.value > 9999) ||
        isNaN(sqmtElement.value)
    ) {
        e.preventDefault();
        sqmtSpanElement.classList.remove("d-none");
    }

    if (!atLeastOneChecked) {
        e.preventDefault();
        checkboxSpanElement.classList.remove("d-none");
    }
    // if (for the address)
});
