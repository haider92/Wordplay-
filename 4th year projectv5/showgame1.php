<?php require('header/header.php'); ?>
<body>
<!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">
            
            <li><a href="index.php"><span class="glyphicon glyphicon-menu-hamburger"></span>Home</a></li>
            <li><a href="games_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Interactive Games </a></li>
               <li><a href="rewards.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Rewards </a></li>
              <li><a href="whiteboard.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Whiteboard </a></li>
              <li><a href="lessons_menu.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Lessons</a></li>
               <li ><a href="about.php"><span class="glyphicon glyphicon-menu-hamburger"></span> About</a></li>
            
        

            <!-- Dropdown-->
            <li class="active" class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                       <span class="glyphicon glyphicon-menu-down"></span> Admin <span class="caret"></span>
                </a>  
<?php require('header/dropdown1.php'); ?>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        <div id="header">

           <h1> WordPlay!</h1>
        </div>

<style>
.error {color: #FF0000;}
</style>

<?php require('php/connection.php'); ?>
<?php

$query = "SELECT *  FROM game1";
$result = mysqli_query($link, $query); //or trigger_error("Query Failed! SQL: $query - Error: ". mysqli_error($link));

if($result) {
    echo "<h3> SPOT THE PICTURE TABLE </h3>";
       echo "<table  border='10px solid black' style='width:100%'>";
          echo "<tr> <th> gameID1 </th>   <th> question </th><th> answer1 </th> <th> answer2 </th> <th> answer3 </th> <th> answer4 </th> <th> correct </th> <th> images </th></tr>";
    //  echo "<tr>";
	while($row = mysqli_fetch_assoc($result)) {
      
         echo "<tr>";
         
         	
		echo "<td> " . $row["game1ID"] . " </td> " . " <td> " . $row["question"]. "  </td> " ."  <td> "  . $row["answer1"]." </td> ". "  <td>  ". $row["answer2"]." </td> ".
        " <td>  ". $row["answer3"]. " </td> ".  "  </td>  " ."<td>" .$row["answer4"]." </td> " ."  <td> " .$row["correct"]."</td>" ."<td> ".$row["images"]."</td>";
        echo "</tr>";
	}
     echo "</tr>";
      echo "</table>";
} 

mysqli_close($link);

?>

        </div>
    </div>
</div>

   

</body>

</html>
