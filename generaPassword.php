<?php
        $password = "momentanea";

        $options = [
            'cost' => 11
        ];

        $hash = password_hash($password, PASSWORD_DEFAULT, $options);

        if (password_verify($password, $hash)){
            echo "Password Giusta! <br>";
            echo "$hash";
        }
        else{
            echo "Password Sbagliata, coglione!!";
        }
?>