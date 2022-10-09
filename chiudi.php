<?php
session_start();
?>

<html>

<body>
    <?php
    session_unset();
    session_destroy();
    echo ("<script type='text/javascript'> alert('Sessione Chiusa con Successo!'); window.location.replace(\"login_registra/primo.php\"); </script>");
    ?>

</html>
</body>