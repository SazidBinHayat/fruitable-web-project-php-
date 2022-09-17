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
    <title>Login</title>

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
        <h1 class="text-center mt-3 text-primary">User Login</h1>

        <form action="" method="post">

            < <div class="form-outline mb-3 w-50 m-auto">
                <label for="user_name" class="form-label">User name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name"
                    autocomplete="off" required="required">
    </div>

    <div class="form-outline mb-3 w-50 m-auto">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your password"
            autocomplete="off" required="required">
    </div>

    <div class="form-outline mb-3 w-50 m-auto">
        <input type="submit" name="user_login" class="btn btn-info" value="LOGIN">
        <p>Don't have an account?<a href="regis.php" class="text-danger"> Register</a></p>
    </div>

    </form>

    </div>

</body>

</html>

<?php
if(isset($_POST['user_login'])){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $select_query =" SELECT * FROM `user` WHERE username = '$user_name'";
    $result1= mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result1);
    $row_data = mysqli_fetch_assoc($result1);
    $ip=getIPAddress();

    //cart item
    $select_query_cart =" SELECT * FROM `cart_details` WHERE ip = '$ip'";
    $select_cart = mysqli_query($conn, $select_query_cart);
    $row_count_cart= mysqli_num_rows( $select_cart);


    if($row_count > 0)
    {
        if($password==$row_data['userpassword']){
            $_SESSION['username']=$user_name;
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('product.php', '_self')</script>";

            }
            else{
                $_SESSION['username']=$user_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('pay.php', '_self')</script>";
            }
        }

    }
        else{
            echo "<script>alert('Invalid')</script>";
        }
        

    }
    else{
        echo "<script>alert('Invalid')</script>";
    }
    



?>