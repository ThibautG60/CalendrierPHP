<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Manu Ecology - Planning</title>

    <link rel="stylesheet" href="ressources/style.css?v=1.0">
    <script defer src="ressources/eventDetails.js"></script>
</head>
<body>
    <header>
        <h1>La Manu Ecology - Planning</h1>
    </header>
    <main>
        <div id="bodyFont">
            <form method="post">
                <legend>Filtres:</legend>
                <label for="month">Sélectionnez un mois:</label>
                <select id="month" name="month">
                    <option value="1">Janvier</option>
                    <option value="2">Fevrier</option>
                    <option value="3">Mars</option>
                    <option value="4">Avril</option>
                    <option value="5">Mai</option>
                    <option value="6">Juin</option>
                    <option value="7">Juillet</option>
                    <option value="8">Aout</option>
                    <option value="9">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                </select>
                <label for="year">Sélectionnez une année:</label>
                <select id="year" name="year">
                    <?php
                        $currentYear = Date('Y');
                        echo '<option value="' . $currentYear - 5 . '">' .$currentYear - 5 . '</option>';
                        echo '<option value="' . $currentYear - 4 . '">' .$currentYear - 4 . '</option>';
                        echo '<option value="' . $currentYear - 3 . '">' .$currentYear - 3 . '</option>';
                        echo '<option value="' . $currentYear - 2 . '">' .$currentYear - 2 . '</option>';
                        echo '<option value="' . $currentYear - 1 . '">' .$currentYear - 1 . '</option>';
                        echo '<option value="' . $currentYear . '">' .$currentYear . '</option>';
                        echo '<option value="' . $currentYear + 1 . '">' .$currentYear + 1 . '</option>';
                        echo '<option value="' . $currentYear + 2 . '">' .$currentYear + 2 . '</option>';
                        echo '<option value="' . $currentYear + 3 . '">' .$currentYear + 3 . '</option>';
                        echo '<option value="' . $currentYear + 4 . '">' .$currentYear + 4 . '</option>';
                        echo '<option value="' . $currentYear + 5 . '">' .$currentYear + 5 . '</option>';
                    ?>
                </select>
                <input type="submit" value="Confirmer les dates">
            </form>
            <div id="calendar">
            <?php
                if(isset($_POST['month']) && isset($_POST['year'])){
                    $month = $_POST['month'];
                    setcookie('month', $month, -1);
                    setcookie('month', $month, 86400);

                    $year = $_POST['year'];
                    setcookie('year', $year, -1);
                    setcookie('year', $year, 86400);

                    drawCalendar($year, $month);
                }
                elseif(isset($_GET['month']) && isset($_GET['year'])){
                    $month = $_GET['month'];
                    setcookie('month', $month, -1);
                    setcookie('month', $month, 86400);

                    $year = $_GET['year'];
                    setcookie('year', $year, -1);
                    setcookie('year', $year, 86400);

                    drawCalendar($year, $month);
                }
                elseif(isset($_COOKIE['month']) && isset($_COOKIE['year'])){
                    $month = $_COOKIE['month'];
                    $year = $_COOKIE['year'];
                    drawCalendar($year, $month);
                }
                else{
                    echo "Veuillez selectionner une année et un mois.";
                }

                function drawCalendar($year, $month){
                    if($year >= 2020 && $year <= 2030){
                        /* Affichage du calendrier */
                        $formatFrench = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                        $formatFrench->setPattern('MMMM yyyy');
                        // Calcul des possibilités de switch de mois
                        if($month - 1 == 0){
                            $pMonth = 12;
                            $pYear = $year -1;
                        }
                        else{
                            $iDate = new DateTime($year . '-' . $month - 1);
                            $pMonth = $iDate->format('n'); //Mois précédent
                            $pYear = $iDate->format('Y'); //Année précédente
                        }
                        
                        if($month + 1 == 13){
                            $nMonth = 1;
                            $nYear = $year +1;
                        }
                        else{
                            $iDate = new DateTime($year . '-' . $month + 1);
                            $nMonth = $iDate->format('n'); //Mois suivant
                            $nYear = $iDate->format('Y'); //Année suivante
                        }

                        echo '<div id="arrowBox">';
                            if($pYear >= 2020){
                                echo '<a href="?year='.$pYear.'&month='.$pMonth.'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowL">';
                                echo '<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg></a>';
                            }
                            echo '<h2>Calendrier du mois: ' . $formatFrench->format(new DateTime($year . '-' . $month)) . '</h2>';
                            if($nYear <= 2030){
                                echo '<a href="?year='.$nYear.'&month='.$nMonth.'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowR">';
                                echo '<path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></a>';
                            }
                        echo '</div>';

                        echo "<table>";
                            $tableDays = <<<HTML
                            <tr id="tableDays">
                                <td>Lundi</td>
                                <td>Mardi</td>
                                <td>Mercredi</td>
                                <td>Jeudi</td>
                                <td>Vendredi</td>
                                <td>Samedi</td>
                                <td>Dimanche</td>
                            </tr> 
                            HTML;
                            echo $tableDays;

                            echo "<tr>";
                            for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,$month,$year); $i++){
                                $date = new DateTime($year . '-' . $month . '-' . $i);
                                $sDay = $date->format('l');

                                if($i == 1){
                                    switch ($sDay){
                                        case 'Monday': 
                                            $vDay = 1;
                                            break;
                                        case 'Tuesday': 
                                            $vDay = 2;
                                            break;
                                        case 'Wednesday': 
                                            $vDay = 3;
                                            break;
                                        case 'Thursday': 
                                            $vDay = 4;
                                            break;
                                        case 'Friday': 
                                            $vDay = 5;
                                            break;
                                        case 'Saturday': 
                                            $vDay = 6;
                                            break;
                                        case 'Sunday': 
                                            $vDay = 7;
                                            break;
                                    }
                                    for($v = 1; $v < $vDay; $v++){
                                        echo '<td class="date"> </td>'; 
                                    }
                                }

                                if(isEvent($date->format('Y-m-d')) == true)echo '<td class="date event"><a href="javascript:void(0);" class="eventB" id="' . $date->format('Y-m-d') . '">' . $i . '</a></td>';
                                else if($date->format('Y-m-d') == Date('Y-m-d'))echo '<td class="date dDay">' . $i . '</td>';
                                else{
                                    $date->format('l');
                                    if($date->format('l') == 'Saturday' || $date->format('l') == 'Sunday')echo '<td class="date weekEnd">' . $i . '</td>';
                                    else echo '<td class="date">' . $i . '</td>';
                                }

                                if($sDay == 'Sunday'){ 
                                    echo "</tr>";
                                    echo "<tr>";
                                }
                            }
                        echo "</table>";
                    }
                    else{
                        echo "Veuillez selectionner une année et un mois.";
                    }
                }
                function isEvent($date){
                    if (file_exists('ressources/events.json')) {
                        $jsonData = json_decode(file_get_contents('ressources/events.json'), true); 
                        foreach($jsonData['evenements'] as $event){
                            if($date == $event['date'])return true;
                        }
                    }
                }
            ?>
            </div>
            <dialog id="dialogDetails">
                <button id="dialogClose">Fermer</button>
            </dialog>
        </div>
    </main>
    <footer> 
        <p>© LaManuEcology. Tous droits réservés.</p>
    </footer>
</body>
</html>