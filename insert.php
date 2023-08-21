<?php
require("api/dbconfig.php");

if (isset($_POST["submit"])) {

    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "uploads/" . $filename;

    move_uploaded_file($tempname, $folder);

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $dob = $_POST["dob"];
    $city = $_POST["city"];
    $pincode = $_POST["pincode"];
    $gender = $_POST["gender"];

    $query = "INSERT INTO users (`image`, `first_name`, `last_name`, `username`, `email`, `password`, `date_of_birth`, `city`, `pin_code`, `gender`) VALUES ('$folder', '$fname', '$lname', '$username', '$email', '$pass', '$dob', '$city', '$pincode', '$gender')";

    // Perform the query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data inserted successfully')</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/insert.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <?php include("header.php"); ?>
    <div id="wrapper">
        <div class="container">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <!-- <h2>Registration</h2> -->
                <div class="content">
                    <div class="input-box">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="Enter first name" required>
                    </div>
                    <div class="input-box">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Enter last name" required>
                    </div>
                    <div class="input-box">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="input-box">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" placeholder="Enter password" required>
                    </div>
                    <div class="input-box">
                        <label for="cpass">Confirm Password</label>
                        <input type="text" name="cpass" placeholder="Enter confirm password" required>
                    </div>
                    <div class="input-box">
                        <label for="dob">DOB</label>
                        <input type="date" name="dob" required>
                    </div>
                    <div class="input-box">
                        <label for="file">Image</label>
                        <input type="file" name="photo"required>
                    </div>
                    <div class="input-box">
                        <label for="city">City</label>
                        <select id="city" name="city" required>
                            <option value="Daman">Daman</option>
                            <option value="Vapi">Vapi</option>
                            <option value="Bhilad">Bhilad</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="pincode">Pin Code</label>
                        <input type="text" name="pincode" placeholder="Enter pincode" required>
                    </div>
                    <span class="gender-title">Gender</span>
                    <div class="gender-category">
                        <input type="radio" name="gender" id="male" value="male" required>
                        <label for="gender">Male</label>
                        <input type="radio" name="gender" id="female" value="female">
                        <label for="gender">Female</label>
                        <input type="radio" name="gender" id="other" value="other">
                        <label for="gender">Other</label>
                    </div>
                </div>
                <div class="alert">
                    <p>By clicking sign up, you agree to our <a href="#">Terms,</a> <a href="#">Privacy Policy,</a> and
                        <a href="#">Cookies Policy</a>. You may receive SMS notifications from us and can opt out at any
                        time
                    </p>
                </div>
                <div class="button-container">
                    <input type="submit" value="Submit" name="submit">
                    <button type="reset">Clear</button>
                    <a href="index.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>