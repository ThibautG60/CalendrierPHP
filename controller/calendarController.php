<?php
//- On appel toutes les pages à qui le controller va donenr les instructions
require_once 'init_template.php';
require_once './model/data.php';
require_once './view/template.php';
require_once './view/calendar.php';

//- Appel des fonctions stockées dans les fichiers view
include_once './view/calendar_filter.php';//On affiche le filtre du Calendrier
if(isFilterSet()!= true){ //Si il n'y a pas de filtre sélectionné cela va afficher le message suivant, sinon la fonction chargera le calendrier
    errorMsg("Veuillez sélectionner une date comprise entre les 5 dernières ou les 5 prochaines années.");
}

//- Fonction pour vérifier si l'utilisateur à sélectionner un mois et une année (maintenant ou dans le passé grâce aux cookies)
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

//- Fonction pour calculer le moi précédent d'une date 'd'
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

//- Fonction pour calculer le moi suivant d'une date 'd'
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

//- Fonction qui détermine le nombre de cases vide qu'il faudra mettre au début du calendrier. Si le premier jour du mois est un mardi, il y aura 1 case vide
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

//- Fonction qui retourne le nom d'une date 'd' en Français
function ymFrench($year, $month){
    $formatFrench = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $formatFrench->setPattern('MMMM yyyy');
    return $formatFrench->format(new DateTime($year . '-' . $month));
}
?>