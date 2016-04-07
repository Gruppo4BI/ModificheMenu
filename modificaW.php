<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Borsa delle idee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link href="menu.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$nl="<br/>";
include_once 'configurazioneDB.php';
// ricavo tutte le informazioni che mi servono sull azienda tramite l id che p una variabile di sessione
$comando= "select * from azienda where id='".$_SESSION['id']."'";
$result = $conn->query($comando);
$dati = $result->fetch_assoc();
//ricavo attraverso l idCat il nome della categoria della mia azienda
$SQLcateg ="select categoria from categoria where idCat='".$dati['idCat']."'";
$result_cat = $conn->query($SQLcateg);
$dati_cat=$result_cat->fetch_assoc();
// il nome sarË† memorizzato nella variabile categoria
$categoria=$dati_cat['categoria'];
// questa Â un altra query che mi serve per pooi avere tutta la lista di categorie senza quella che  stata selezionata precedentemente
$comandoSQL ="select categoria from categoria where categoria !='".$categoria."'";

		$result=mysqli_query($conn,$comandoSQL); 
		
// ricavo le informazioni sui telefoni della mia azienda tramite idTel ottenuto con la prima query
$SQLtel ="select * from telefoni where id='".$dati['idTel']."'";
$result_tel = $conn->query($SQLtel);
$dati_tel=$result_tel->fetch_assoc();
?>
<!-- sono classi predefinite, inverse vuol dire sfondo scuro
	quella di default Â chiara -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
  
  <!-- questo Â l header contiene gli elementi che devono essere visibili anche quando la barra Â minimizzata per i display di piccole dimensioni -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        <span class="icon-bar"></span>   
        <!-- Ciascuno di questi disegna una lineetta sul pulsante quando si minimizza la pagina -->                     
      </button>
      <a class="navbar-brand" href=" ">Borsa delle Idee</a>
    </div>
 <!--  elementi della barra -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Menu.php">Home</a></li>
        <li><a href="#">About</a></li>
         <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Idee <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Crea</a></li>
          <li><a href="#">Cerca</a></li>
        </ul>
      </li>
        <li><a href="#">Contatti</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">

    <br>
    <div class="col-sm-offset-2 col-sm-8">
      <div class="well well-lg">
        <h4>Modifica i tuoi dati</h4>
        
        <?php 
// se emodifica.php mi da qualche errore, compariranno dei messaggi di avvertimento, con lo switch gestisco i var casi
if( isset($_GET['errore']) )
{
	echo "<p id='box_errore'> <div class='alert alert-danger'>
    <strong>Attenzione!</strong> ";
	switch ($_GET['errore'])
	{
	case 1:
		echo "Numero di telefono/cellulare o fax non valido";
		break;
		
	case 2:
		echo "Mail non valida";
		break;
		}
		echo "</div>";
}
?> 
           <!-- Questo Â un form con tutti i dati che sarË† possibile modificare, utilizzeremo il metodo post -->
  <form method="post" name="registra" action="emodifica.php" id="registra">
 
  <fieldset class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value='<?php echo $dati["email"]; ?>' >
  </fieldset>
  <fieldset class="form-group">
    <label for="cap">Cap</label>
    <input type="text" class="form-control" id="cap" name="cap" value='<?php echo $dati["cap"]; ?>'>
  </fieldset>
  
  <fieldset class="form-group">
    <label for="indirizzo">Indirizzo</label>
    <input type="indirizzo" class="form-control" id="indirizzo" name="indirizzo" value='<?php echo $dati["indirizzo"]; ?>' >
  </fieldset>
  
  <fieldset class="form-group">
    <label for="citta">Citta</label>
    <input type="text" class="form-control" id="citta" name="citta" value='<?php echo $dati["citta"]; ?>'>
  </fieldset>
  
    <fieldset class="form-group">
    <label for="p_ivaOcf">Partita Iva o Cod Fiscale</label>
    <input type="text" class="form-control" id="p_ivaOcf" name="p_ivaOcf" value='<?php echo $dati["p_ivaOcf"]; ?>'>
    </fieldset>
    
   <fieldset class="form-group">
   <label for="sito_web">Sito </label>
    <input type="text" class="form-control" id="sito_web" name="sito_web" value='<?php echo $dati["sito_web"]; ?>'>
  </fieldset>
  
  
   <fieldset class="form-group">
    <label for="numero">Telefono </label>
    <input type="text" class="form-control" id="numero" name="numero" value='<?php echo $dati_tel["numero"]; ?>'>
  </fieldset>
  
    <fieldset class="form-group">
    <label for="numero2">Telefono 2 </label>
    <input type="text" class="form-control" id="numero2" name="numero2" value='<?php echo $dati_tel["numero2"]; ?>'>
  </fieldset>
  
     <fieldset class="form-group">
    <label for="fax">Fax </label>
    <input type="text" class="form-control" id="fax" name="fax" value='<?php echo $dati_tel["fax"]; ?>'>
  </fieldset>
  
       <fieldset class="form-group">
    <label for="cellulare">Cellulare</label>
    <input type="text" class="form-control" id="cellulare" name="cellulare" value='<?php echo $dati_tel["cellulare"]; ?>'>
  </fieldset>
  
  <fieldset class="form-group">
    <label for="elencoCategorie">Categoria</label>
  <select class="form-control"  name='elencoCategorie' >
												<option  value="<?php  echo $categoria ?>" selected><?php  echo $dati_cat['categoria'];?> </option>
											<?php 			
													while	($row = mysqli_fetch_assoc($result) ){
														echo"<option id='$row[idCat]'>$row[categoria]</option>";
													}
											?>		
												</select>
  </fieldset>
  
  <fieldset class="form-group">
    <label for="parlaci">Maggiori dettagli</label>
    <textarea class="form-control" id="parlaci" name="parlaci" rows="3"> <?php echo $dati["parlaci"]; ?> </textarea>
  </fieldset>
  
<!-- questo potrÃ  essere aggiunto dopo per caricare l immagine dell azienda 
  <fieldset class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" class="form-control-file" id="exampleInputFile">
    <small class="text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
  </fieldset> -->
  <input id="aggiorna" value="AGGIORNA" type="submit" name="aggiorna"></td>
</form>

  </div>
<br/> <p style="text-align: right"><a href='Menu.php'><button> Indietro </button></a></p>
  </div>
</div>

</body>
</html>

</body>
</html>
