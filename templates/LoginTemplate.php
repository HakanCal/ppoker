<!-- LOG IN -->
<!--https://getbootstrap.com/docs/4.0/components/forms/-->
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"> 
<div class="form-group">
    <label for="email1">Email</label>
    <input class="form-control" type="email" name="email" aria-describedby="emailHelp" placeholder="Email eingeben"><br>
</div>
<div class="form-group">
    <label for="password">Passwort</label>
    <input class="form-control" type="password" name="password" placeholder="Passwort eingeben">
</div>
    <br>
    <button class="btn btn-primary" type="submit" name="submit" value="Submit">Anmelden </button>
</form>