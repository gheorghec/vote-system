<?php 
require_once 'class/CLASSinsert_vote.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	if(isset($_POST['nume']) && isset($_POST['prenume']) && isset($_POST['cnp']) && isset($_POST['candidat'])){
		$vote = new Insert_vote();
		$vote -> vote($_POST['nume'], $_POST['prenume'], $_POST['cnp'], $_POST['candidat']);
			session_start();
			$_SESSION['nume'] = $_POST['nume']." ".$_POST['prenume'];
		header('Location: vote.php');
		exit;
	}
}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vote System</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><a href="index.php">Voteaza</a></li>
      <li><a href="vote.php">Voturi</a></li>
    </ul>
  </div>
</div>
<div class="">
<form id="vote-form" action="" method="post">
 <div class="row">
    <div class="large-6 large-offset-3 columns">
      <label >Nume
        <input type='text' id='nume' name='nume' onkeyup='validate(this);'  />
      </label>
    </div>
</div>
 <div class="row">
    <div class="large-6 large-offset-3 columns">
      <label>Prenume
        <input id="prenume" name="prenume" type="text" onkeyup='validate(this);' onfocus='this.select();'>
      </label>
    </div>
</div>
</div>
 <div class="row">    
    <div class="large-6 large-offset-3 columns">
      <label>CNP
        <input id="cnp" name="cnp" type="text" onkeyup='validate(this);' onfocus='this.select();'>
      </label>
    </div>
  </div>
  <div class="row">
   <fieldset class="large-6 large-offset-3 columns">
    <legend>Alege Favoritul</legend>
    <input type="radio" name="candidat" value="1" id="pokemonRed" required><label for="pokemonRed">Red</label>
    <input type="radio" name="candidat" value="2" id="pokemonBlue"><label for="pokemonBlue">Blue</label>
    <input type="radio" name="candidat" value="3" id="pokemonYellow"><label for="pokemonYellow">Yellow</label>
    <input type="radio" name="candidat" value="4" id="pokemonYellow"><label for="pokemonYellow">Black</label>
  </fieldset>
</div>
   <div class="row">    
    <div class="large-6 large-offset-3 columns">
        <input type="button" onclick="sbm()" value="Submit" class="success button">
    </div>
  </div>
</form>

<div class="row">
	<div class="large-6 large-offset-3 columns">
		<div id="error"></div>
		<div id="succes"></div>
	</div>
</div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>
      	$(document).foundation();
    </script>

  </body>
</html>