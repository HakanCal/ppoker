<!-- DEFAULT JUMBO PAGE-->
<?php require "Header.php"; ?>
  <div class="container py-4">
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><?php echo $title1; ?></h1>
        <p class="col-md-8 fs-4"><?php echo $content1; ?></p>
      </div>
    </div>
    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
          <h2><?php echo $title2; ?></h2>
          <p><?php echo $content2; ?></p>
          <a class="btn btn-outline-light" href="index.php?page=Results">Ansehen</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2><?php echo $title3; ?></h2>
          <p><?php echo $content3; ?></p>
          <a class="btn btn-outline-secondary" href="index.php?page=Creationmenu">Erstellen</a>
        </div>
      </div>
    </div>    
  </div>
  <?php require "Footer.php"; ?>