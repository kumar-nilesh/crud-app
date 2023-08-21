<?php
require('api/dbconfig.php');

$query = "select * from users";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/header.css">
  <title>CURD operation</title>
  <style type="text/css">
		body
		{
		    counter-reset: Serial;          
		}

		tr td:first-child:before
		{
		  counter-increment: Serial;      
		  content: counter(Serial); 
		}
	</style>
</head>

<body>
  <?php
  include("header.php");
  ?>
  <div class="container">
  <?php
    if (mysqli_num_rows($result) > 0) {
      ?>
      <table class="data-table">
        <thead>
          <tr>
            <th>Sr</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td></td>
              <td>
              <img src="<?php echo $row['image']; ?>" height="100" width="100">
              </td>
              <td>
                <?php echo $row['first_name']; ?>
              </td>
              <td>
                <?php echo $row['last_name']; ?>
              </td>
              <td>
                <?php echo $row['email']; ?>
              </td>
              <td>
                <?php echo $row['gender']; ?>
              </td>
              <td>
                <?php echo $row['date_of_birth']; ?>
              </td>
              <td>
                <?php echo $row['city']; ?>
              </td>
              <td>
                <?php echo $row['pin_code']; ?>
              </td>

              <td>
                <a class="edit-button" href='update.php?id=<?php echo $row['id']; ?>'><i class="fa fa-edit"></i></a>
                <a class="delete-button" href='delete.php?id=<?php echo $row['id']; ?>'><i class="fa fa-trash-o"
                    aria-hidden="true"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <table class="data-table">
        <thead>
          <tr>
            <th>Sr</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
      <?php
      echo "No data found.";
    }

    mysqli_close($conn);
    ?>
  </div>
</body>

</html>