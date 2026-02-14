<?php
$name = "";
$message = "";
$age = 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["my_name"]; 
    if($name == "Daniel"){
        $message = "Ahoj Dani";
        $age = $_POST["my_age"];
    } else{
        $message = "Neznám tě";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chatset="UTF-8">
        <meta name="viewport" content="width=devide-width, initial-scale=1.0">

    </head>
    <body>
        <h1>Test formulare</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae minus fugit magnam. Quisquam non cum debitis iste enim. Inventore nobis natus fugiat culpa, libero aut ratione sapiente quaerat a error!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil incidunt rerum nobis. Eveniet in animi laboriosam ipsa, deserunt earum magnam repudiandae id quibusdam dignissimos doloremque aspernatur quod maiores fugit molestiae.</p>
            <form method="post">
            <input type="text" name="my_name" placeholder="Zadejte jmeno">
            <input type="number" name="my_age" placeholder="Zadejte svůj věk">
            <button type="submit">Odeslat</button>
            </form>

<p>
<?php 
echo "Výstup: "; 
echo $message;
?>
</p>


<p>
<?php 
echo "Tvůj věk: "; 
echo $age;
?>
</p>


    </body>
</html>