<!DOCTYPE html>

<?php
    session_start();
	$_SESSION["totale"] = 0;
	$_SESSION["idElezione"] = $_POST['elezione'];
?>

<html lang="it">
<head>
    <title>Lista Utenti</title>
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
                        <th class="column100 column2" data-column="column2">Nome</th>
                        <th class="column100 column3" data-column="column3">Cognome</th>
						<th class="column100 column7" data-column="column7">Abilita Utenti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
                    $conn = mysqli_connect("localhost", $_SESSION["username"], $_SESSION["password"] );

                    if ($conn->connect_error) {
                        die("Lettura Fallita: " . $conn->connect_error);
                    } else{
                        echo "Lettura avvenuta con successo.<br> Di seguito la lista utenti: <br> <br>";
                    }

                    $results = mysqli_query($conn,"SELECT voto_elettronico.utente.id, voto_elettronico.utente.nome, voto_elettronico.utente.cognome 
					FROM voto_elettronico.utente 
			        WHERE voto_elettronico.utente.id_classe = '".$_POST['classe']."'");


                    while($row = mysqli_fetch_array($results)) {
                        ?>
												
						<form name="utenti" action="abilitaSelezionati.php" method="POST" target="suca">
                        <tr class="row100">
                            <td class="column100 column2" data-column="column2"><?php echo $row['nome']?></td>
                            <td class="column100 column3" data-column="column3"><?php echo $row['cognome']?></td>
							<td class="column100 column7" data-column="column7"><?php 
							
							$query = mysqli_query($conn, 'SELECT voto_elettronico.votazione.abilitato FROM voto_elettronico.votazione 
	                        WHERE voto_elettronico.votazione.id_elezione = "'.$_SESSION["idElezione"].'" AND 
	                        voto_elettronico.votazione.id_utente = "'.$row['id'].'"');
		  
		                    if ($q = mysqli_fetch_array($query)){
			                    if($q['abilitato'] == 0)
								   echo '<input type="checkbox" value="'.$row["id"].'" name="'.$_SESSION["totale"].'">';
								else
									echo '<input type="checkbox" value="'.$row["id"].'" name="'.$_SESSION["totale"].'" disabled>';
								
	                        }
							
							
						
							
							?>
							</td>
                        </tr>
					
                        <?php
						$_SESSION["totale"]++;
                    }
                        $conn->close();
                    ?>
                     

                    </tbody>
                </table>
                <br>
                <br>
                <table data-vertable="ver1">
                    <tbody>
                    <tr class="row100">
						<td class="column100 column4" data-column="column4"><input type="submit" Value="Abilita utenti selezionati" onclick="window_reload()" ></td>
						<td class="column100 column3" data-column="column3"><a href="../chiudi.php">Chiudi la Connessione<a/></td>
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

<script type="text/javascript">

    function window_reload(){
        setTimeout(reload(), 800);
    }

    function reload(){
        document.location.reload(true);
    }


</script>
<?php
	$conn->close();
?>
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