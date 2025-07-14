<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Site d'emprunt</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>
    
    <main>
        <div class="container">
            <h2>BIENVENUE SUR NOTRE SITE D'EMPRUNT</h2>
            <p class="lead text-muted mb-4">Échangez et partagez des objets en toute simplicité</p>
        </div>
    </main>
    
    <footer class="bg-secondary text-white py-4">
        <?php include('footer.php'); ?>
    </footer>
    
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>