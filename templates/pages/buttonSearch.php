<table class="GeneratedTable center">
  <thead>
    <tr>     
      <th><h1>
      
      <?php
      strlen($params['mon']) == 1 ? $monView = "0".$params['mon'] : $monView = $params['mon'];    
      strlen($params['day']) == 1 ? $dayView = "0".$params['day'] : $dayView = $params['day'];    
      echo $params['year']. "-" .$monView. "-" .$dayView; 
      ?>
      
      </h1></th>     
    </trclass=>
  </theadclass=>  
</table>

<div class="col text-center">



<form action="index.php" method="get"> 
<input type="hidden" name="year" value="<?=$params['year']; ?>">
    <input type="hidden" name="mon" value="<?=$params['mon']; ?>">
  <button type="submit" class="btn btn-primary btn-lg"><h1>Get date</h1></button>
</form> 
</div>