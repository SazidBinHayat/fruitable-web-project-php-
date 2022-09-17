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
    <style>
    .cart_img {
        width: 90px;
        height: 60px;
        object-fit: contain;
    }
    </style>
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
                            <a class="nav-link" href="cart.php"><i
                                    class="fa-solid fa-cart-shopping"></i><sup><?php item_no();?></sup></a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <?php
        cart();
        ?>


        <!--text-->
        <div class="p-3">
            <h1 class="text-center">Fruitable</h1>
            <h5 class="text-center">Get your desired fruits & vegetables</h5>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-success table-striped-columns table-hover text-center">
                        <thead>
                            <tr>
                                <th>Product title</th>
                                <th>Product image</th>
                                <th>Quantity</th>
                                <th>Total price</th>
                                <th>Remove</th>
                                <th colspan="2">Add /Delete</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php
                      global $conn;
                      $ip = getIPAddress();
                      $total = 0;
                  
                      $select = "SELECT *FROM `cart_details` WHERE ip='$ip' ";
                      $result = mysqli_query($conn,$select);
                      while($row = mysqli_fetch_array($result)){
                          $product_id = $row['product_id'];
                          $select_products = "SELECT *FROM `product` WHERE  id='$product_id' ";
                          $result_products =  mysqli_query($conn,$select_products);
                          while($row_product_price = mysqli_fetch_array($result_products) ){
                              $product_price = array($row_product_price['price']);
                              $price_tab = $row_product_price['price'];
                              $product_title = $row_product_price['title'];
                              $product_image = $row_product_price['image'];
                              $product_val = array_sum($product_price);
                              $total += $product_val;
                
                      
                    ?>
                            <tr>
                                <td><?php echo $product_title?></td>
                                <td><img class="cart_img" src="./img/<?php echo $product_image?>"></td>
                                <td><input type="text" name="qt" class="form-input"></td>
                                <?php
                            $ip = getIPAddress();
                            if(isset($_POST['update_cart'])){
                                $qt = $_POST['qt'];
                                $update = "UPDATE `cart_details` SET quantity=$qt where ip= '$ip'" ;
                                $result_up = mysqli_query($conn,$update);
                                $total =  $total*$qt;

                            }
                            ?>

                                <td><?php echo $price_tab?></td>
                                <td><input type="checkbox" name="remove[]" value="<?php
                            echo $product_id ?>"></td>
                                <td>
                                    <input class="bg-info px-3 mx-3" type="submit" value="Update" name="update_cart">
                                    <input class="bg-info px-3 mx-3" type="submit" value="Remove" name="remove_cart">
                                </td>
                            </tr>

                            <?php

                        }
                    }?>

                        </tbody>

                    </table>
                    <div class="d-flex">
                        <h4 class="px-3">Subtotal:<strong><?php echo $total?>/-</strong> </h4>
                        <a href="product.php"><button class="bg-info px-3 mx-3">Continue shopping</button></a>
                        <button class="bg-info px-3"><a href="checkout.php">Checkout</a></button>
                    </div>

            </div>

        </div>
        </form>

        <!-- cart rmv-->
        <?php
        function rem_crt()
        {
            global $conn;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['remove'] as $remove_id)
                {
                    echo $remove_id;
                    $delete= "DELETE FROM `cart_details` WHERE product_id = $remove_id";
                     $res = mysqli_query($conn,$delete);
                     if($res)
                     {
                        echo "<script>window.open('cart.php','_self')</script>";
                     }    

                }

            }

        }
        echo $remove_item = rem_crt();
        ?>



        <div class="bg-info position-absolute bottom-0 p-3 text-center" style="width: 100%;">
            <p>All rights reserved © Designed by Sazid</p>
        </div>


    </div>
    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>