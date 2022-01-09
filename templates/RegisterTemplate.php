<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <div class="form-group">
        <label for="firstname">Vorname</label>
        <input class="form-control" type="text" name="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Nachname</label>
        <input class="form-control" type="text" name="lastname">
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
        <label for="rePassword">Passwort wiederholen</label>
        <input class="form-control" type="password" name="rePassword">
    </div>
    <div class="form-group">
        <label for="email">E-Mail</label>
        <input class="form-control" type="email" name="email">
    </div>
    <br>
    <button class="btn btn-primary" type="submit" name="submit" value="Submit">Registrieren</button>
</form>