<?php
include '../config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $query = "SELECT * FROM message WHERE id = $id";
            $result = $conn->query($query);
            echo json_encode($result->fetch_assoc());
        } else {
            $query = "SELECT * FROM message";
            $result = $conn->query($query);
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;
    case 'POST':
        $user_id = $input['user_id']; 
        $name = $input['name'];
        $email = $input['email'];
        $number = $input['number'];
        $message = $input['message'];  
        $query = "INSERT INTO message (user_id, name, email, number, message) VALUES ('$user_id', '$name', '$email', '$number', '$message')";
        $conn->query($query);
        echo json_encode(["message" => "Message created"]);
        break;
    case 'PUT':
        $user_id = $input['user_id']; 
        $name = $input['name'];
        $email = $input['email'];
        $number = $input['number'];
        $message = $input['message'];
        $query = "UPDATE message SET user_id='$user_id', name='$name', email='$email', number='$number', message='$message' WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Message updated"]);
        break;
    case 'DELETE':
        $query = "DELETE FROM message WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "Message deleted"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
