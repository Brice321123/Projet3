<?php 
	//appel le modele
	require_once("Model/model.php");
	class Controller {
		private $unModele;
		public function __construct ($serveur,$bdd, $user, $mdp) {
			// instanciation de la classe Modele
			$this->unModele = new Model ($serveur,$bdd, $user, $mdp);
		}
		public function selectAll($tdb) {
			$resultats = $this->unModele->selectAll($tdb);
			return $resultats;
		}
		public function selectOne($tdb,$wid,$id) {
			$resultat = $this->unModele->selectOne($tdb,$wid,$id);
			return $resultat;
		}
		public function selectTwo($tdb,$wid1,$id1,$wid2,$id2) {
			$resultat = $this->unModele->selectTwo($tdb,$wid1,$id1,$wid2,$id2);
			return $resultat;
		}
		public function delete($tdb,$wid,$id) {
			$this->unModele->delete($tdb,$wid,$id);
		}
		public function deleteTwo($tdb,$wid1,$id1,$wid2,$id2) {
			$this->unModele->deleteTwo($tdb,$wid1,$id1,$wid2,$id2);
		}
		public function insertTab($tdb,$tab) {
			$this->unModele->insertTab($tdb,$tab);
		}
		public function updateTab($tdb,$n,$tab) {
			$this->unModele->updateTab($tdb,$n,$tab);
		}
		
		public function verifconnexion ($log, $mdp) {
			// On peut controler les donnnees avant leurs envoie => verifier le login est bien si il est composer de 6 caractere ...
			return $this->unModele->verifconnexion($log, $mdp);
		}		
	}
?>