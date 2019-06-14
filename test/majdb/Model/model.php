<?php 
class Model {
	private $unPdo;
	
	public function __construct($serveur, $bdd, $user, $mdp) {
		$this->unPdo = null;
		try {
			// Connexion a la base de données en utilisant la classe PDO
		$this->unPdo = new PDO ("mysql:host=".$serveur.";dbname=".$bdd,$user,$mdp);
			
		} catch(PDOExeception $exp) {
			echo "Erreur de connexion a la base de données";
			// Afficher le message d'erreur php
			echo $exp->getMessage();
		}
	}
	public function verifconnexion ($login, $mdp) {
		if ($this->unPdo != null) {
			$requete = "select * from utilisateur where login = :login and mdp = :mdp;";
			$donnees = array(":login"=>$login, ":mdp"=>$mdp);
			$select = $this->unPdo->prepare($requete);
			$select->execute($donnees);
			$resultat = $select->fetch();
			return $resultat;
		}
	}
	
	public function selectAll($tdb) {
		if ($this->unPdo != null) {
			$requete = "select * from ".$tdb." order by 1 desc,2 desc;"; //Tri descendant  sur les 2 premiers champs
			$select = $this->unPdo->prepare ($requete); 
			$select->execute ();
			$resultats = $select->fetchAll();
			return $resultats;
		}
	}
	public function selectOne($tdb,$wid,$id) { 
		if ($this->unPdo != null) {
			$requete = "select * from ".$tdb." where ".$wid."='".$id."';";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultat = $select->fetch();
			return $resultat;
		}
	}	
	public function selectTwo($tdb,$wid1,$id1,$wid2,$id2) { 
		if ($this->unPdo != null) {
			$requete = "select * from ".$tdb." where ".$wid1."='".$id1."' and ".$wid2."='".$id2."';";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultat = $select->fetch();
			return $resultat;
		}
	}	
	public function delete($tdb,$wid,$id) {
	if ($this->unPdo != null) {
			$requete = "select * from ".$tdb." where ".$wid."='".$id."';";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultat = $select->fetch();
			if ($resultat) {
				$requete = "delete from ".$tdb." where ".$wid."='".$id."';";
				$delete = $this->unPdo->prepare($requete);
				$delete->execute();
			}else{
				echo "<div class='alert alert-danger' role='alert'>";
                echo "<strong>"; 
                echo "Identifiant ".$id." inexistant.";
                echo "</strong>";
                echo "</div>";
			}
		}
	}
	public function deleteTwo($tdb,$wid1,$id1,$wid2,$id2) {
	if ($this->unPdo != null) {
			$requete = "select * from ".$tdb." where ".$wid1."='".$id1."' and ".$wid2."='".$id2."';";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultat = $select->fetch();
			if ($resultat) {
				$requete = "delete from ".$tdb." where ".$wid1."='".$id1."' and ".$wid2."='".$id2."';";
				$delete = $this->unPdo->prepare($requete);
				$delete->execute();
			}else{
				echo "<div class='alert alert-danger' role='alert'>";
                echo "<strong>"; 
                echo "Identifiant ".$id1." ".$id2." inexistant.";
                echo "</strong>";
                echo "</div>";
			}
		}
	}
	public function insertTab ($tdb,$tab) {
		if ($this->unPdo != null) {
			$requete = "insert into ".$tdb." values (";
			$nb=count($tab) - 1; //On retire le champ 'créer' ou 'Modifier'
			$i=1;
			foreach ($tab as $t){
				$t=str_replace("'","''",$t); //Double le caractère ' (séparateur)
				$t=str_replace('"',"''",$t); //Remplace le catactère " par ''
				if ($t == "") {$ch="null";}else {$ch="'".$t."'";}
				if ($i == $nb) {$ch=$ch.");";}else{$ch=$ch.", ";} //Si dernier champ on ferme la requete
				if ($i <= $nb) {$requete = $requete.$ch;}
				$i++;
			}
			//var_dump($requete);
			$insert = $this->unPdo->prepare ($requete);
			$insert->execute();
		}
	}
	public function updateTab ($tdb,$n,$tab) {
		if ($this->unPdo != null) {
			$requete = "update ".$tdb." set ";
			$nb=count($tab) - 1; //On retire le champ 'créer' ou 'Modifier'
			$i=1;
			$cle="";
			//var_dump($tab);
			foreach ($tab as $nom => $t){
				$t=str_replace("'","''",$t); //Double le caractère ' (séparateur)
				$t=str_replace('"',"''",$t); //Remplace le catactère " par ''
				if ($i <= $n) {//Prepare champ clé pour clause where
					if($i == $n){
						$cle=$cle.$nom."='".$t."';"; //dernier champ
					}else{
						$cle=$cle.$nom."='".$t."' and ";
				}
				}else {
				if ($t == "") {$ch=$nom."=null";}else {$ch=$nom."='".$t."'";}
				if ($i == $nb) {//Si dernier champ on prépare clause where
					$ch=$ch." where ".$cle;					
				}else{
					$ch=$ch.", ";
				} 
				if ($i <= $nb) {$requete = $requete.$ch;}
				}
				$i++;
			}
			//var_dump($requete);
			$insert = $this->unPdo->prepare ($requete);
			$insert->execute();
		}
	}
	
}
?>
