<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "config.php";
if (isset($_POST['update'])) {
$user_id = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$file = $_FILES['file'];
$filename = $file['name'];
$filepath = $file['tmp_name'];
$fileerror = $file['error'];
if ($fileerror == 0) { //0 MEANS SUCCESSFULLY UPLOADED
$destfile ='upload/'.$filename;
$sql = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$password',`gender`='$gender', `file`='$destfile' WHERE `id`='$user_id'";
$result = $conn->query($sql);
echo $result;
if ($result == TRUE) {
echo "Record updated successfully.";
}else{
echo "Error:" . $sql . "<br>" . $conn->error;
}
}
}
if (isset($_GET['id'])) {
$user_id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE `id`='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$first_name = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$password  = $row['password'];
$gender = $row['gender'];
$id = $row['id'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container ">
      <div class="row justify-content-center ">
        <div class="col-lg-6 col-12 " style="background-color:  #b7b8e5c2;">
          <h2 class="mt-3 mb-4">User Update Form</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
              <legend>Personal information:</legend>
              First name:<br>
              <div class="mb-2">
                <input type="text" name="firstname" class="form-control" value="<?php echo $first_name; ?>">
              </div>
              <input type="hidden" name="user_id" value="<?php echo $id; ?>">
              <br>
              Last name:<br>
              <div class="mb-2">
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
              </div>
              <br>
              Email:<br>
              <div class="mb-2">
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
              </div>
              <br>
              Password:<br>
              <div class="mb-2">
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
              </div>
              <br>
              Gender:<br>
              <div class="mb-2">
                <input type="radio" name="gender"  value="Male" <?php if($gender == 'Male'){ echo "checked";} ?> >Male
                <input type="radio" name="gender" value="Female" <?php if($gender == 'Female'){ echo "checked";} ?>>Female
              </div>
              <div class="mb-2">
                <label  class="form-label">File Upload</label>
                <input type="file" class="form-control shadow" name="file" value="<?php echo $file; ?>" >
              </div>
              <br>
              <input type="submit" value="Update" name="update" class="mb-3">
            </fieldset>
          </form>
        </body>
      </html>
      <?php
      } else{
      header('Location: view.php');
      }
      }
      ?>