<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            require_once ("php/CreateDatabase.php");
            require_once ("php/component.php");

            $db = new CreateDatabase("Productdb", "Producttb");
        ?>
    </head>
    
    <body>
        <form method="post" action="###.php">
            Product Name:
            <br>
            <input type="text" name="first_name">
            <br>
            
            Product Price:
            <br>
            <input type="text" name="last_name">
            <br>
            
            Product Image:
            <br>
            <input type="text" name="#####">
            <br>
                
            <input type="submit" name="save" value="submit">
    
        </form>
  </body>
</html>