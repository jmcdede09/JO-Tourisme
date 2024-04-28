<?php
require_once("modele/modeleMere.class.php");

class ModeleService
{
    private $pdo;
    public function __construct($serveur, $serveur2, $bdd, $user, $mdp, $mdp2)
    {
        $this->pdo = ModeleMere::getPdo($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);
    }

    public function insertService($tab)
    {
        $requete = "INSERT INTO Service (libelle, adresse, prix, tel, email, idtypeservices) VALUES (:libelle, :adresse, :prix, :tel, :email, :idtypeservices);";
        
        if ($this->pdo != null) {
            try {
            
                $insert = $this->pdo->prepare($requete);
                
             
                $insert->bindParam(':libelle', $tab['libelle'], PDO::PARAM_STR);
                $insert->bindParam(':adresse', $tab['adresse'], PDO::PARAM_STR);
                $insert->bindParam(':prix', $tab['prix'], PDO::PARAM_INT);
                $insert->bindParam(':tel', $tab['tel'], PDO::PARAM_STR);
                $insert->bindParam(':email', $tab['email'], PDO::PARAM_STR);
                $insert->bindParam(':idtypeservices', $tab['idtypeservices'], PDO::PARAM_INT);
                
               
                $insert->execute();
                
                return $this->pdo->lastInsertId();
            } catch (PDOException $e) {
            
                echo "Erreur d'insertion : " . $e->getMessage();
                return false;
            }
        }
        return false;
    }
    


    public function selectAllServices()
    {
        $requete = "SELECT * FROM Service;";

        if ($this->pdo != null) {
            // on prépare la requete 
            $select  = $this->pdo->prepare($requete);
            $select->execute();
            //extraction de tous les clients
            return $select->fetchAll();
        } else {
            return null;
        }
    }

    public function deleteService($idservice)
    {
        $requete = "DELETE FROM `Service` WHERE idservice = :idservice;";
        $donnees = array(":idservice" => $idservice);
        if ($this->pdo != null) {
            //on prepare la requete
            $delete = $this->pdo->prepare($requete);
            $delete->execute($donnees);
        }
    }

    public function selectWhereService($idservice)
    {
        $requete = "select * from Service where idservice = :idservice;";
        if ($this->pdo != null) {
            $donnees = array(":idservice" => $idservice);
            //on prepare la requete
            $select = $this->pdo->prepare($requete);
            $select->execute($donnees);
            //extraction du service
            return $select->fetch();
        } else {
            return null;
        }
    }

    public function updateService($tab)
    {
        $requete = "update Service set libelle=:libelle, adresse=:adresse, prix=:prix, tel=:tel, email=:email, idtypeservices=:idtypeservices  where idservice= :idservice;";
        $donnees = array(
            ":idservice" => $tab['idservice'],
            ":libelle" => $tab['libelle'],
            ":adresse" => $tab['adresse'],
            ":prix" => $tab['prix'],
            ":tel" => $tab['tel'],
            ":email" => $tab['email'],
            ":idtypeservices" => $tab['idtypeservices']
        );
        if ($this->pdo != null) {
            //on prepare la requete
            $insert = $this->pdo->prepare($requete);
            $insert->execute($donnees);
        }
    }
}
