// Selezione elementi input

const formElement = document.getElementById("custom-form");

const nameElement = document.getElementById("name");

const surnameElement = document.getElementById("surname");

const birthElement = document.getElementById("date-of-birth");

const emailElement = document.getElementById("email");

const pswElement = document.getElementById("password");

const pswConfirmElement = document.getElementById("password-confirm");

// Selezione errori elementi input

const nameSpanElement = document.getElementById("span-name");

const surnameSpanElement = document.getElementById("span-surname");

const birthSpanElement = document.getElementById("span-date-of-birth");

const emailSpanElement = document.getElementById("span-email");

const pswSpanElement = document.getElementById("span-password");

const pswConfirmSpanElement = document.getElementById("span-password-confirm");

let limitDate = new Date();
const dd = String(limitDate.getDate()).padStart(2, "0");
const mm = String(limitDate.getMonth() + 1).padStart(2, "0"); //Gennaio sarà 0
const yyyy = limitDate.getFullYear() - 18;
limitDate = yyyy + "-" + mm + "-" + dd;

formElement.addEventListener("submit", e => {
    nameSpanElement.classList.add("d-none");
    surnameSpanElement.classList.add("d-none");
    birthSpanElement.classList.add("d-none");
    emailSpanElement.classList.add("d-none");
    pswSpanElement.classList.add("d-none");
    pswConfirmSpanElement.classList.add("d-none");
    if (nameElement.value.length < 3 || nameElement.value.length > 50) {
        e.preventDefault();
        nameSpanElement.classList.remove("d-none");
    }
    if (surnameElement.value.length < 3 || surnameElement.value.length > 50) {
        e.preventDefault();
        surnameSpanElement.classList.remove("d-none");
    }
    if (birthElement.value > limitDate) {
        e.preventDefault();
        birthSpanElement.classList.remove("d-none");
    }
    if (emailElement.value.length < 5 || emailElement.value.length > 150) {
        e.preventDefault();
        emailElement.classList.remove("d-none");
    }
    if (pswElement.value.length < 8) {
        e.preventDefault();
        pswElement.value = "";
        pswConfirmElement.value = "";
        pswSpanElement.classList.remove("d-none");
    }
    if (pswElement.value != pswConfirmElement.value) {
        e.preventDefault();
        pswElement.value = "";
        pswConfirmElement.value = "";
        pswConfirmSpanElement.classList.remove("d-none");
    }
});
