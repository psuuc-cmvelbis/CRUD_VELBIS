<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>
<body>
    <?php
    function sanitize($inputValues)
    {
        foreach ($inputValues as &$dataa) {
            $dataa = trim($dataa);
            $dataa = htmlspecialchars($dataa, ENT_QUOTES, 'UTF-8');
            $dataa = stripslashes($dataa);
        }
        return $inputValues;
    }
    if (isset($_POST['add'])) {

        $inputValues = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'mobile' => $_POST['mobile'],
            'email' => $_POST['email']
        );
        $Imagename = $_FILES['picture']['name'];
        $Imagetype = $_FILES['picture']['type'];
        $Imagesize = $_FILES['picture']['size'];
        $tmp_name = $_FILES['picture']['tmp_name'];

        $sanitizedData = sanitize($inputValues);

        $fname = $sanitizedData['fname'];
        $lname = $sanitizedData['lname'];
        $address = $sanitizedData['address'];
        $sex = $_POST['sex'];
        $varsex = "";
        if ($sex == "Male") {
            $varsex = "Male";
        } else if ($sex == "Female") {
            $varsex = "Female";
        } else if ($sex == "Other") {
            $varsex = "Other";
        }
        $mobile = $sanitizedData['mobile'];
        $email = $sanitizedData['email'];

        if (move_uploaded_file($tmp_name, "../VELBIS/images/" . $Imagename)) {
        } else {
            echo "error";
        }
        $stmt = "INSERT INTO contacts (fname, lname, address, sex,number, email,image)
            VALUES ('$fname', '$lname', '$address', '$varsex','$mobile','$email','$Imagename')";
        $container = $connection->query($stmt) or die("Could not perform $stmt");
        echo "<script>Swal.fire(
                'NICE!',
                'RECORDED!',
                'success'
              )</script>";
        header("Refresh:2;url=index.php");
    } else {
        header("Refresh:2;url=index.php");
    }
    ?>


</body>

</html>