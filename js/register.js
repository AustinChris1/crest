
const form = document.querySelector("#regForm"),
continueBtn = form.querySelector("#register"),
success = document.querySelector("#success"),
error = document.querySelector("#error");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "registercode.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data == "success"){
                swal({
                  title: "Success",
                  text: "Please check your email!",
                  icon: "success",
                  buttons: true,
                  dangerMode: false,
              })
              .then((willDelete) => {
                  if (willDelete) {
                      location.href = "email_verify"
                  } else {
                    location.href = "email_verify"
                  }
              });

              }
              else{
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
    }
    let formData = new FormData(form);
    xhr.send(formData);
    form.reset();
}
