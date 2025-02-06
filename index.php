<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Manu Ecology - Planning</title>

    <link rel="stylesheet" href="ressources/style.css?v=1.0">
    <script defer src="ressources/eventDetails.js"></script>

    <?php 
    require_once "view/calendar.php"; 
    require_once 'controller/calendarController.php';

echo '</head>';
echo '<body>';
    require_once "view/header.php";
    echo '<main>';
        echo '<div id="bodyFont">';
            drawCalendarFilter(); 
            echo '<div id="calendar">';
                if(isFilterSet() != true){
                    echo 'Veuillez sélectionner une date comprise entre les 5 dernières ou les 5 prochaines années.';
                }

            echo '</div>';
            require_once "view/detailView.php";
        echo '</div>';
    echo '</main>';
    require_once "view/footer.php"; 
    ?>
</body>
</html>