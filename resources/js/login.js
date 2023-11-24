// Selezione elementi input

const formElement = document.getElementById("custom-form");

const emailElement = document.getElementById("email");

const pswElement = document.getElementById("password");

// Selezione errori elementi input

const emailSpanElement = document.getElementById("span-email");

const pswSpanElement = document.getElementById("span-password");

formElement.addEventListener("submit", e => {
    emailSpanElement.classList.add("d-none");
    pswSpanElement.classList.add("d-none");
    if (emailElement.value.length < 5 || emailElement.value.length > 150) {
        e.preventDefault();
        emailElement.classList.remove("d-none");
    }
    if (pswElement.value.length < 8) {
        e.preventDefault();
        pswElement.value = "";
        pswSpanElement.classList.remove("d-none");
    }
});
