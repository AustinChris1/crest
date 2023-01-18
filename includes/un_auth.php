<?php

if (isset($_SESSION["auth"])) {
 ?>
 <script>
 window.onload = ()=>{
 swal({
        title: 'Error!',
        text: 'You are already logged in!',
        icon: 'error',
        button: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
            location.href = '/crest/'
        }else {
            location.href = '/crest/'
    }
    });
}
    </script>
<?php
    exit();
}
?>
