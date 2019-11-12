<?php
header( 'content-type: text/html; charset=utf-8' );
session_start();
if(isset($_SESSION['login'])){
	
	$connexion = mysqli_connect("localhost", "root", "","projet_jeu");
	if (mysqli_connect_errno()){
		echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
	}
	
	$SelectAllGames = mysqli_query($connexion, "SELECT * FROM jeux");
	$SelectAllGames2 = mysqli_query($connexion, "SELECT nomJeu FROM jeux");
	$SelectAllPlayers = mysqli_query($connexion, "SELECT * FROM joueurs WHERE pseudo != 'admin'");
	$SelectAllPlayers2 = mysqli_query($connexion, "SELECT pseudo FROM joueurs WHERE pseudo != 'admin'");
	$SelectAllParty = mysqli_query($connexion, "SELECT * FROM partie");
	
	if(isset($_POST['ajouterJeu'])) {
		$nomJeu = utf8_decode($_POST['nomJeu']); 
		$nbJoueursMax = $_POST['nbJoueursMax'];
		$description = utf8_decode($_POST['description']);
		$AddGame = mysqli_query($connexion,"INSERT INTO `jeux` (`nomJeu`, `nbJoueursMax`, `description`) VALUES ('".$nomJeu."', '".$nbJoueursMax."', '".$description."');");
		header ('location: page_client.php'); 
	}
	
	if(isset($_POST['supprimerJeu'])) {
		$nomJeu = utf8_decode($_POST['suppJeu']);
		$DelGame = mysqli_query($connexion,"DELETE FROM `jeux` WHERE `nomJeu` = '".$nomJeu."';");
		header ('location: page_client.php'); 
	}
	
	if(isset($_POST['ajouterJoueur'])) {
		$pseudo = utf8_decode($_POST['pseudo']); 
		$mdp = utf8_decode($_POST['mdp']);
		
		$AddPlayer = mysqli_query($connexion,"INSERT INTO `joueurs` (`pseudo`, `mdp`, `nbPartieJoue`, `nbPartieGagne`) VALUES ('".$pseudo."', '".$mdp."', '0', '0');");
		header ('location: page_client.php'); 
	}
	
	if(isset($_POST['supprimerJoueur'])) {
		$pseudo = utf8_decode($_POST['suppJoueur']);
		
		$DelPlayer = mysqli_query($connexion,"DELETE FROM `joueurs` WHERE `pseudo` = '".$pseudo."';");
		header ('location: page_client.php'); 
	}
	

	echo'
	<html>
		<head>
			<meta charset="utf-8" />
			<link href="css/page_client.css" rel="stylesheet">
			<title>Page Client</title>
		<head>

		<body>
			<div id="gauche">
				<div id="cellule">
					<h2> Jeux sur le serveur </h2>
					<table>
						<tr>
							<th>Nom</th>
							<th>Joueurs max</th>
							<th>Description</th>
						</tr>';
						while($dataR1 = mysqli_fetch_array($SelectAllGames))
						{
							echo'
							<tr>
								<td>'.utf8_encode($dataR1["nomJeu"]).'</td>
								<td>'.$dataR1["nbJoueursMax"].'</td>
								<td>'.utf8_encode($dataR1["description"]).'</td>
							</tr>';
						}
						
						echo'
					</table>
					
					</br>';
					
	if($_SESSION['login']=="admin"){
					echo'	
					<form action="page_client.php" method="post" class="formulaire">
						<fieldset>
							<legend>Ajouter un jeu</legend>
							
							<input type="text" name="nomJeu" id="nomJeu" placeholder="Nom du jeu" required/></br>
						
							<input type="number" min="2" max="100" name="nbJoueursMax"  id="nbJoueursMax" placeholder="Nombre de joueurs max" required/></br>
							
							<textarea name="description"  id="description" placeholder="Description"></textarea></br>
					
							<input type="submit" name="ajouterJeu" value="Ajouter" id="submit">
						</fieldset>
					</form>
					
					<form action="page_client.php" method="post" class="formulaire">
						<fieldset>
							<legend>Supprimer un jeu</legend>
							
							<select name="suppJeu" id="suppJeu">';
								while($dataR2 = mysqli_fetch_array($SelectAllGames2))
								{
									echo'<option value="'.utf8_encode($dataR2["nomJeu"]).'">'.utf8_encode($dataR2["nomJeu"]).'</option>';
								}
							echo'
							</select>
						
							<input type="submit" name="supprimerJeu" value="Supprimer" id="submit">
							
						</fieldset>
					</form>';
	}
				echo'
				</div>
				<div id="cellule">
					<h2> Joueurs sur le serveur </h2>
					
					<table>
						<tr>
							<th>Pseudo</th>
							<th>Nombre de parties joué</th>
							<th>Nombre de parties gagné</th>
						</tr>';
						while($dataR3 = mysqli_fetch_array($SelectAllPlayers))
						{
							echo'
							<tr>
								<td>'.utf8_encode($dataR3["pseudo"]).'</td>
								<td>'.$dataR3["nbPartieJoue"].'</td>
								<td>'.$dataR3["nbPartieGagne"].'</td>
							</tr>';
						}
						
						echo'
					</table>
					
					</br>';
					
	if($_SESSION['login']=="admin"){
					echo'
					<form action="page_client.php" method="post" class="formulaire">
						<fieldset>
							<legend>Ajouter un joueur</legend>
							
							<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/></br>
							
							<input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required/></br>
						
							<input type="submit" name="ajouterJoueur" value="Ajouter" id="submit">
						</fieldset>
					</form>
					
					<form action="page_client.php" method="post" class="formulaire">
						<fieldset>
							<legend>Supprimer un joueur</legend>
							
							<select name="suppJoueur" id="suppJoueur">';
								while($dataR4 = mysqli_fetch_array($SelectAllPlayers2))
								{
									echo'<option value="'.utf8_encode($dataR4["pseudo"]).'">'.utf8_encode($dataR4["pseudo"]).'</option>';
								}
							echo'
							</select>
						
							<input type="submit" name="supprimerJoueur" value="Supprimer" id="submit">
						</fieldset>
					</form>';
	}
				echo'
				</div>
				
			</div>
			
			<div id="droite">
				<div id="cellule">
					<h2>Historique des parties</h2>
					
					<form action="page_client.php" method="post" class="formulaire">
						<fieldset>
							<legend>Séléction de la partie</legend>
							<select name="partie" id="partie">';
								while($dataR5 = mysqli_fetch_array($SelectAllParty))
								{
									echo'<option value="'.$dataR5["idPartie"].'">Partie n°'.$dataR5["idPartie"].' sur le jeu `'.utf8_encode($dataR5["nomJeu"]).'`</option>';
								}
							echo'
							</select>
						
							<input type="submit" name="selectParty" value="Sélectionner" id="submit">
						</fieldset>
					</form>
					
					</br>';
					
					if(isset($_POST['selectParty'])) {
						$partie = $_POST['partie'];
						$PlayersGame = mysqli_query($connexion,"SELECT * FROM joueursparpartie WHERE idPartie = '".$partie."';");
						$GameHistory = mysqli_query($connexion,"SELECT * FROM historique WHERE idPartie = '".$partie."' ORDER BY idHistorique;");
						
						echo'
						
						<h3> Joueurs dans la partie </h3>
						
						<table>
							<tr>
								<th>Pseudo</th>
								<th>Score</th>
							</tr>';
						
							while($dataR6 = mysqli_fetch_array($PlayersGame))
							{
								echo'
								<tr>
									<td>'.utf8_encode($dataR6["pseudo"]).'</td>
									<td>'.$dataR6["score"].'</td>
								</tr>';
							}
						echo'
						</table></br>
					
						<h3> Historique de la partie </h3>
					
						<table>
							<tr>
								<th>Numéro de tour</th>
								<th>Etat du jeu</th>
							</tr>';
						
							while($dataR7 = mysqli_fetch_array($GameHistory))
							{
								echo'
								<tr>
									<td>'.$dataR7["numTour"].'</td>
									<td>'.utf8_encode($dataR7["EtatJeu"]).'</td>
								</tr>';
							}
						echo'
						</table>';
					}
					echo'
				</div>
			</div>
			
			<footer>
				<a href="deconnexion.php">Déconnexion</a>
			</footer>
			
			
		</body>
	</html>';
	mysqli_close($connexion);
}else{
	header ('location: index.php');
}


?>