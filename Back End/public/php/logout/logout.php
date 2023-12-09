<?php
    if(isset($_GET["logoutOwn"]))
    {
        session_destroy();
        header("Location: ../login/loginOwner.php");
    }
?>