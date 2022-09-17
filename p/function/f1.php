<?php
include("connect.php");

function get_product(){
    global $conn;

$select = "SELECT * FROM `product` order by rand() LIMIT 0,12";
$result = mysqli_query($conn,$select);
//  $row = mysqli_fetch_assoc($result);
// echo $row['title' ];

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['id']; 
    $title = $row['title' ];
    $price = $row['price' ];
    $catagory = $row['catagory'];
    $img = $row['image' ];

    echo "<div class='col-md-3 mb-3'>
    <div class='card' style='width: 18rem;'>
        <img src='./img/$img' class='card-img-top' alt='$title'>
        <div class='card-body'>
            <h5 class='card-title'>$title</h5>
            <p class='card-text'>Price : $price tk</p>
            <a href='product.php?add_to_cart=$id' class='btn btn-primary'>Add to cart</a>
        </div>
    </div>
</div>";
}
}


// func for view all product

function get_all(){
    global $conn;

    $select = "SELECT * FROM `product` order by rand() ";
    $result = mysqli_query($conn,$select);
    //  $row = mysqli_fetch_assoc($result);
    // echo $row['title' ];
    
    while($row = mysqli_fetch_assoc($result))
    {
        $id = $row['id']; 
        $title = $row['title' ];
        $price = $row['price' ];
        $catagory = $row['catagory'];
        $img = $row['image' ];
    
        echo "<div class='col-md-3 mb-3'>
        <div class='card' style='width: 18rem;'>
            <img src='./img/$img' class='card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>Price : $price tk</p>
                <a href='product.php?add_to_cart=$id' class='btn btn-primary'>Add to cart</a>
            </div>
        </div>
    </div>";
    }

}


/* search func */

function search_product(){

    global $conn;
    if(isset($_GET['search_data_product'])){
    $searched = $_GET['search_data'];
    $search = "SELECT * FROM `product` where title like '%$searched%' ";
    $result = mysqli_query($conn,$search);

    $num_of_rows =mysqli_num_rows($result);
    if($num_of_rows == 0){
        echo "<h1 class='text-center text-danger'>This product is not availavle</h1>";
    }

    
    while($row = mysqli_fetch_assoc($result))
    {
        $id = $row['id']; 
        $title = $row['title' ];
        $price = $row['price' ];
        $catagory = $row['catagory'];
        $img = $row['image' ];
    
        echo "<div class='col-md-3 mb-3'>
        <div class='card' style='width: 18rem;'>
            <img src='./img/$img' class='card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>Price : $price tk</p>
                <a href='product.php?add_to_cart=$id' class='btn btn-primary'>Add to cart</a>
            </div>
        </div>
    </div>";
    }
}
}

//ip function

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
/* $ip = getIPAddress();  
echo 'User Real IP Address - '.$ip;  */ 


//cart function

function cart(){

    if(isset($_GET['add_to_cart'])){
        global $conn;
        $ip = getIPAddress();
        $get_product_id =$_GET['add_to_cart'];

        $select = "SELECT *FROM `cart_details` WHERE ip='$ip' AND product_id=$get_product_id";
        $result = mysqli_query($conn,$select);
        $num_of_rows =mysqli_num_rows($result);
        if($num_of_rows >0){

            echo"<script>alert('Already exists in cart')</script>";
            echo "<script>window.open('product.php','_self')</script>";
        }
        else{
            $insert_in_cart = "INSERT INTO `cart_details`(product_id, ip, quantity) VALUES ($get_product_id,'$ip',0)";
            $result = mysqli_query($conn,$insert_in_cart);
            echo"<script>alert('Added to cart')</script>";
            echo "<script>window.open('product.php','_self')</script>";
        }

    }
}

//item no in cart

function item_no(){

    if(isset($_GET['add_to_cart'])){
        global $conn;
        $ip = getIPAddress();

        $select = "SELECT *FROM `cart_details` WHERE ip='$ip' ";
        $result = mysqli_query($conn,$select);
        $count_cart_item =mysqli_num_rows($result);
    }
      
    else{
        global $conn;
        $ip = getIPAddress();
        $select = "SELECT *FROM `cart_details` WHERE ip='$ip' ";
        $result = mysqli_query($conn,$select);
        $count_cart_item =mysqli_num_rows($result);
    }
    echo $count_cart_item;
    
}


//
function get_in_cart()
{
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

        }
    }

}

?>