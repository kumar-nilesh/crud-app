<?php
require("api/dbconfig.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id === '') {
    echo "Error: User ID not provided.";
    exit();
}

$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error retrieving user data: " . mysqli_error($conn);
    exit();
}

$row = mysqli_fetch_assoc($result);

if(isset($_POST["submit"])){

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

    $updateQuery = "UPDATE users SET 
                image = '$folder',
                first_name='$fname', 
                last_name='$lname', 
                username='$username', 
                email='$email', 
                password='$pass', 
                date_of_birth='$dob',  
                city='$city', 
                pin_code='$pincode', 
                gender='$gender' 
              WHERE id=$id";

    if(mysqli_query($conn, $updateQuery)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Sorry, there was an error updating the user: " . mysqli_error($conn);
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
            <form method="post" enctype="multipart/form-data">
                <!-- <h2>Registration</h2> -->
                <div class="content">
                    <div class="input-box">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="Enter first name"
                            value="<?php echo $row['first_name']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Enter last name"
                            value="<?php echo $row['last_name']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter username"
                            value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter email" value="<?php echo $row['email']; ?>"
                            required>
                    </div>
                    <div class="input-box">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" placeholder="Enter password"
                            value="<?php echo $row['password']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="cpass">Confirm Password</label>
                        <input type="text" name="cpass" placeholder="Enter confirm password"
                            value="<?php echo $row['password']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="dob">DOB</label>
                        <input type="date" name="dob" value="<?php echo $row['date_of_birth']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="file">Image</label>
                        <input type="file" name="photo"required>
                    </div>
                    <div class="input-box">
                        <label for="city">City</label>
                        <select id="city" name="city" value="<?php echo $row['city']; ?>" required>
                            <option value="Daman">Daman</option>
                            <option value="Vapi">Vapi</option>
                            <option value="Bhilad">Bhilad</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="pincode">Pin Code</label>
                        <input type="text" name="pincode" placeholder="Enter pincode"
                            value="<?php echo $row['pin_code']; ?>" required>
                    </div>
                    <span class="gender-title">Gender</span>
                    <div class="gender-category">

                        <input type="radio" name="gender" id="male" value="male"<?php if ($row['gender'] == 'male') echo " checked"; ?> required>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" id="female" value="female"<?php if ($row['gender'] == 'female') echo " checked"; ?> required>
                        <label for="female">Female</label>
                        <input type="radio" name="gender" id="other" value="other"<?php if ($row['gender'] == 'other') echo " checked"; ?> required>
                        <label for="other">Other</label>
                    </div>
                </div>
                <div class="alert">
                    <p>By clicking sign up, you agree to our <a href="#">Terms,</a> <a href="#">Privacy Policy,</a> and
                        <a href="#">Cookies Policy</a>. You may receive SMS notifications from us and can opt out at any
                        time
                    </p>
                </div>
                <div class="button-container">
                    <input type="submit" value="Update" name="submit">
                    <button type="reset">Clear</button>
                    <a href="index.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>