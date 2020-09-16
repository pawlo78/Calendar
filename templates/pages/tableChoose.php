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
      <th><?php echo "<a href='index.php?year=".$params['yearSub']."&mon=".$params['monSub']."'> <<< </a></th>"; ?></th>
      <th><?php echo $params['monTxt']; ?></th>
      <th><?php echo "<a href='index.php?year=".$params['yearAdd']."&mon=".$params['monAdd']."'> >>> </a></th>"; ?></th>      
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
        //start value - setting the days of the week
        $x=0; $y=7;
        //maximum number of lines of weeks
        for ($i=0; $i < 6; $i++) {           
          echo "<tr>";
          //consecutive days of the week from the table       
          for ($j=$x; $j < $y; $j++) {
            if(isset($tableDays[$j]))
            {
              //empty spaces
              if($tableDays[$j] == 0) {
                echo "<td></td>";
              } else {
                  //generating buttons
                 ?>
                <form method='post' action='index.php' style='margin:0; padding:0;'>              
                <input type="hidden" name="monPost" value="<?=$params['mon']; ?>">
                <input type='hidden' name='yearPost' value="<?=$params['year']; ?>">
                <?php                             
                echo "<td>";
                echo "<input class='";
                //class setting - mark the current day
                if($params['flagRingDay'] === true && $tableDays[$j] === $params['mday']) {
                  echo "btn btn-primary btn-circle btn-sm";
                } else {
                  echo "button-calendary";                  
                }
                echo "' type='submit' name='dayPost' value=" . $tableDays[$j] . ">";
                echo "</td>"; 
                echo "</form>";               
              }             
            }            
          }      
          echo "</tr>";
          //new week 
          $x=$y;
          $y=$y+7;
        }
      ?>   
  </tbody>
</table>
</div>