<?php
session_start();
?>

<html>
    <body>
        <?php
        $conn = new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);

        $q= "DELETE FROM voto_elettronico.utente WHERE utente.id_tipologia_utente != 1";

        $conn->query($q);

        echo "<script type=\"text/javascript\">window.close()</script>";

        $conn->close();
        ?>
    </body>
</html>