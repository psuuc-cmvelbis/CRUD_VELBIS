<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php
    require 'config.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $stmt = "SELECT * FROM contacts WHERE ID=$id";
    $container = $connection->query($stmt);
    while ($data = $container->fetch_assoc()) {



    ?>
        <nav>
            <h2 class="mt-2" style="color: white;">EDIT CONTACT</h2>
        </nav>
        <div class="container mt-3">

            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="text-center mt-2">
                    StudentID <input type="text" name="id" value="<?php echo $id ?>" readonly="true">

                </div>
                <div class="mb-3">
                    <div id="round" name="imgholder" class="mb-5"></div>
                    <label for="picture" class="form-label">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg, image/jpg, image/png" required>
                </div>
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $data['fname']; ?>" pattern="[A-Za-z]+" title="Please enter a valid first name (letters only)" required>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $data['lname']; ?>" pattern="[A-Za-z]+" title="Please enter a valid last name (letters only)" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sex</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="male" name="sex" value="Male" <?php if ($data['sex'] == 'Male') echo 'checked'; ?> required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="female" name="sex" value="Female" <?php if ($data['sex'] == 'Female') echo 'checked'; ?>>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="other" name="sex" value="Other" <?php if ($data['sex'] == 'Other') echo 'checked'; ?>>
                        <label class="form-check-label" for="other">Other</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo $data['number']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="update">Update Contact</button>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
    <?php
    function sanitize($inputData)
    {
        foreach ($inputData as &$value) {
            $value = trim($value);
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $value = stripslashes($value);
        }
        return $inputData;
    }
    if (isset($_POST['update'])) {

        $inputData = array(
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
        $sanitizedData = sanitize($inputData);

        $id = $_POST['id'];
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
            $stmt = "UPDATE contacts SET image='$Imagename' WHERE ID=$id";
            $container = $connection->query($stmt) or die("Could not perform $stmt");
        } else {
            echo "error";
        }

        $stmt = "UPDATE contacts SET fname='$fname', lname='$lname', address='$address', sex='$varsex', number='$mobile', email='$email' WHERE id=$id";
        $container = $connection->query($stmt) or die("Could not perform $stmt");
        echo "<script>Swal.fire(
                        'Good job!',
                        'RECORDED!',
                        'success'
                      )</script>";
        header("Refresh:2;url=index.php");
    }

    ?>
    
</body>

</html>