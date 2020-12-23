<?php

    //START SESSION
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
    
    require_once('php/CreateDatabase.php');
    require_once('./php/component.php');

    //instance of createdatabase class
    $database = new CreateDatabase("OOpAJs8VPh", "producttb");

    if(isset($_POST['add'])){
      
        if(isset($_SESSION['list'])){

            $item_array_id = array_column($_SESSION['list'], "product_id");
                       
            if(in_array($_POST['product_id'],$item_array_id)){
                echo"<script>alert('Product is already added!')</script>";
                echo"<script>window.location ='home.php'</script>";
            }else{
                $count = count($_SESSION['list']);
                $item_array = array(
                    'product_id' => $_POST['product_id']
                );
    
                $_SESSION['list'][$count] = $item_array;
            }
                

        }else{

            $item_array = array('product_id' => $_POST['product_id']);
    
            // Create new session variable
            $_SESSION['list'][0] = $item_array;
            print_r($_SESSION['list']);

            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>

    <!-- Font is Awesome  -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once("php/header.php");
    ?>
    
    <div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while($row=mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
    </div>
                
 

    <!--LS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>