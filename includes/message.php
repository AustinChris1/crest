<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="jquery.js"></script>

<?php
if (isset($_SESSION['message'])) {

?>
        <script>
                setTimeout(function() {
                        swal({
                                title: "Success!",
                                text: "<?php echo $_SESSION['message']; ?>",
                                icon: "success",
                        });
                }, 1500)
        </script>
<?php
        unset($_SESSION['message']);
}
?>
<?php
if (isset($_SESSION['error'])) {

?>
        <script>
                setTimeout(function() {
                        swal({
                                title: "Failed!",
                                text: "<?php echo $_SESSION['error']; ?>",
                                icon: "error",
                        });
                }, 1500)
        </script>
<?php
        unset($_SESSION['error']);
}
?>

<?php
if (isset($_SESSION['warning'])) {

?>
        <script>
                window.onload = function() {
                // setTimeout(function() {
                        swal({
                                title: "Notice!",
                                text: "<?php echo $_SESSION['warning']; ?>",
                                icon: "warning",
                        })
                // }, 6000)
                };
        </script>
<?php
        unset($_SESSION['warning']);
}
?>
