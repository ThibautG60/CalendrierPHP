<?php 
include_once './controller/calendarController.php';

function drawCalendarFilter(){
    echo <<< 'HTML'
    <form method="get">
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
    HTML;

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
    
        echo <<< 'HTML'
        </select>
        <input type="submit" value="Confirmer les dates">
    </form>
    HTML;
}

function drawCalendar($year, $month){
    if($year >= 2020 && $year <= 2030){
        /* Affichage du calendrier */
        $formatFrench = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        $formatFrench->setPattern('MMMM yyyy');
        // Calcul des possibilités de switch de mois
        $pMonth = previousMonth($year, $month);
        $nMonth = nextMonth($year, $month);

        echo '<div id="arrowBox">';
            if($pMonth[0] >= 2020){
                echo '<a href="?year='.$pMonth[0].'&month='.$pMonth[1].'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowL">';
                echo '<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg></a>';
            }
            echo '<h2>Calendrier du mois: ' . $formatFrench->format(new DateTime($year . '-' . $month)) . '</h2>';
            if($nMonth[0] <= 2030){
                echo '<a href="?year='.$nMonth[0].'&month='.$nMonth[1].'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="arrowR">';
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
                    for($v = 1; $v < emptyCase($sDay); $v++){
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
        echo 'Veuillez sélectionner une date comprise entre les 5 dernières ou les 5 prochaines années.';
    }
}
?>