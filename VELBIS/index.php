<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Y6yymIvR6vZYq1cIwJphfXnYrr3IMBkEOm5mzVa8SeFez3B" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(function() {
            $("#myTable").DataTable();
        });
    </script>
</head>
<body>
    <nav>
        <h2 class="mt-2" style="color: white;">ADD CONTACTS!</h2>
    </nav>
    <div class="container mx-auto">
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-5">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" pattern="[A-Za-z ]+" title="Please enter a valid first name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" pattern="[A-Za-z ]+" title="Please enter a valid last name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sex</label><br>
                <input type="radio" id="male" name="sex" value="Male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="sex" value="Female">
                <label for="female">Female</label>
                <input type="radio" id="other" name="sex" value="Other">
                <label for="other">Other</label>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-5">
                <div id="round" name="imgholder"></div>
                <br>
                <label for="picture" class="form-label ">Upload Image</label>
                <input type="file" class="form-control" name="picture" accept="image/jpeg, image/jpg, image/png" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-dark btn-lg" name="add">Add Contact</button>
            </div>
            <br>
        </form>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Sex</th>
                    <th>Mobile Number</th>
                    <th>Email Address</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $stmt = "SELECT * FROM contacts";
                $container = $connection->query($stmt);
                while ($data = $container->fetch_assoc()) {


                ?>
                    <tr>
                        <td><?php echo $data['ID'] ?></td>
                        <td><?php echo $data['fname'] ?></td>
                        <td><?php echo $data['lname'] ?></td>
                        <td><?php echo $data['address'] ?></td>
                        <td><?php echo $data['sex'] ?></td>
                        <td><?php echo $data['number'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td>
                            <img src="../VELBIS/images/<?php echo $data['image']; ?>" height="100px" alt="Picture">
                        </td>

                        <td>
                            <?php
                            echo '<a href="update.php?id=' . $data['ID'] . '"> <button class="btn btn-primary " id="edit">Update</button></a>';
                            echo '<a href="delete.php?id=' . $data['ID'] . '"><button class="btn btn-danger " id="delete">Delete</button></a>';

                            ?>
                        </td>
                    </tr>
                <?php
                }

                $container->free_result();
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>