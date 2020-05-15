<!DOCTYPE html>

<?php
    session_start();
	$_SESSION["totaleVotazioni"] = 0;
	$_SESSION["nomeTipologia"] = 0;
	$_SESSION["radio"] = -1;
?>

<html lang="it">
<head>
    <title>Lista Votazioni</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
	
	

		
		
</head>
<body>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <table data-vertable="ver1">
                    <thead>
                    <tr class="row100 head">
                        <th class="column100 column2" data-column="column2">Elezioni</th>
                        <th class="column100 column3" data-column="column3">Data Apertura</th>
                        <th class="column100 column4" data-column="column4">Data Chiusura</th>
                        <th class="column100 column5" data-column="column5">Stato</th>
						<th class="column100 column10" data-column="column10">Seleziona Elezioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
                    $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );
					
					

                    if ($conn->connect_error) {
                        die("Lettura Fallita: " . $conn->connect_error);
                    } else{
                        echo "Lettura avvenuta con successo.<br> Di seguito la lista delle elezioni: <br> <br>";
                    }
					
					
					//id tipologia utente
					$query = mysqli_query($conn, 'SELECT voto_elettronico.tipologia_utente.id FROM voto_elettronico.tipologia_utente 
					
					INNER JOIN voto_elettronico.utente ON voto_elettronico.tipologia_utente.id = voto_elettronico.utente.id_tipologia_utente
					
					WHERE voto_elettronico.utente.username = "'. $_SESSION["utente_usn"].'"');
					
					if ($record = mysqli_fetch_array($query)){
						$_SESSION["idTipologia"] = $record['id'];
					}
						//id utente
			
					$query = mysqli_query($conn, 'SELECT voto_elettronico.utente.id FROM voto_elettronico.utente 
					
					
					WHERE voto_elettronico.utente.username = "'. $_SESSION["utente_usn"].'"');
					
					if ($record = mysqli_fetch_array($query)){
						$_SESSION["idUtente"] = $record['id'];
					}	
				    

                    $results = mysqli_query($conn,'SELECT voto_elettronico.elezione.id, voto_elettronico.elezione.nome, voto_elettronico.elezione.data_apertura, 
					
					voto_elettronico.elezione.ora_apertura, voto_elettronico.elezione.data_chiusura, voto_elettronico.elezione.ora_chiusura 
					
					FROM voto_elettronico.elezione INNER JOIN voto_elettronico.tipologia_utente ON voto_elettronico.elezione.id_tipologia_utente = voto_elettronico.tipologia_utente.id
					
					WHERE voto_elettronico.elezione.id_tipologia_utente = "'.$_SESSION["idTipologia"].'"');
					
					

                    while($row = mysqli_fetch_array($results)) {
                        ?>
												
						<form name="utenti" action="scheda.php" method="POST">
                        <tr class="row100">
                            <td class="column100 column2" data-column="column2"><?php echo $row['nome']?></td>
                            <td class="column100 column3" data-column="column3"><?php 

							$dataApertura = implode("/", array_reverse(explode("-", $row['data_apertura']))); echo $dataApertura." ".$row['ora_apertura']?></td>
							
							<td class="column100 column4" data-column="column4"><?php 
							$dataChiusura = implode("/", array_reverse(explode("-", $row['data_chiusura']))); echo $dataChiusura." ".$row['ora_chiusura']?></td>
							
							<td class="column100 column11" data-column="column11"><?php 
							
							$votato = mysqli_query($conn, 'SELECT voto_elettronico.votazione.votato, voto_elettronico.votazione.abilitato FROM voto_elettronico.votazione INNER JOIN 
							voto_elettronico.elezione ON voto_elettronico.votazione.id_elezione = "'.$row["id"].'" INNER JOIN voto_elettronico.utente ON 
             				voto_elettronico.votazione.id_utente = "'.$_SESSION["idUtente"].'"');
							
							if ($record = mysqli_fetch_array($votato)){
								
								if($record['votato'] == 0 && $record['abilitato'] == 0){
									echo 'Non hai votato <br>';
									echo 'Non sei abilitato';
									$_SESSION['votato'] = 1;
								}
								if($record['votato'] == 0 && $record['abilitato'] == 1){
									$_SESSION['votato'] = 0;
								    echo 'Non hai votato <br>';
							        $dataOggi = date('Y-m-d H:i:s');
	                                $oggi = date('Y-m-d');
								    $tempo = date('H:i:s');
								    $query = mysqli_query($conn, 'SELECT voto_elettronico.elezione.data_apertura, voto_elettronico.elezione.data_chiusura, voto_elettronico.elezione.ora_apertura, voto_elettronico.elezione.ora_chiusura  
								    FROM voto_elettronico.elezione 
								    WHERE voto_elettronico.elezione.id = "'.$row['id'].'"');
								    if($q = mysqli_fetch_array($query)){
									    if((($q['data_apertura']." ".$q['ora_chiusura'] <= $dataOggi) || (($q['data_apertura'] == $oggi) && ($q['ora_apertura'] <= $tempo))) && ($q['data_chiusura']." ".$q['ora_chiusura'] >= $dataOggi)){
										    echo 'Votazione aperta';
										
									    }
									    else{
										    echo 'Votazione chiusa';
										    $_SESSION['votato'] = 1;
									    }
									
								    }
								}
								
								if($record['votato'] == 1){
									echo 'Hai votato';
									$_SESSION['votato'] = 1;
								}
							
								
					        }
							else{
								
								echo 'Non sei registrato';
								$_SESSION['votato'] = 1;
							
							
							}
					
								
							
							?></td>
							
							<td class="column100 column11" data-column="column11"><?php 
							
							   if($_SESSION['votato'] == 0)
							    echo '<input type="radio" value="'.$row["id"].'" name="radio">';
							 
							   else
								   echo '<input type="radio" value="'.$row["id"].'" name="radio" disabled>';
							
							
							?></td>
                        </tr>
					
                        <?php
						$_SESSION["totaleVotazioni"]++;
                    }
                    ?>
                     

                    </tbody>
                </table>
                <br>
                <br>
                <table data-vertable="ver1">
                    <tbody>
                    <tr class="row100"> 
                        <td class="column100 column3" data-column="column3"><a href="../chiudi.php">Chiudi la Connessione<a/></td>
						<td class="column100 column4" data-column="column4"><input type="submit" Value="VOTA"></td>
                    </tr>
					</form>
                    </tbody>
                </table>
                <br>
                <br>
                <a href="../pagina_principale/home.php" style="text-align:center;display:block;" >Torna alla Pagina Principale</a>
                <iframe name="suca" style="display:none;"></iframe>
            </div>
        </div>
    </div>
</div>
<?php
	$conn->close();
?>

<script type="text/javascript">

    function window_reload(){
        setTimeout(reload, 300);
    }

    function reload(){
        document.location.reload(true);
    }

</script>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>