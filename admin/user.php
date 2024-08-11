<?php
// require_once '../database.php';
include "../validation/validation.php";
require_once '../sqldata/user.php';

$db1 = new User();
$conn = $db1->connect();
$sql_table1 = "SELECT * FROM users";
$result_table1 = $conn->query($sql_table1);
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
            <div class="logo"><a href="#">Feedback Submitter</a></div>
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
                <h1 class="th1">User Profiles</h1>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <?php if (isset($_GET['error'])) { 
                          $validation=new Validation();
                        ?>
                        <p class="err1"><?= $validation->clean($_GET['error']) ?></p>
                    <?php } ?>
                    <?php 
                          $validation=new Validation();
                    if (isset($_GET['success'])) { ?>
                        <p class="err2"><?= $validation->clean($_GET['success']) ?></p>
                    <?php } ?>
                    <tr class="th2">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    if ($result_table1->num_rows > 0) {
                        $i=1;
                        while ($row = $result_table1->fetch_assoc()) {
                            echo "<tr class='th3'>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row["user_name"] . "</td>";
                            echo "<td>" . $row["user_email"] . "</td>";
                            echo "<td>" . $row["user_phonenumber"] . "</td>";
                            echo "<td>" . $row["user_gender"] . "</td>";
                            echo "<td>" . $row["admin"] . "</td>";

                            echo "<td class='del'>
                                  <a href='../action/delete.php?table=users&id=" . $row["user_id"] . "'>Delete</a>                                  </td>";
                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No data available</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
