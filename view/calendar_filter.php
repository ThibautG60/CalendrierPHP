<form method="get">
    <legend>Filtres:</legend>
    <!-- Selection du mois -->
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
    //- Selection de l'année
    $currentYear = Date('Y');

    for($i=-5; $i <= 5; $i++){
        echo '<option value="' . $currentYear + $i . '">' .$currentYear + $i . '</option>';
    }
    ?>
    </select>
    <input type="submit" value="Confirmer les dates">
</form>