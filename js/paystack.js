var paymentForm = document.getElementById("paymentForm");
var payEmail = document.getElementById("payEmail").value;
var payAmount = document.getElementById("payAmount").value;
var payid = document.getElementById("payId").value;
var payprod = document.getElementById("payProd").value;
var payphone = document.getElementById("payPhone").value;
paymentForm.onsubmit = (e) => {
  e.preventDefault();
};
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack() {
  var handler = PaystackPop.setup({
    key: "pk_live_bce8a4ae9c1205a3381c72a4adbb10ae55ac1d62", // Replace with your public key
    email: payEmail,
    amount: payAmount * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
    currency: "NGN", // Use GHS for Ghana Cedis or USD for US Dollars
    ref: ref.value, // Replace with a reference you generated
    callback: function (response) {
      //this happens after the payment is completed successfully
      var reference = response.reference;
      // Make an AJAX call to your server with the reference to verify the transaction
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "/crest/php/paystack.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            if (data == "success") {
              swal({
                title: "Success!",
                text: "Payment complete! Reference: " + reference,
                icon: "success",
                // buttons: true,
                dangerMode: false,
              });
            }
            else{
              swal({
                  title: "Error!",
                  text: data,
                  icon: "error",
                  // buttons: true,
                  dangerMode: false,
              })

          }
          }
        }
      };
      let formData = new FormData(paymentForm);
      xhr.send(formData);
    },
    onClose: function () {
      swal({
        title: "Error!",
        text: "Transaction was not completed, window closed.",
        icon: "error",
        // buttons: true,
        dangerMode: false,
      });
    },
  });
  handler.openIframe();
}
