<?php
require_once './database.php';
include "./validation/validation.php";
$db1=new Database();
$conn=$db1->connect();
$sql_table1 = "SELECT * FROM users";
$sql_table2 = "SELECT * FROM contact";
$sql_table3 = "SELECT * FROM feedbacks";

$result_table1 = $conn->query($sql_table1);
$result_table2 = $conn->query($sql_table2);
$result_table3 = $conn->query($sql_table3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="index.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <nav>
    <div class="navbar">
      <div class="logo"><a href="#">Feedaback submitter</a></div>
      <ul class="menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="contact.php">Contact</a></li>
        <!-- <li><a href="admin.php">Admin</a></li> -->
        <li>  
        <form class="logout" action="./logout.php" method="GET">
               <input class="f2" type="submit" value="Logout">
         </form>
        </li>

      </ul>
    </div>
  </nav>
  <section>
<div class="admin">
         <div class="title1">
                <h1 class="th1">User Profiles</h1>
        <table id="example" class="table table-striped table-bordered" class="th" style="width:100%">
        <?php
        $validation=new Validation();
        if(isset($_GET['error'])){ ?>
          <p class="err1"> <?=$validation->clean($_GET['error'])?></p>
          <?php  } ?>
          <?php 
        if(isset($_GET['success'])){ ?>
          <p class="err2"> <?=$validation->clean($_GET['success'])?></p>
          <?php  } ?>
        <tr class="th2"> 
            <th>Id</th>
            <th>name</th>
            <th>email</th>
            <th>phone number</th>
            <th>gender</th>
            <th>delete</th>


            <!-- Add more column headings if needed -->
        </tr>
        <?php
        // Print data from Table 1
        if ($result_table1->num_rows > 0) {
            while ($row = $result_table1->fetch_assoc()) {
                echo "<tr class='th3'>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["user_name"] . "</td>";
                echo "<td>" . $row["user_email"] . "</td>";
                echo "<td>" . $row["user_phonenumber"] . "</td>";
                echo "<td>" . $row["user_gender"] . "</td>";
                echo "<td class='del'><a href='./action/delete.php?table=users&id=".$row["user_id"]."'> Delete</a></td>";
                                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data available</td></tr>";
        }
        ?>
    </table>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <h1 class="th1">Agent Profiles</h1>

        <tr class="th2">
            <th>Id</th>
            <th>name</th>
            <th>message</th>

            <!-- Add more column headings if needed -->
        </tr>
        <?php
        // Print data from Table 1
        if ($result_table2->num_rows > 0) {
            while ($row = $result_table2->fetch_assoc()) {
                echo "<tr class='th3'>";
                echo "<td>" .$row["con_userid"]. "</td>";
                echo "<td>" . $row["con_username"] . "</td>";
                echo "<td>" . $row["con_message"] . "</td>";
                // Add more columns if needed
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data available</td></tr>";
        }
        ?>
    </table>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
    <h1 class="th1">Feedback Details</h1>

        <tr class="th2">
            <th>Id</th>
            <th>Name</th>
            <th>Delivery Number</th>
            <th>Rating</th>
            <th>Comments</th>
            <!-- Add more column headings if needed -->
        </tr>
        <?php
        // Print data from Table 1
        if ($result_table3->num_rows > 0) {
            while ($row = $result_table3->fetch_assoc()) {
                echo "<tr class='th3'>";
                echo "<td>" . $row["feedback_id"] . "</td>";
                echo "<td>" . $row["feeback_username"] . "</td>";
                echo "<td>" . $row["feedback_deliverynum"] . "</td>";
                echo "<td>" . $row["feedback_rating"] . "</td>";
                echo "<td>" . $row["feedback_comments"] . "</td>";

                // Add more columns if needed
                echo "</tr>";
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