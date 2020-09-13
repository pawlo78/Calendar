<table class="GeneratedTable center">
  <thead>
    <tr>     
      <th></th>
      <th>Header</th>
      <th>Header</th>
      <th>Header</th>      
      <th></th>
    </trclass=>
  </theadclass=>  
</table>

<table class="GeneratedTable center">
  <thead>
    <tr>     
      <th></th>
      <th>Header</th>
      <th>Header</th>
      <th>Header</th>      
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
        $x=1; $y=8;
        for ($i=0; $i < 7; $i++) {           
          echo "<tr>";       
          for ($j=$x; $j < $y; $j++) {
            echo "<td>$j</td>";
          }      
          echo "</tr>"; 
          $x=$y;
          $y=$y+7;
        }
      ?>   
  </tbody>
</table>
</div>