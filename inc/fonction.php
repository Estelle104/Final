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
    function inscription($nom, $email, $mdp, $date_naissance, $genre , $ville) {
        include('base.php');
        
        if(empty($nom) || empty($genre) || empty($email) || empty($mdp) || empty($date_naissance) || empty($ville)) {
            return false;
        }
        
        // Hashage sécurisé avec bcrypt (nécessite PHP 5.5+)
        // $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);
        
        // Nettoyage basique des données
        $nom = addslashes($nom);
        $prenom = addslashes($prenom);
        $email = addslashes($email);
        $genre = addslashes($genre);
        $ville = addslashes($ville);

        
        $sql = "INSERT INTO Final_membre 
                (nom, email, mdp, date_de_naissance,genre,ville) 
                VALUES ('$nom', '$email', '$mdp', '$date_naissance', '$genre', '$ville')";
        
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
    function liste_objet(){
        include('base.php');
        $sql = "SELECT * FROM v_emprunts";
        $query = mysqli_query($bdd,$sql);
        $tab=[];
        while($donne = mysqli_fetch_assoc($query)){
            $tab[]=$donne;
        }
        return $tab;

    }

    function liste_objet_encours(){
        include('base.php');
        $sql = "SELECT * FROM v_emprunts_en_cours";
        $query = mysqli_query($bdd,$sql);
        $tab=[];
        while($donne = mysqli_fetch_assoc($query)){
            $tab[]=$donne;
        }
        return $tab;

    }
    function liste_objets_empruntes() {
        include('base.php');
    
        $sql = "SELECT *
                FROM v_emprunts_en_cours ";
    
        $query = mysqli_query($bdd, $sql);
      
        $tab = [];
        while ($donne = mysqli_fetch_assoc($query)) {
            $tab[] = $donne;
        }
        return $tab;
    }

    function liste_objets_par_nom_categorie($nom_categorie) {
        include('base.php');
    
        $nom_categorie = mysqli_real_escape_string($bdd, $nom_categorie);
        $sql = "SELECT * FROM v_objets_empruntes_detailles WHERE nom_categorie = '$nom_categorie'";
    
        $query = mysqli_query($bdd, $sql);
        if (!$query) {
            die("Erreur SQL : " . mysqli_error($bdd));
        }
    
        $tab = [];
        while ($donne = mysqli_fetch_assoc($query)) {
            $tab[] = $donne;
        }
        return $tab;
    }
    function get_all_categories() {
        include('base.php');
    
        $sql = "SELECT nom_categorie FROM Final_categorie_objet";
        $query = mysqli_query($bdd, $sql);
    
        if (!$query) {
            die("Erreur SQL (get_all_categories) : " . mysqli_error($bdd));
        }
    
        $categories = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $categories[] = $row;
        }
    
        return $categories;
    }
    

    
    
?>