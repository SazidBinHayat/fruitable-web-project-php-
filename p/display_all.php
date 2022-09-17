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
    <title>Fruitable</title>

    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--own css-->
    <link rel="stylesheet" href="s2.css">
    <!-- fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #049D4B;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">ADMIN</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup><?php item_no();?></sup></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="searchAct.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>



        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
              
                <?php
                if(!isset($_SESSION['username'])){
                    echo"  <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome guest</a>

                </li>";
                 }
                 else{
                   echo"  <li class='nav-item'>
                     <a class='nav-link' href='#'>Welcome".$_SESSION['username']."</a>
 
                     </li>";
                 }

                if(!isset($_SESSION['username'])){
                   echo" <li class='nav-item' >
                    <a class='nav-link' href='user_login.php'>Login</a>
                    
                    </li>";
                }
                else{
                  echo"  <li class='nav-item'>
                    <a class='nav-link' href='logout.php'>Logout</a>

                    </li>";
                }

                ?>

            </ul>
        </nav>


        <!--text-->
        <div class="p-3">
            <h1 class="text-center">Fruitable</h1>
            <h5 class="text-center">Get your desired fruits & vegetables</h5>
        </div>

        <!--products-->
        <div class="container">
            <div class="row px-1">
                <!--fetch-->
                <?php
            get_all();
            ?>
                <!--row end-->
            </div>
            <!--cil end-->
        </div>

        <div class="bg-info p-3 mt-3 text-center">
            <p>All rights reserved © Designed by Sazid</p>
        </div>


    </div>
    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>