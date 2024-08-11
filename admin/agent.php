<?php
//require_once '../database.php';
include "../validation/validation.php";
require_once '../sqldata/user.php';

$db1 = new User();
$conn=$db1->connect();
$sql_table2 = "SELECT * FROM contact";
$result_table2 = $conn->query($sql_table2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="../index.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
</head>
<body>
     <nav>
    <div class="navbar">
      <div class="logo"><a href="#">Feedback submitter</a></div>
      <ul class="menu">
        <li><a href="user.php">User</a></li>
        <li><a href="agent.php">Agent</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li>  
        <form class="logout" action="../logout.php" method="GET">
               <input class="f2" type="submit" value="Logout">
         </form>
        </li>
      </ul>
    </div>
  </nav>
  <section>
<div class="admin">
         <div class="title1">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <h1 class="th1">Agent Profiles</h1>

        <tr class="th2">
            <th>Id</th>
            <th>name</th>
            <th>email</th>
            <th>message</th>
        </tr>
        <?php
        if ($result_table2->num_rows > 0) {
          $i=1;
            while ($row = $result_table2->fetch_assoc()) {
                echo "<tr class='th3'>";
                echo "<td>" .$i. "</td>";
                echo "<td>" . $row["con_username"] . "</td>";
                echo "<td>" . $row["con_email"] . "</td>";
                echo "<td>" . $row["con_message"] . "</td>";
                echo "</tr>";
                $i++;
            }
          
        } else {
            echo "<tr><td colspan='2'>No data available</td></tr>";
        }
        ?>
    </table>
         </div>
 </section> 
</body>
</html>