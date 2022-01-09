<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    Vorname: <input type="text" name="firstname"><br>
    Nachname: <input type="text" name="lastname"><br>
    Passwort: <input type="password" name="password"><br>
    Passwort widerholen: <input type="password" name="rePassword"><br>
    E-mail: <input type="email" name="email"><br>
    <input type="submit" name="submit" value="Submit">
</form>