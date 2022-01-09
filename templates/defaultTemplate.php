<?php require "Header.php"; ?>
<?php if(isset($info)){echo $info;} ?>
<div class="container">
    <h2><?php echo $title; ?></h2>
    <?php echo $content; ?>
</div>
<?php require "Footer.php"; ?>;