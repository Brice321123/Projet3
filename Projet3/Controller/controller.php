<?php 
    require_once("Model/model.php");
    class Controller {
        private $unModele;
        public function __construct ($serveur,$bdd,$user,$mdp) {
            $this->unModele = new Model ($serveur,$bdd, $user, $mdp);
        }
        public function verifconnexion ($log, $mdp) {
            return $this->unModele->verifconnexion($log, $mdp);
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
		public function insertTab($tdb,$tab) {
			$this->unModele->insertTab($tdb,$tab);
		}
		public function updateTab($tdb,$n,$tab) {
			$this->unModele->updateTab($tdb,$n,$tab);
		}

        //Utilisateur
        public function insertUser($tab, $date) {
            $this->unModele->insertUser($tab, $date);
        }
        //Gare
         public function selectGare() {
            $resultats = $this->unModele->selectGare();
            return $resultats;
        }
        //Reservation
        public function afficherReservation($tab) {
            $resultats = $this->unModele->afficherReservation($tab);
            return $resultats;
        }
    }
?>