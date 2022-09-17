<?php
include("connect.php");
include('function/f1.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>

    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #049D4B;">
            <div class="container-fluid">
                <a class="navbar-brand">FRUITABLE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="product.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>

    <div class="container-fluid my-3 position-absolute top-50 start-50 translate-middle">
        <h1 class="text-center mt-3">Registration</h1>

        <form action="" method="post" enctype="multipart/form-data">



            <div class="form-outline mb-3 w-50 m-auto">
                <label for="user_name" class="form-label">User name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name"
                    autocomplete="off" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email"
                    autocomplete="off" required="required" />
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter Your password" autocomplete="off" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter Your Address"
                    autocomplete="off" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Your Mobile no."
                    autocomplete="off" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <input type="submit" name="user_register" class="btn btn-info" value="Register">
                <p>Already have an account?<a href="user_login.php" class="text-danger"> Login</a></p>
            </div>




        </form>

    </div>

</body>

</html>

<?php
if(isset($_POST['user_register'])){
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $ip = getIPAddress(); 

    //if user exist
    $select_u = "SELECT * FROM `user` WHERE username='$username' or user_email='$email'";
    $result1= mysqli_query($conn, $select_u);
    $rows_count = mysqli_num_rows($result1);
    if($rows_count>0){
        echo "<script>alert('Username already exists')</script>";
    }
    else{
        $insert = "INSERT INTO `user`(username, user_email, userpassword, user_ip, user_address, mobile)
        VALUES ('$username', '$email', '$pass' ,'$ip', '$address', '$mobile' )";
   
        $result= mysqli_query($conn, $insert);
        if($result)
        {
           echo "<script>alert('Registration successful')</script>";
        }
        else
        {
           echo "failed".mysqli_connect_error();
        }

    }


    
}
?>