<?php
    function login($email, $mdp) {
        include('base.php');
        $sql = "SELECT * FROM Final_membre WHERE email = '$email' AND mdp = '$mdp'";
        $result = mysqli_query($bdd, $sql);
        
        if($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
                return $user;
        }
        
        return false;
    }
    function inscription($nom, $prenom, $email, $mdp, $type_user) {
        include('base.php');
        
        if(empty($nom) || empty($prenom) || empty($email) || empty($mdp)) {
            return false;
        }
        
        // Hashage sécurisé avec bcrypt (nécessite PHP 5.5+)
        $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);
        
        // Nettoyage basique des données
        $nom = addslashes($nom);
        $prenom = addslashes($prenom);
        $email = addslashes($email);
        $telephone = addslashes($telephone);
        $type_user = addslashes($type_user);
        
        $sql = "INSERT INTO utilisateurs 
                (nom, prenom, email, mot_de_passe, telephone, type_utilisateur, date_inscription, statut) 
                VALUES ('$nom', '$prenom', '$email', '$mdp_hash', '$telephone', '$type_user', NOW(), 'actif')";
        
        $result = mysqli_query($bdd, $sql);
        
        return $result;
    }

    function getPublication(){
        include('base.php');

        $sql = "SELECT * FROM v_pub_emploi_entre_user LIMIT 2";
        $query = mysqli_query($bdd,$sql);
        $tab = [];
        while($donne = mysqli_fetch_assoc($query)){
            $tab[]=$donne;
        }
        return $tab;
    }
    function getFicheOffre($id_pub){
        include('base.php');

        $sql = "SELECT * FROM v_pub_emploi_entre_user WHERE id_publication='$id_pub' LIMIT 1";
        $query = mysqli_query($bdd,$sql);
        return $query;
    }

    function getAllPublication(){
        include('base.php');

        $sql = "SELECT * FROM v_pub_emploi_entre_user 
        WHERE date_expiration >= CURDATE() 
        ORDER BY date_publication DESC";
        $query = mysqli_query($bdd,$sql);
        $tab=[];
        while($donne = mysqli_fetch_assoc($query)){
            $tab[]=$donne;
        }
        return $tab;
        
    }
?>