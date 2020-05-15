<html>
<body>
    <?php
	session_start();

			
	$conn = new mysqli("localhost", "registrazione", "registrazione1!");
	
	$verifica=1;
	
	if($_POST["nome"] == ""){
	    echo "Nome non inserito"."<br>";
		$verifica=0;
	}
	
	if($_POST["cognome"] == ""){
	    echo "Cognome non inserito"."<br>";
		$verifica=0;
	}
	
	if($_POST["email"] == ""){
	    echo "Email non inserita"."<br>";
		$verifica=0;
	}
	
	if($_POST["password"] == ""){
	    echo "Password non inserita"."<br>";
		$verifica=0;
	}
	
	if($_POST["conf_password"] == ""){
	    echo "Conferma password non inserita"."<br>";
		$verifica=0;
	}
	
	if($_POST["conf_password"] != $_POST["password"]){
	    echo "Le password non corrispondono"."<br>";
		$verifica=0;
	}
	
	if($_POST["classe"] == ""){
	    echo "Classe non inserita"."<br>";
		$verifica=0;
	}
	
	if($_POST["tipologia_utente"] == ""){
	    echo "Tipologia utente non inserita"."<br>";
		$verifica=0;
	}
	
	$results = mysqli_query($conn,"SELECT voto_elettronico.utente.username, voto_elettronico.utente.email FROM voto_elettronico.utente");
	
	while($row = mysqli_fetch_array($results)){
	 
	   if($_POST["username"] == $row["username"]){
	      echo "Username occupato"."<br>";
		  $verifica=0;
	   }
	   
	   if($_POST['email'] == $row['email']){
	      echo "Email occupata"."<br>";
		  $verifica=0;
	   }
	   
	 }
	 
	 $esiste_classe=0;
	 $esiste_tipologia=0;
	 
	if($verifica == 1){
	    $results = mysqli_query($conn,"SELECT * FROM voto_elettronico.classe");
	    while($row = mysqli_fetch_array($results)){
		    if($_POST["classe"] == $row["classe"]){
			   $classeID = $row["id"];
			   $esiste_classe=1;
		       
			}
			
		}
		
		$results = mysqli_query($conn,"SELECT * FROM voto_elettronico.tipologia_utente");
	    while($row = mysqli_fetch_array($results)){
		    if($_POST["tipologia_utente"] == $row["tipologia"]){
			   $tipologiaID = $row["id"];
			   if ($tipologiaID != 1){$esiste_tipologia=1;}
			}
			
		}

		if($esiste_classe == 1 && $esiste_tipologia == 1){


            $options = [
                'cost' => 11
            ];

            $md5Password = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);
		
		   $sql = "INSERT INTO voto_elettronico.utente (nome, cognome, email, username, password, id_classe, id_tipologia_utente)
		    VALUES ('". $_POST["nome"] . "', '". $_POST["cognome"] . "', '" . $_POST["email"] . "' , '". $_POST["username"] .
			"' , '". $md5Password . "' , '". $classeID . "' , '". $tipologiaID . "')";
			
			if($conn->query($sql) === TRUE)	
	         echo "Utente registrato con successo <br>";
			else
			 echo "Error: ". $conn->error;
		
		
		
		}
		if($esiste_classe == 0)
		    echo "La classe inserita non esiste <br>";
	 
	    if($esiste_tipologia == 0)
		    echo "La tipologia utente inserita non esiste <br>";
	 
	}
	
	
	
	
    ?>

    <a href="login_registra/registrati.html">Torna alla Pagina di registrazione</a><br>
    

</body>
</html>