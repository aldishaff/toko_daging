<?php
include '../config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $query = "SELECT * FROM cart WHERE id = $id";
            $result = $conn->query($query);
            echo json_encode($result->fetch_assoc());
        } else {
            $query = "SELECT * FROM cart";
            $result = $conn->query($query);
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;
    case 'POST':
        $user_id = $input['user_id']; 
        $name = $input['name'];
        $price = $input['price'];
        $quantity = $input['quantity'];
        $image = $input['image'];  
        $query = "INSERT INTO cart (user_id, name, price, quantity, image) VALUES ('$user_id', '$name', '$price', '$quantity', '$image')";
        $conn->query($query);
        echo json_encode(["message" => "cart created"]);
        break;
    case 'PUT':
        $user_id = $input['user_id']; 
        $name = $input['name'];
        $price = $input['price'];
        $quantity = $input['quantity'];
        $image = $input['image']; 
        $query = "UPDATE cart SET user_id='$user_id', name='$name', price='$price', quantity='$quantity', image='$image' WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "cart updated"]);
        break;
    case 'DELETE':
        $query = "DELETE FROM cart WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Cart deleted"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
