<!-- HEADER -->
<!DOCTYPE html>
<html lang="de">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </head>
    <body>
      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between border-bottom border-primary">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Startseite</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=Creationmenu">Spiel erstellen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=Results">Ergebnisse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=Login">Anmelden</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=Registration">Registrieren</a>
            </li>
          </ul>
            <?php if(isset($_SESSION['loggedIn'])) :?>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
              <button class="btn btn-danger navbar-btn" name="logout" type="submit">Logout</button>
            </form>
            <?php endif; ?>
        </div>
      </nav>