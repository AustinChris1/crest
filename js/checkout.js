const form = document.querySelector(".checkoutForm"),
continueBtn = document.querySelector("#checkout"),
success = document.querySelector("#success"),
error = document.querySelector("#error");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/checkoutcode.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data == "success"){
                swal({
                    title: "Order Created Successfully",
                    text: "Please select payment method to proceed!",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        }
                    })
                    
                // success.style.display = "block"
                // success.innerHTML = "Order Successful"
                // location.href = "login"

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
    }
    let formData = new FormData(form);
    xhr.send(formData);
    form.reset();
}
