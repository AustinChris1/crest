const cartForm = document.querySelector(".cartForm"),
  cartBtn = cartForm.querySelector(".cartBtn");

cartForm.onsubmit = (e) => {
  e.preventDefault();
};

cartBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/crest/php/addtocart.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          swal({
            title: "Added to cart",
            text: "Do you want to proceed to checkout?",
            icon: "success",
            buttons: true,
            dangerMode: false,
          }).then((willDelete) => {
            if (willDelete) {
              location.href = "/crest/checkout";
            } else {
            }
          });
        }else {
          swal({
            title: "Error!",
            text: data,
            icon: "error",
            // buttons: true,
            dangerMode: false,
          });
        }
      }
    }
  };
  let formData = new FormData(cartForm);
  xhr.send(formData);
};
