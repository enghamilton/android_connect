<?php
$servername = "localhost";
$database = "id6312982_pizzaria_db";
$username = "id6312982_pizzaria_user";
$password = "qweewq123321";

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully</br>";    
}

// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];

    // get a product from products table
    //$result = mysql_query("SELECT * FROM products WHERE pid = $pid");
	
	$sql_user = "SELECT pid,name,price,description,create_at,updated_at FROM `products` WHERE pid = $pid";

	$result = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);

            $product = array();
            $product["pid"] = $result["pid"];
            $product["age"] = $result["age"];
            $product["height"] = $result["height"];
            $product["weight"] = $result["weight"];
			$product["oral"] = $result["oral"];
            $product["created_at"] = $result["created_at"];
            $product["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;

            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

mysqli_close($conn);
?>