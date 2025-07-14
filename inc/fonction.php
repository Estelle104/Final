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
    
    function get_sous_image($id_image_principale){
        include('base.php');

        $sql = "SELECT * FROM Final_sous_image WHERE id_image_principale = '$id_image_principale'";
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
    function add_sous_image($id_image_principale, $nom, $id_objet){
        include('base.php');
    
        // Protection contre injection SQL (minimum)
        $nom = mysqli_real_escape_string($bdd, $nom);
    
        $sql = "INSERT INTO Final_sous_image (id_objet, id_image_principale, nom_sous_image)
                VALUES ($id_objet, $id_image_principale, '$nom')";
    
        $query = mysqli_query($bdd, $sql);
    
        if (!$query) {
            echo "Erreur SQL : " . mysqli_error($bdd);
        }
    
        return $sql;
    }
    

// function tab($a,$b){
//     $x=array();
//     $i=0;
//     for ($i=0; $i <count($a) ; $i++) { 
//         $x[]='../assets/image/'.$a[$i];
//     }
//     $x[$i]='../assets/image/'.$b;
//     return $x;
// }

function getSousImage1($id){
    include('base.php');
    $sql="SELECT nom_sous_image FROM Final_sous_image WHERE id_objet = '$id' ";
    $result = mysqli_query($bdd,$sql);
    $donnee = array();
while($a = mysqli_fetch_assoc($result))
{
    $donnee[] = $a;
}
return $donnee;    
}
function img_principale($id){
    include('base.php');

     $sql="SELECT * FROM Final_image_objet WHERE id_objet = '$id'";
     $sqli=mysqli_query($bdd,$sql);
     $ami=mysqli_fetch_assoc($sqli);
     return $ami;
}

function emprunt($id){
    include('base.php');

    $sql = "SELECT * 
            FROM Final_emprunt 
            JOIN Final_objet ON Final_objet.id_objet = Final_emprunt.id_objet 
            JOIN Final_membre ON Final_membre.id_membre = Final_emprunt.id_membre 
            WHERE Final_objet.id_objet = '%s'";
            
    $sql = sprintf($sql, mysqli_real_escape_string($bdd, $id));

    $result = mysqli_query($bdd, $sql);

    if (!$result) {
        die("Erreur SQL : " . mysqli_error($bdd) . "<br>Requête : " . $sql);
    }

    $donnee = array();
    while ($a = mysqli_fetch_assoc($result)) {
        $donnee[] = $a;
    }

    return $donnee; 
}

function get_fiche_membre($id_membre) {
    include('base.php');
    
    // Validation de l'ID
    if (!is_numeric($id_membre)) {
        return null;
    }

    // 1. Requête pour les infos du membre
    $sql_membre = "SELECT * FROM Final_membre WHERE id_membre = ?";
    $stmt_membre = mysqli_prepare($bdd, $sql_membre);
    mysqli_stmt_bind_param($stmt_membre, "i", $id_membre);
    mysqli_stmt_execute($stmt_membre);
    $result_membre = mysqli_stmt_get_result($stmt_membre);
    
    if (!$result_membre || mysqli_num_rows($result_membre) === 0) {
        return null;
    }
    $membre = mysqli_fetch_assoc($result_membre);

    // 2. Requête pour les objets
    $sql_objets = "SELECT 
                    c.id_categorie, c.nom_categorie,
                    o.id_objet, o.nom_objet,
                    i.nom_image
                   FROM Final_objet o
                   JOIN Final_categorie_objet c ON o.id_categorie = c.id_categorie
                   LEFT JOIN Final_image_objet i ON o.id_objet = i.id_objet
                   WHERE o.id_membre = ?
                   ORDER BY c.nom_categorie, o.nom_objet";
    
    $stmt_objets = mysqli_prepare($bdd, $sql_objets);
    mysqli_stmt_bind_param($stmt_objets, "i", $id_membre);
    mysqli_stmt_execute($stmt_objets);
    $result_objets = mysqli_stmt_get_result($stmt_objets);

    $categories = [];
    if ($result_objets) {
        while ($row = mysqli_fetch_assoc($result_objets)) {
            $cat_id = $row['id_categorie'];
            
            if (!isset($categories[$cat_id])) {
                $categories[$cat_id] = [
                    'id_categorie' => $row['id_categorie'],
                    'nom_categorie' => $row['nom_categorie'],
                    'objets' => []
                ];
            }
            
            $categories[$cat_id]['objets'][] = [
                'id_objet' => $row['id_objet'],
                'nom_objet' => $row['nom_objet'],
                'image_objet' => $row['nom_image']
            ];
        }
    }

    return [
        'membre' => $membre,
        'categories' => array_values($categories)
    ];
}


function upDateEmprunt($newdate, $id_membre, $id_obet){
    include('base.php');

    $nom = mysqli_real_escape_string($bdd, $nom);
    $now = date('Y-m-d H:i:s');
    $datetime = DateTime::createFromFormat('Y-m-d\TH:i', $newdate);
   
    $date_mysql = $datetime->format('Y-m-d H:i:s');
    $sql = "UPDATE TABLE Final_emprunt SET (date_emprunt,date_retour, id_membre) VALUES ('$now','$date_mysql','$id_membre') WHERE id_objet = '$id_obet'";

    $query = mysqli_query($bdd, $sql);

    if (!$query) {
        echo "Erreur SQL : " . mysqli_error($bdd);
    }

    return $sql;
}

function joursRestants($date_future) {
    $now = time();
    $future = strtotime($date_future);
    
    if (!$future || $future <= $now) {
        return 0;
    }
    
    return ceil(($future - $now) / (60 * 60 * 24));
}

function get_emprunts_par_membre($id_membre) {
    include('base.php');

    $sql = "SELECT e.*, o.nom_objet, i.nom_image, o.id_objet
            FROM Final_emprunt e
            JOIN Final_objet o ON e.id_objet = o.id_objet
            LEFT JOIN Final_image_objet i ON o.id_objet = i.id_objet
            WHERE e.id_membre = '$id_membre'";

    $query = mysqli_query($bdd, $sql);

    if (!$query) {
        die("Erreur SQL : " . mysqli_error($bdd));
    }

    $emprunts = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $emprunts[] = $row;
    }

    return $emprunts;
}
    

    
?>