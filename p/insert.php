<?php
include("connect.php");

if(isset($_POST['insert'])){
    $title = $_POST['title'];
    $price = $_POST['price'];
    $catagory = $_POST['catagory'];
    $status = 'true';

    //image access
    $pro_img =  $_FILES['pro_img']['name'];

    //access temp name
    $temp_img = $_FILES['pro_img']['tmp_name'];

    if($title =='' or $price=='' or $catagory=='' or  $pro_img==''){
       echo"<script>alert('Fill all the fields')</script>";
       exit();
    }
    else{
        move_uploaded_file($temp_img,"./img/$pro_img");
        
        //insert query
        $sql= "insert into `product`(title, price, catagory, image, status) 
        VALUES ('$title','$price','$catagory','$pro_img','$status')";

        $result = mysqli_query($conn, $sql);
        if($result)
        {
            echo"<script>alert('Inserted successfully')</script>";
        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert product</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-3">Insert Product</h1>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="title" class="form-label">Product title</label>
                <input type="text" name="title" id="title" class="form-control" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <select name="catagory" class="form-select" aria-label="Default select example">
                    <option selected>Select Catagory</option>
                    <option value="1">Fruits</option>
                    <option value="2">Vegetables</option>
                </select>
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <label for="pro_img" class="form-label">Product Image</label>
                <input type="file" name="pro_img" id="pro_img" class="form-control" required="required">
            </div>

            <div class="form-outline mb-3 w-50 m-auto">
                <input type="submit" name="insert" class="btn btn-info" value="Insert Product">
            </div>


        </form>

    </div>
</body>

</html>