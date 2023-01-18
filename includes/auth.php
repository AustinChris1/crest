<?php

if (!isset($_SESSION["auth"])) {
 ?>
 <script>
 window.onload = ()=>{
 swal({
        title: 'Error!',
        text: 'Please login!',
        icon: 'error',
        button: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
            location.href = 'login'
        }else {
            location.href = 'login'
    }
    });
}
    </script>
<?php
    exit();
}
?>
