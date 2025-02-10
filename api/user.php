<?php
include '../config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $query = "SELECT * FROM users WHERE id = $id";
            $result = $conn->query($query);
            echo json_encode($result->fetch_assoc());
        } else {
            $query = "SELECT * FROM users";
            $result = $conn->query($query);
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;
    case 'POST':
        $name = $input['name'];
        $email = $input['email'];
        $password = $input['password'];
        $user_type = $input['user_type'];   
        $query = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        $conn->query($query);
        echo json_encode(["message" => "User created"]);
        break;
    case 'PUT':
        $name = $input['name'];
        $email = $input['email'];
        $password = $input['password'];
        $user_type = $input['user_type'];
        $query = "UPDATE users SET name='$name', email='$email', password='$password', user_type='$user_type' WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "User updated"]);
        break;
    case 'DELETE':
        $query = "DELETE FROM users WHERE id=$id";
        $conn->query($query);
        echo json_encode(["message" => "User deleted"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
