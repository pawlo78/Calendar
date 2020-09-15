
<table class="GeneratedTable center">
  <thead>
    <tr>     
      <th></th>      
      <th><?php echo "<a href='index.php?year=".($params['year']-1)."&mon=".$params['mon']."'> <<< </a></th>"; ?>
      <th><?php echo $params['year']; ?></th>
      <th><?php echo "<a href='index.php?year=".($params['year']+1)."&mon=".$params['mon']."'> >>> </a></th>"; ?></th>      
      <th></th>
    </trclass=>
  </theadclass=>  
</table>

<table class="GeneratedTable center">
  <thead>
    <tr>     
      <th></th>     
      <th><?php echo "<a href='index.php?year=".$params['year']."&mon=".($params['mon']-1)."'> <<< </a></th>"; ?></th>
      <th><?php echo $params['monTxt']; ?></th>
      <th><?php echo "<a href='index.php?year=".$params['year']."&mon=".($params['mon']+1)."'> >>> </a></th>"; ?></th>      
      <th></th>
    </trclass=>
  </theadclass=>  
</table>


<table class="GeneratedTable center">
  <thead>
    <tr>
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
      <th>Sun</th>
    </trclass=>
  </theadclass=>
  <tbody>
      <?php 
        //test
        $x=0; $y=7;
        for ($i=0; $i < 6; $i++) {           
          echo "<tr>";       
          for ($j=$x; $j < $y; $j++) {
            if(isset($tableDays[$j]))
            {
              if($tableDays[$j] == 0) {
                echo "<td></td>";
              } else {

                 ?>
                <form method='post' action='index.php' style='margin:0; padding:0;'>              
                <input type="hidden" name="monPost" value="<?=$params['mon']; ?>">
                <input type='hidden' name='yearPost' value="<?=$params['year']; ?>">
                <?php                             
                echo "<td>";
                echo "<input class='button-calendary' type='submit' name='dayPost' value=" . $tableDays[$j] . ">";
                echo "</td>"; 
                echo "</form>";               
              }             
            }
            
          }      
          echo "</tr>"; 
          $x=$y;
          $y=$y+7;
        }
      ?>   
  </tbody>
</table>
</div>