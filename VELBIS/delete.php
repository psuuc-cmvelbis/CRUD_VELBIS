<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Y6yymIvR6vZYq1cIwJphfXnYrr3IMBkEOm5mzVa8SeFez3B" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = "DELETE FROM contacts where id='$id'";
        $result = $connection->query($stmt) or die("Could not perfrom $stmt");
        if ($result) {
            echo "<script>Swal.fire(
            'SUCCESSFULLY',
            'DELETED',
            'success'
          )</script>";
            header("Refresh:2;url=index.php");
        } else {
            echo "<script>Swal.fire(
            'ERROR!',
            'CAN'T $stmt!',
            'error'
          )</script>";
            header("Refresh:2;url=index.php");
        }
    } else {

        header("Refresh:2;url=error.php");
        exit;
    }

    ?>
</body>

</html>