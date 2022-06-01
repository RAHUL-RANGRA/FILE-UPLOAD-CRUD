<?php
include "config.php";
if (isset($_POST['submit'])) {
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$file = $_FILES['file'];
// print_r($file);
$filename = $file['name'];
$filepath = $file['tmp_name'];
$fileerror = $file['error'];
if ($fileerror == 0) { //0 MEANS SUCCESSFULLY UPLOADED
$destfile ='upload/'.$filename;
// echo("$destfile");
move_uploaded_file($filepath,  $destfile);
$sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`,  `gender`, `file`) VALUES ('$first_name','$last_name','$email','$password','$gender','$destfile')";
$result = $conn->query($sql);
if ($result == TRUE) {
echo "New record created successfully.";
}else{
echo "Error:". $sql . "<br>". $conn->error;
}
}
}
$conn->close();
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
        <div class="col-lg-6 col-12 " style="background-color: #b7b8e5c2;">
          
          <h2 class="mt-3 mb-4">Signup Form</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
              <!----LEGEND TAG----->
              <!-- <legend>Personal information:</legend> -->
              <div class="mb-2">
                <label for="exampleInputEmail1" class="form-label">Firstname</label>
                <input type="text" class="form-control shadow" id="exampleInputEmail1" name="firstname" aria-describedby="emailHelp">
              </div>
              <div class="mb-2">
                <label for="exampleInputEmail1" class="form-label">Lastname</label>
                <input type="text" class="form-control shadow" id="exampleInputEmail1" name="lastname" aria-describedby="emailHelp">
              </div>
              <div class="mb-2">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control shadow" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control shadow" name="password" id="exampleInputPassword1">
              </div>
              
              <div class="pb-4">
                Gender:<br>
                <input type="radio" name="gender" value="Male">Male
                <input type="radio" name="gender" value="Female">Female
              </div>
              
              <div class="mb-2">
                <label  class="form-label">File Upload</label>
                <input type="file" class="form-control shadow" name="file" >
              </div>
              <br>

              <input type="submit" name="submit" value="submit" class="mb-2">
              
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>