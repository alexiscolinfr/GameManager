<?php
header( 'content-type: text/html; charset=utf-8' );
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION


if(isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
	$login = htmlentities($_POST['login'], ENT_QUOTES, "ISO-8859-1"); 
	$mdp = htmlentities($_POST['mdp'], ENT_QUOTES, "ISO-8859-1");
	$captcha =  htmlentities($_POST['captcha'], ENT_QUOTES, "ISO-8859-1");
	$nombre1 =  htmlentities($_POST['nombre1'], ENT_QUOTES, "ISO-8859-1");
	$nombre2 =  htmlentities($_POST['nombre2'], ENT_QUOTES, "ISO-8859-1");
	
	if ($captcha != $nombre1+$nombre2){
		$message="Captcha incorrect";
		echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
	} else {
		//Connexion à la base de données:
		$connexion = mysqli_connect("localhost", "root", "","projet_jeu");
		if (mysqli_connect_errno()){
			echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
		}
		
		$Requete = mysqli_query($connexion,"SELECT * FROM joueurs WHERE pseudo = '".$login."' AND mdp = '".$mdp."'") or die(mysqli_error($sql));;
		if(mysqli_num_rows($Requete) == 0) {
			$message="Pseudo/mot de passe incorrect";
			echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		} else {
			// on ouvre la session avec $_SESSION:
			$_SESSION['login'] = $login; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
			header ('location: page_client.php'); 
		}
		mysqli_close($connexion);
	}
}

$a=rand(1,10);
$b=rand(1,10);

echo'<html>
	<head>
		<meta charset="utf-8" />
		<link href="css/index.css" rel="stylesheet">
		<title>Connexion</title>
	<head>


	<body>
		<div class="login-block">
			<form action="index.php" method="post">
				<h1>Projet Jeu - UVSQ</h1>
				<h1>Connexion</h1>
				
				<input type="text" name="login" placeholder="Login" id="login" required/>
				<input type="password" name="mdp" placeholder="Mot de passe" id="mdp" required/>
				<input type="hidden" name="nombre1" value="'.$a.'">
				<input type="hidden" name="nombre2" value="'.$b.'">
				<input type="number" name="captcha" placeholder="Combien font '.$a.'+'.$b.' ?" id="captcha" required/>
				
				<input type="submit" name="connexion" value="Envoyé" id="submit">
			</form>	
		</div>
	</body>
</html>';

?>