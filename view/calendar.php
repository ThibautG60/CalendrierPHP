<?php 
//-- Pages requises
require_once './controller/calendarController.php';//Le controlleur
require_once 'template.php';//Pour la fonction ErrorMsg

//- Affichage du filtre et ouverte balise <main>
function drawCalendarFilter(){
    echo <<< 'HTML'

        HTML;
}

//- Affichage du calendrier
function drawCalendar($year, $month){
    if($year >= ($year - 5) && $year <= ($year + 5)){
        echo '<div id="calendar">';
        //-- Calcul des possibilités de switch de mois et l'affichage des flèches
        $pMonth = previousMonth($year, $month);
        $nMonth = nextMonth($year, $month);
        echo '<div id="arrowBox">';
            if($pMonth[0] >= ($year - 5)){
                echo '<a href="?year='.$pMonth[0].'&month='.$pMonth[1].'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowL">';
                echo '<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg></a>';
            }
            echo '<h2>Calendrier du mois: ' . ymFrench($year, $month) . '</h2>';
            if($nMonth[0] <= ($year + 5)){
                echo '<a href="?year='.$nMonth[0].'&month='.$nMonth[1].'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowR">';
                echo '<path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></a>';
            }
        echo '</div>';

        //-- En-tête du calendrier
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
            
            //-- Corp du calendrier
            echo "<tr>";
            for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,$month,$year); $i++){
                $date = new DateTime($year . '-' . $month . '-' . $i);
                $sDay = $date->format('l');
                //- Affichage des cases vides
                if($i == 1){
                    for($v = 1; $v < emptyCase($sDay); $v++){
                        echo '<td class="date"> </td>'; 
                    }
                }
                //- Affichage des events
                if(isEvent($date->format('Y-m-d')) == true)echo '<td class="date event"><a href="javascript:void(0);" class="eventB" id="' . $date->format('Y-m-d') . '">' . $i . '</a></td>';
                //- Affichage du jour J
                else if($date->format('Y-m-d') == Date('Y-m-d'))echo '<td class="date dDay">' . $i . '</td>';
                //- Affichage des jours normaux & Week-end
                else{
                    $date->format('l');
                    if($date->format('l') == 'Saturday' || $date->format('l') == 'Sunday')echo '<td class="date weekEnd">' . $i . '</td>';//Week-end
                    else echo '<td class="date">' . $i . '</td>';//Jours normaux
                }
                //- Au dimanche on revient à la ligne car c'est une nouvelle semaine
                if($sDay == 'Sunday'){ 
                    echo "</tr>";
                    echo "<tr>";
                }
            }
        echo "</table>";
        echo '</div>';
    }
    else{
        errorMsg("Veuillez sélectionner une date comprise entre les 5 dernières ou les 5 prochaines années.");
    }
}
?>