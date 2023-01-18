const cryptoForm = document.querySelector(".cryptoForm"),
cryptoBtn = cryptoForm.querySelector(".cryptoBtn");

cryptoForm.onsubmit = (e)=>{
    e.preventDefault();
}

cryptoBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/crypto.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data == "success"){
                swal({
                    title: "Success",
                    text: "Transaction Sucessful!",
                    icon: "success",
                    // buttons: true,
                    dangerMode: false,
                }).then((willDelete) => {
                  if (willDelete) {
                    location.href = "";
                  } else {
                    location.href = "";
                  }
                })
              }
              else if(data == "no_order"){
                swal({
                    title: "Error!",
                    text: "You have no pending order!",
                    icon: "error",
                    // buttons: true,
                    dangerMode: false,
                })

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
    let formData = new FormData(cryptoForm);
    xhr.send(formData);
}
