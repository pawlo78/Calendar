<div class="col text-center margin-top">
  <h2>
    <?php
    strlen($params['mon']) == 1 ? $monView = "0".$params['mon'] : $monView = $params['mon'];    
    strlen($params['day']) == 1 ? $dayView = "0".$params['day'] : $dayView = $params['day'];
    echo $params['year']."-".$monView."-".$dayView;
    ?>
  </h2>
</div>

<div class="col text-center">
<form action="index.php" method="get"> 
<input type="hidden" name="year" value="<?=$params['year']; ?>">
    <input type="hidden" name="mon" value="<?=$params['mon']; ?>">
  <button type="submit" class="btn btn-primary btn-lg"><h1>Get date</h1></button>
</form> 
</div>

<div class="col text-center margin-top">
<a href="https://github.com/pawlo78/Calendar" class="btn btn-primary active center" target="_blank" role="button" aria-pressed="true">Go to github</a>
</div>