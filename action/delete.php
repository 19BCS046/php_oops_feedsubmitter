<?php
include "../validation/Errors.php";
include "../validation/validation.php";
require_once '../database.php';

$validation=new Validation();
$error=new Errors();
if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $validation->clean($_GET['table']);
    $id = $validation->clean($_GET['id']);

    if (empty($table) || empty($id)) {
        $err = "Invalid table name or ID.";
        $error->redirect("../admin/user.php", "error", $err);
        exit;
    }
    $db = new Database();
    $conn = $db->connect();
    $sql = "DELETE FROM `$table` WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            $sm = "Deleted Successfully";
            $error->redirect("../admin/user.php", "success", $sm);
        } else {
            $err = "Failed to execute query.";
            $error->redirect("../admin/user.php", "error", $err);
        }
    } else {
        $err = "Failed to prepare SQL statement.";
        $error->redirect("../admin/user.php", "error", $err);
    }
} else {
    $err = "Missing table or ID parameter.";
    $error->redirect("../admin/user.php", "error", $err);
}
?>
