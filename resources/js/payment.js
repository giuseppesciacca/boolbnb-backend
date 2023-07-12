const button = document.querySelector("#submit-button");
braintree.dropin.create({
    // Insert your tokenization key here
    authorization: "sandbox_tvndmb3x_pxjg2zqnzpvkqm8h",
    container: "#dropin-container",
});