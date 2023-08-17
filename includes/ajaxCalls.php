<?php 
require_once 'functions.php';

$action = $_GET['action'];

switch($action) {
    case 'login':
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
    
        $email = $data['email'];
        $password = $data['password'];
        $selectedRadio = $data['selectedRadio'];
        
        if($selectedRadio === "employee"){

            $employeeInf = loginEmployee($email);
    
            if($employeeInf && password_verify($password, $employeeInf["password"])) {
                $_SESSION['employee_id'] = $employeeInf['employee_id'];
                $_SESSION['employee_email'] = $employeeInf['email'];
                    // Send a JSON response back to the client
                $response = array('message' => 'successful','page'=>'./employee.php');
                echo json_encode($response);
            } else {
                echo json_encode(array('message' => 'unsuccessful'));
            }
        } else {
            // retrieve information
            $userInf = loginUser($email);
    
            if($userInf && password_verify($password, $userInf["password"])){
                $_SESSION['user_id'] = $userInf['client_id'];
                $_SESSION['user_email'] = $userInf['email'];
                // Send a JSON response back to the client
                $response = array('message' => 'successful', 'page'=>'./user.php');
                echo json_encode($response);
            }else{
                echo json_encode(array('message' => 'unsuccessful'));
            }
        }
        break;
    default:
        echo "Unknown action: $action";

}