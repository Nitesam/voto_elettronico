<?php

    $password = "Leccapalle1!";

    $options = [
        'cost' => 11
    ];

    //$hash = password_hash($password, PASSWORD_DEFAULT, $options);
    $hash= "$2y$10\$gKm/t7/kLP1UNv78qVn29uxrxxtM4wOyWUMnG0n3LDURy7xI2dn8K";

    if (password_verify($password, $hash)){
        echo "Password Giusta! <br>";
        echo "$hash";
    }
    else{
        echo "Password Sbagliata, coglione!!";
    }
?>