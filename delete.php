<?php
    include("./config/dbconnect.php");

    if (isset($_POST['deleteBtn'])) {
        if (!empty($_POST['delete-chk'])) {
            $ids = implode(',', $_POST['delete-chk']);
            $sql = "DELETE FROM products WHERE id IN ($ids)";

            if (mysqli_query($conn, $sql)) {
                echo "Selected products have been deleted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "No products were selected to delete.";
        }
        mysqli_close($conn);
        header('Location: product.php');
        exit;
    } else {
        header('Location: product.php');
        exit;
    }
?>