
const form = document.querySelector("#loginForm"),
continueBtn = form.querySelector("#loginBtn"),
success = document.querySelector("#success"),
error = document.querySelector("#error");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "logincode.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data == "success"){
                success.style.display = "block"
                success.innerHTML = "Login Successful"
                location.href = "index"

              }
              else if(data === "admin"){
                success.style.display = "block"
                success.innerHTML = "Welcome back Admin!";
                location.href = "admin/"

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
