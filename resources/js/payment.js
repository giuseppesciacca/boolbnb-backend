const button = document.querySelector('#submit-button');
const div = document.querySelector('#dropin-container')
let checkError = false;

braintree.dropin.create({
  authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
  selector: '#dropin-container'
}, function (err, instance) {
  div.addEventListener('mouseleave', function (e) {
    instance.requestPaymentMethod(function (err, payload) {
      if(err == null){
        button.removeAttribute('disabled')
      }
      // Submit payload.nonce to your server
    });
  })
});