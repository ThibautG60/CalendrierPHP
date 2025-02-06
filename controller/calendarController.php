<?php
require_once './model/data.php';

function isEvent($date){
    if (isset($jsonData)) {
        foreach($jsonData['evenements'] as $event){
            if($date == $event['date'])return true;
        }
    }
}

function isFilterSet() {
    if(isset($_GET['month']) && isset($_GET['year'])){
        $month = $_GET['month'];
        setcookie('month', $month, -1);
        setcookie('month', $month, 86400);
    
        $year = $_GET['year'];
        setcookie('year', $year, -1);
        setcookie('year', $year, 86400);
    
        drawCalendar($year, $month);
        return true;
    }
    elseif(isset($_COOKIE['month']) && isset($_COOKIE['year'])){
        $month = $_COOKIE['month'];
        $year = $_COOKIE['year'];
        drawCalendar($year, $month);
        return true;
    }
}

function previousMonth($year, $month){
    if($month - 1 == 0){
        $pMonth = 12;
        $pYear = $year -1;
    }
    else{
        $iDate = new DateTime($year . '-' . $month - 1);
        $pMonth = $iDate->format('n'); //Mois précédent
        $pYear = $iDate->format('Y'); //Année précédente
    }
    return array($pYear, $pMonth);
}

function nextMonth($year,$month){
    if($month + 1 == 13){
        $nMonth = 1;
        $nYear = $year +1;
    }
    else{
        $iDate = new DateTime($year . '-' . $month + 1);
        $nMonth = $iDate->format('n'); //Mois suivant
        $nYear = $iDate->format('Y'); //Année suivante
    }
    return array($nYear, $nMonth);
}

function emptyCase($sDay){
    switch ($sDay){
        case 'Monday': 
            return $vDay = 1;
        case 'Tuesday': 
            return $vDay = 2;
        case 'Wednesday': 
            return $vDay = 3;
        case 'Thursday': 
            return $vDay = 4;
        case 'Friday': 
            return $vDay = 5;
        case 'Saturday': 
            return $vDay = 6;
        case 'Sunday': 
            return $vDay = 7;
    }
}
?>