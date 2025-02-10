<?php
include '../config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $query = "SELECT * FROM orders WHERE id = $id";
            $result = $conn->query($query);
            echo json_encode($result->fetch_assoc());
        } else {
            $query = "SELECT * FROM orders";
            $result = $conn->query($query);
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;
    case 'POST':
        $user_id = $input['user_id'];
        $name = $input['name'];
        $number = $input['number'];
        $email = $input['email'];
        $method = $input['method'];
        $address = $input['address'];
        $total_products = $input['total_products'];
        $total_price = $input['total_price'];
        $placed_on = $input['placed_on'];
        $payment_status = $input['payment_status'];   
        $query = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$placed_on', '$payment_status')";
        $conn->query($query);
        echo json_encode(["message" => "Orders created"]);
        break;
    case 'PUT':
        $user_id = $input['user_id'];
        $name = $input['name'];
        $number = $input['number'];
        $email = $input['email'];
        $method = $input['method'];
        $address = $input['address'];
        $total_products = $input['total_products'];
        $total_price = $input['total_price'];
        $placed_on = $input['placed_on'];
        $payment_status = $input['payment_status'];
        $query = "UPDATE orders SET user_id='$user_id', name='$name', number='$number', email='$email', method='$method', address='$address', total_products='$total_products', total_price='$total_price', placed_on='$placed_on', payment_status='$payment_status' WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Orders updated"]);
        break;
    case 'DELETE':
        $query = "DELETE FROM orders WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Order deleted"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
