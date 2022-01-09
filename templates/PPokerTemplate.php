<!-- 
NOT OUR CODE
SOURCE:
https://codepen.io/adamstuartclark/pen/pbYVYR
-->
<link rel="stylesheet" href="css/style.css">
<form action="index.php?page=PPoker&room=<?php echo $roomID;?>" method="post">
<h2><?php echo $ppoker_title; ?></h2>
<h4><?php echo $ppoker_description ?></h4>
<h3>Bitte wähle eine Karte aus</h3>
<section>
<div>
  <input type="radio" id="control_01" name="ppoker_select" value="1">
  <label for="control_01">
    <h2>1</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_02" name="ppoker_select" value="2">
  <label for="control_02">
    <h2>2</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_03" name="ppoker_select" value="3">
  <label for="control_03">
    <h2>3</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_04" name="ppoker_select" value="5">
  <label for="control_04">
    <h2>5</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_05" name="ppoker_select" value="8">
  <label for="control_05">
    <h2>8</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_06" name="ppoker_select" value="13">
  <label for="control_06">
    <h2>13</h2>
  </label>
</div>
<div>
  <input type="radio" id="control_07" name="ppoker_select" value="20">
  <label for="control_07">
    <h2>20</h2>
  </label>
</div>
</section>
<button class="btn btn-primary" type="submit" name="submit" value="Submit">Auswählen</button>
</form>
<br>
<div class="row"><?php echo $ppoker_evaluate_btn ?></div>