<?php
include '../config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $query = "SELECT * FROM products WHERE id = $id";
            $result = $conn->query($query);
            echo json_encode($result->fetch_assoc());
        } else {
            $query = "SELECT * FROM products";
            $result = $conn->query($query);
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;
    case 'POST':
        $name = $input['name'];
        $price = $input['price'];
        $image = $input['image'];   
        $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
        $conn->query($query);
        echo json_encode(["message" => "Product created"]);
        break;
    case 'PUT':
        $name = $input['name'];
        $price = $input['price'];
        $image = $input['image'];
        $query = "UPDATE products SET name='$name', price='$price', image='$image' WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Product updated"]);
        break;
    case 'DELETE':
        $query = "DELETE FROM products WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Product deleted"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
