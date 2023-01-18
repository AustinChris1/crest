const userId = document.querySelector("#uid"),
cart_count_x = document.querySelector("#cart_count_x"),
cart_count_y = document.querySelector("#cart_count_y");
let data
const uid = userId.value;

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/crest/php/getCart.php", true);
    xhr.onload = ()=>{
          if(xhr.status === 200){
            // hey.innerHTML = data;
         }
         else{
            cart_count.innerHTML = "Error Exit!";
         }
      }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("uid="+uid);
}, 500);

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/crest/php/getCart.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
           let data = xhr.response;
           cart_count_x.innerHTML = data
           cart_count_y.innerHTML = data
          }   

      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
},500);

