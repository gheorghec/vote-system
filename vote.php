<?php
include_once 'class/CLASSSelect_vote.php';
$a = DB::querry('SELECT *');
$a = DB::querry(' FROM');
$a = DB::querry(' person');
$a = DB::querry(' INNER JOIN vote');
$a = DB::querry(' ON person.pers_id = vote.pers_id');
$a = DB::querry(' INNER JOIN candidate');
$a = DB::querry(' ON vote.cand_id = candidate.cand_id')->exec();
$result =(array) $a;
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
    <style type="text/css" class="init"></style>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
<script type="text/javascript" language="javascript" class="init">
	
$(document).ready(function() {
	$('#example').DataTable( {
		"order": [[ 3, "desc" ]]
	} );
} );

	</script>
  </head>
  <body>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><a href="index.php">Voteaza</a></li>
      <li><a href="vote.php">Voturi</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
  	<li><a id="voted"></a></li>
  </div>
</div>
<div class="row">
	<div class="large-12 columns">
		<div class="demo-html"></div>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nume</th>
						<th>Prenume</th>
						<th>Votat</th>
						<th>Data</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Nume</th>
						<th>Prenume</th>
						<th>Votat</th>
						<th>Data</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						foreach ($result as $r){
							foreach ($r as $votes){
								$row = "<tr>";
								$row .="<td>".$votes['first_name']."</td>";
								$row .="<td>".$votes['last_name']."</td>";
								$row .="<td>".$votes['name']."</td>";
								$row .="<td>".$votes['date_time']."</td>";
								$row .= "</tr>";
								echo $row;
							}
						}
					?>
					
				</tbody>
			</table>
	</div>
</div>


    
    <script>
      	$(document).foundation();
    </script>
<?php 
session_start();
if(isset($_SESSION['nume'])){
	?>
	<script>
		$("#voted").css("display", "block");
		$("#voted").html("Va multumim pentru vot: <?php echo $_SESSION['nume']?>");
	</script>
	<?php
	session_destroy();
}else{
	session_destroy();
}
?>
  </body>
</html>