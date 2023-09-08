<?php
session_start();
require_once("../includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payload'])) {
    $receivedData = json_decode($_POST['payload']);
    $receivedFunction = $_POST['setFunction'];

    if (function_exists($receivedFunction)) {
        $result = $receivedFunction($receivedData);
        echo $result;
    } else {
        echo "Invalid function name.";
    }
}

function createUser($request = null)
{
    $fname = $request->fname;
    $mname = $request->mname;
    $lname = $request->lname;
    $email = $request->email;
    $pass = $request->pass;
    $hashedPassword = sha1($pass);

    $checkUserDb = "SELECT *
    FROM login
    WHERE email = :email";
    $pdo = Database::connection();
    $stmt1 = $pdo->prepare($checkUserDb);
    $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt1->execute();
    $datas1  = $stmt1->fetchAll();
    $numRows1 = $stmt1->rowCount();

    if ($numRows1 == 0) {
        $insertUserDb = "INSERT INTO login (`email`, `password`, `userType`) VALUES (:email, :pass, :usertype)";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($insertUserDb);
        $stmt->execute(
            array(
                ':email' => $email,
                ':pass' => $hashedPassword,
                ':usertype' => 1,
            )
        );
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . $errorInfo[2];
            // Handle the error as needed (e.g., logging, displaying an error message)
            $msg['title'] = "Error";
            $msg['message'] = $errorMsg;
            $msg['icon'] = "error";
        } else {
            $insertProfileUserDb = "INSERT INTO owner_list (`Surname`, `Firstname`, `MiddleName`, `Email`) VALUES (:lname, :fname, :mname, :email)";
            $stmt = $pdo->prepare($insertProfileUserDb);
            $stmt->execute(
                array(
                    ':fname' => $fname,
                    ':mname' => $mname,
                    ':lname' => $lname,
                    ':email' => $email
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2];
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Success";
                $msg['icon'] = "success";
                $msg['status'] = "success";
            }
        }
    } else {
        $msg['title'] = "Warning";
        $msg['message'] = "Email has already been used";
        $msg['icon'] = "warning";
    }

    echo json_encode($msg);
};
