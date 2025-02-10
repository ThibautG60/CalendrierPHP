<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Manu Ecology - Planning</title>

    <link rel="stylesheet" href="ressources/style.css?v=1.0">
    <script defer src="ressources/eventDetails.js"></script>

    <body>
        <?php include_once 'view/header.php'; //- On importe le header ?>
    <main>
        <div id="bodyFont">
            <?php 
                include_once 'controller/calendarController.php'; //- On importe le controller pour qu'il charge toutes les scripts pour le calendrier 
                include_once 'view/dialog.php'; //- On importe le dialog qui servira à afficher les détails d'un event
            ?>
        </div>
    </main>
        <?php include_once 'view/footer.php'; //- On importe le footer ?> 
    </body>
</html>