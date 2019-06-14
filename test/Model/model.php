<?php 
    class Model {
        private $unPdo;
        public function __construct($serveur, $bdd, $user, $mdp) {
            $this->unPdo = null;
            try {
                $this->unPdo = new PDO ("mysql:host=".$serveur.";dbname=".$bdd,$user,$mdp);
            }catch(PDOExeception $exp) {
                echo "Erreur de connexion a la base de données";
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

        // Utilisateur
        public function insertUser ($tab, $date) {
            if ($this->unPdo != null) {
                $requete = "insert into utilisateur values (null, :login, :mdp, :nom, :prenom, :genre, :numero, :naissance)";
                $donnees = array(":login"=>$tab['login'],
                ":mdp"=>$tab['mdp'],
                ":nom"=>$tab['nom'],
                ":prenom"=>$tab['prenom'],
                ":genre"=>$tab['genre'],
                ":numero"=>$tab['telephone'],
                ":naissance"=>$date);
                echo $requete; 
                $insert = $this->unPdo->prepare($requete);
                //var_dump($donnees);
                $insert->execute($donnees);
            }
        }           
        public function selectGare() {
            if ($this->unPdo != null) {
                $requete = "select * from gare;";
                
                $select = $this->unPdo->prepare ($requete);
                $select->execute();
                $resultats = $select->fetchAll();
                
                return $resultats;
            }
        }
       //Reservation
        public function afficherReservation ($tab) {
            if ($this->unPdo != null) {
                $requete = "select t.id_tr as id_train,ty.lib_ty type,d.nom_ga as gare_depart,t.depart_tr as heure_depart,a.nom_ga as gare_arrivee,
				t.arrivee_tr as heure_arrivee,c.date_ca as date,c.nbplacelibre as place_libre,c.prix as prix from train t,circuler c, gare d, gare a,type ty 
                where t.id_tr=c.id_tr
                and t.id_ga_depart=d.id_ga
                and t.id_ga_arrivee=a.id_ga
                and c.date_ca=:date
                and t.depart_tr >= :heureA
                and t.id_ga_depart=:gareD
                and t.id_ga_arrivee=:gareA
				and t.id_ty=ty.id_ty
				UNION 
				select t.id_tr, ty.lib_ty ,d.nom_ga ,t.depart_tr, a.nom_ga, s.arrivee_ar,c.date_ca,c.nbplacelibre,round(c.prix * s.distance_ar/t.distance_tr)
				from train t,circuler c,s_arreter s,gare d,gare a,type ty
				where t.id_tr=c.id_tr
				and c.date_ca=:date
				and t.depart_tr >= :heureA
				and t.id_ga_depart=:gareD
				and t.id_tr = s.id_tr and s.id_ga=:gareA
				and d.id_ga=t.id_ga_depart
				and a.id_ga=s.id_ga
				and t.id_ty=ty.id_ty
				order by 4
                ;";
                
                $donnees = array(":date"=>$tab['dateA'],
                ":heureA"=>$tab['heureA'],
                ":gareD"=>$tab['gareD'],
                ":gareA"=>$tab['gareA']);
                $select = $this->unPdo->prepare ($requete);
                $select->execute($donnees);
                $resultats = $select->fetchAll();
               // var_dump($resultats);
                return $resultats;
            }
        }
    }
?>
