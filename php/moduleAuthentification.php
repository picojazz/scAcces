<?php
	include 'moduleConnexion.php';
	session_start();
	//connexion
	if(isset($_POST['connect']) ){


		$login=htmlspecialchars($_POST['login']);
		$pass=md5(htmlspecialchars($_POST['password']));
		$profil=htmlspecialchars($_POST['profil']);

		
		$verif=$db->query("SELECT * FROM users WHERE login='$login' AND password='$pass' AND profil='$profil'" ); 
		$info=$verif->fetch(PDO::FETCH_ASSOC);
		$user=$verif->rowCount();
		
		
		if($user){
			
			
		
		
		 $_SESSION['login'] = $info['login']; 
		 $_SESSION['nom'] = $info['nom']; 
		 $_SESSION['prenom'] = $info['prenom']; 
		 $_SESSION['profil'] = $info['profil']; 
		
		 if ($info['profil'] == 'admin') {
		 	header("location:admin.php?sign=in");
		 }else{
		 	header("location:user.php?sign=in");
				}
		}else{
			header("location:../index.php?erreur=login");
		}
	}
	//inscription
	if (isset($_POST['signup'])) {
		$prenom=htmlspecialchars($_POST['prenom']);
		$nom=htmlspecialchars($_POST['nom']);
		$login=htmlspecialchars($_POST['login']);
		$pass=md5(htmlspecialchars($_POST['password']));
		
		

		if (empty($prenom) || empty($nom) || empty($login) || empty($pass)) {
			header("location:../index.php?sign=no");
		}else{
			if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
				copy($_FILES['photo']['tmp_name'],"../image/userImage/".$_FILES['photo']['name']);
				$photoName=$_FILES['photo']['name'];
				$photopath="../image/userImage/$photoName";
				$req=sprintf("INSERT INTO users (prenom,nom,profil,login,password,photo)VALUES('$prenom','$nom','user','$login','$pass','$photopath')" ); 
			}else{
		
		$req=sprintf("INSERT INTO users (prenom,nom,profil,login,password)VALUES('$prenom','$nom','user','$login','$pass')" ); 
				}
		$verif=$db->query($req);

		header("location:../index.php?sign=ok");
		}
		
	}


	//deconnexion
	if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ 
	$prenom = $_SESSION['prenom']; 
	session_unset();
    session_destroy();
	header("Location:../index.php?erreur=delog&prenom=$prenom");
}
?>
