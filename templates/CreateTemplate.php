<!-- PPOKER CREATION MENU-->
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="mb-3">
            <!--Name -->
            <label for="roomName">Titel</label>
            <input class="form-control" name="roomName" type="text" placeholder="Bitte Titel eingeben" required>
        </div>
        <div class="mb-3">
            <!--Nachname-->		
            <label for="description">Beschreibung</label>
            <textarea class="form-control" name="roomDescription" type="text" placeholder="Bitte Beschreibung eingeben"></textarea>
        </div>
        <div class="wrapper mb-3">

        </div>
        <div class="row mb-3">
            <button class="btn btn-info add-btn">Spieler per Mail einladen</button>
        </div>
        <div class="row form-group">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Erstellen"> 
        </div>
</form>
<script src="js/script.js"></script>