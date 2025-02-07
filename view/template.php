<?php 
//-- Affichage du header
function drawHeader(){
    echo <<< 'HTML'
    <header>
        <h1>La Manu Ecology - Planning</h1>
    </header>
    HTML;
}

//-- Affichage du footer
function drawFooter(){
    echo <<< 'HTML'
    <footer> 
        <p>© LaManuEcology. Tous droits réservés.</p>
    </footer>
    HTML;
}

//-- Affichage du modal pour les détais des events & fermeture de la balise <main>
function drawDialog(){
    echo <<< 'HTML'
    <dialog id="dialogDetails">
        <button id="dialogClose">Fermer</button>
    </dialog>
    </div>
    </main>
    HTML;
}

//-- Affichage des messages d'erreurs ou d'info
function errorMsg($msg){
    echo "<p class=\"error_msg\">$msg</p>";
}
?>