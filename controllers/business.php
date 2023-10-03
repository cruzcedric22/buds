<?php
require_once("../includes/config.php");
session_start();


$_SESSION['bus_id'];



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

function addBusiness($request = null)
{
    $businessName = $request->businessName;
    $businessEmail = $request->businessEmail;
    $businessBranch = $request->businessBranch;
    $businessEstablish = $request->businessEstablish;
    $businessDescrip = $request->businessDescrip;
    $businessNumber = $request->businessNumber;
    $businessOpenHour = $request->businessOpenHour;
    $businessCloseHour = $request->businessCloseHour;
    $businessAddress = $request->businessAddress;
    $businessBarangay = $request->businessBarangay;
    $businessLat = $request->businessLat;
    $businessLong = $request->businessLong;
    $businessFb = $request->businessFb;
    $businessIg = $request->businessIg;
    $businessCategory = $request->businessCategory;
    $subCategory = $request->subCategory;

    $msg = array();
    session_start();
    if (isset($_SESSION['ownerId'])) {
        $ownerId = $_SESSION['ownerId'];
    } else {
        // Handle the case where the session owner ID is not set
        $msg['title'] = "Error";
        $msg['message'] = "Session owner ID not set";
        $msg['icon'] = "error";
        echo json_encode($msg);
    }


    if (!empty($_FILES['businessLogo']['name'])) {
        $filename = $_FILES['businessLogo']['name'];
        $size = $_FILES['businessLogo']['size'];
        $tmp_name = $_FILES['businessLogo']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/logo/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            // Image uploaded successfully
            // ... Your existing database insertion logic ...

            $pdo = Database::connection();
            $sql = "INSERT INTO `business_list`(`ownerId`, `BusinessName`, `Businesslogo`, `BusinessEmail`, `BusinessBranch`, `BusinessEstablish`, `BusinessDescrip`, `BusinessNumber`, `BusinessOpenHour`, 
                `BusinessCloseHour`, `BusinessAddress`, `BusinessBrgy`, `BusinessCategory`, `BusinessSubCategory`, `BusinessStatus`) 
                VALUES (:owner, :busName, :logo, :email, :branch, :establish, :desc, :number, :open, :close, :address, :brgy, :category, :sub, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':owner' => $ownerId,
                    ':busName' => $businessName,
                    ':logo' => $newImageName,
                    ':email' => $businessEmail,
                    ':branch' => $businessBranch,
                    ':establish' => $businessEstablish,
                    ':desc' => $businessDescrip,
                    ':number' => $businessNumber,
                    ':open' => $businessOpenHour,
                    ':close' => $businessCloseHour,
                    ':address' => $businessAddress,
                    ':brgy' => $businessBarangay,
                    ':category' => $businessCategory,
                    ':sub' => $subCategory,
                    ':status' => 2 // Assuming 2 represents a certain status
                )
            );

            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                // Get the newly inserted business ID
                $selectId = "SELECT * FROM business_list WHERE BusinessName = :name AND BusinessBranch = :branch";
                $pdo = Database::connection();
                $stmt1 = $pdo->prepare($selectId);
                $stmt1->bindValue(':name', $businessName, PDO::PARAM_STR);
                $stmt1->bindValue(':branch', $businessBranch, PDO::PARAM_STR);
                $stmt1->execute();
                $datas1  = $stmt1->fetchAll();
                foreach ($datas1 as $data) {
                    $id = $data['bus_id'];
                }

                $sql3 = "INSERT INTO business_location (`bus_id`, `bus_lat`, `bus_long`) 
                VALUES ( :id, :lat, :long)";
                $stmt1 = $pdo->prepare($sql3);
                $stmt1->execute(
                    array(
                        ':id' => $id,
                        ':lat' => $businessLat,
                        ':long' => $businessLong,
                    )
                );
                if ($stmt1->errorCode() !== '00000') {
                    $errorInfo = $stmt->errorInfo();
                    $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                    // Handle the error as needed (e.g., logging, displaying an error message)
                    $msg['title'] = "Error";
                    $msg['message'] = $errorMsg;
                    $msg['icon'] = "error";
                    echo json_encode($msg);
                } else {

                    $sql2 = "INSERT INTO business_links (bus_id, bus_fb, bus_ig) 
                    VALUES ( :id, :fb, :ig)";
                    $stmt2 = $pdo->prepare($sql2);
                    $stmt2->execute(
                        array(
                            ':id' => $id,
                            ':fb' => $businessFb,
                            ':ig' => $businessIg,
                        )
                    );
                    if ($stmt2->errorCode() !== '00000') {
                        $errorInfo = $stmt->errorInfo();
                        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                        // Handle the error as needed (e.g., logging, displaying an error message)
                        $msg['title'] = "Error";
                        $msg['message'] = $errorMsg;
                        $msg['icon'] = "error";
                        echo json_encode($msg);
                    } else {
                        if ((!empty($_FILES['brgyClearance']['name']) && !empty($_FILES['DTIPermit']['name'])) &&
                            (!empty($_FILES['sanitaryPermit']['name']) && !empty($_FILES['cedula']['name'])) &&
                            !empty($_FILES['businessPermit']['name'])
                        ) {
                            $filename1 = $_FILES['brgyClearance']['name'];
                            $size1 = $_FILES['brgyClearance']['size'];
                            $tmp_name1 = $_FILES['brgyClearance']['tmp_name'];

                            $filename2 = $_FILES['DTIPermit']['name'];
                            $size2 = $_FILES['DTIPermit']['size'];
                            $tmp_name2 = $_FILES['DTIPermit']['tmp_name'];

                            $filename3 = $_FILES['sanitaryPermit']['name'];
                            $size3 = $_FILES['sanitaryPermit']['size'];
                            $tmp_name3 = $_FILES['sanitaryPermit']['tmp_name'];

                            $filename4 = $_FILES['cedula']['name'];
                            $size4 = $_FILES['cedula']['size'];
                            $tmp_name4 = $_FILES['cedula']['tmp_name'];

                            $filename5 = $_FILES['businessPermit']['name'];
                            $size5 = $_FILES['businessPermit']['size'];
                            $tmp_name5 = $_FILES['businessPermit']['tmp_name'];

                            $validImageExtensions = ['jpg', 'jpeg', 'png'];
                            $imageExtension1 = pathinfo($filename1, PATHINFO_EXTENSION);
                            $imageExtension1 = strtolower($imageExtension1);

                            $imageExtension2 = pathinfo($filename2, PATHINFO_EXTENSION);
                            $imageExtension2 = strtolower($imageExtension2);

                            $imageExtension3 = pathinfo($filename3, PATHINFO_EXTENSION);
                            $imageExtension3 = strtolower($imageExtension3);

                            $imageExtension4 = pathinfo($filename4, PATHINFO_EXTENSION);
                            $imageExtension4 = strtolower($imageExtension4);

                            $imageExtension5 = pathinfo($filename5, PATHINFO_EXTENSION);
                            $imageExtension5 = strtolower($imageExtension5);

                            if ((!in_array($imageExtension1, $validImageExtensions) && !in_array($imageExtension2, $validImageExtensions))
                                && (!in_array($imageExtension3, $validImageExtensions) && !in_array($imageExtension4, $validImageExtensions))
                                && !in_array($imageExtension5, $validImageExtensions)
                            ) {
                                $msg['title'] = "Warning";
                                $msg['message'] = "Invalid image extension";
                                $msg['icon'] = "warning";
                                $msg['status'] = "error";
                                echo json_encode($msg);
                            } elseif (($size1 > 512000 && $size2 > 512000)
                                && ($size3 > 512000 && $size4 > 512000) && $size5 > 512000
                            ) {
                                $msg['title'] = "Warning";
                                $msg['message'] = "Image size is too large";
                                $msg['icon'] = "warning";
                                $msg['status'] = "error";
                                echo json_encode($msg);
                            }

                            $targetDirectory = '../img/requirements/';
                            $newImageName1 = uniqid() . '.' . $imageExtension1;
                            $targetPath1 = $targetDirectory . $newImageName1;

                            $newImageName2 = uniqid() . '.' . $imageExtension2;
                            $targetPath2 = $targetDirectory . $newImageName2;

                            $newImageName3 = uniqid() . '.' . $imageExtension3;
                            $targetPath3 = $targetDirectory . $newImageName3;

                            $newImageName4 = uniqid() . '.' . $imageExtension4;
                            $targetPath4 = $targetDirectory . $newImageName4;

                            $newImageName5 = uniqid() . '.' . $imageExtension5;
                            $targetPath5 = $targetDirectory . $newImageName5;

                            if ((move_uploaded_file($tmp_name1, $targetPath1) && move_uploaded_file($tmp_name2, $targetPath2))
                                && (move_uploaded_file($tmp_name3, $targetPath3) && move_uploaded_file($tmp_name4, $targetPath4))
                                && move_uploaded_file($tmp_name5, $targetPath5)
                            ) {
                                $finalQuery = "INSERT INTO business_requirement (bus_id, bus_brgyclearance, bus_dtipermit, bus_sanitarypermit,bus_cedula,bus_mayorpermit) 
                                VALUES (:id, :photo1, :photo2, :photo3, :photo4, :photo5)";
                                $stmt5 = $pdo->prepare($finalQuery);
                                $stmt5->execute(
                                    array(
                                        ':id' => $id,
                                        ':photo1' => $newImageName1,
                                        ':photo2' => $newImageName2,
                                        ':photo3' => $newImageName3,
                                        ':photo4' => $newImageName4,
                                        ':photo5' => $newImageName5
                                    )
                                );
                                if ($stmt5->errorCode() !== '00000') {
                                    $errorInfo = $stmt->errorInfo();
                                    $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                                    // Handle the error as needed (e.g., logging, displaying an error message)
                                    $msg['title'] = "Error";
                                    $msg['message'] = $errorMsg;
                                    $msg['icon'] = "error";
                                    echo json_encode($msg);
                                } else {
                                    $msg['title'] = "Successful";
                                    $msg['message'] = "Business added successfully";
                                    $msg['icon'] = "success";
                                    $msg['status'] = "success";
                                    echo json_encode($msg);
                                }
                            } else {
                                $msg['title'] = "Error";
                                $msg['message'] = "Failed to move uploaded image to destination";
                                $msg['icon'] = "error";
                                $msg['status'] = "error";
                                $msg['debug'] = $_FILES; // Add this for debugging
                                echo json_encode($msg);
                            }
                        } else {
                            $msg['title'] = "Error";
                            $msg['message'] = "No image uploaded";
                            $msg['icon'] = "error";
                            $msg['status'] = "error";
                            echo json_encode($msg);
                        }
                    }
                }
            }
        } else {
            // Failed to upload image
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        // Handle the case where no image is uploaded
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtBusinessDetails($request = null)
{
    $bus_name = $request->bus_name;
    $number = $request->number;
    $address = $request->address;
    $email = $request->email;
    $establish = $request->establish;
    $opening = $request->opening;
    $closing = $request->closing;
    $branch = $request->branch;
    $fb = $request->fb;
    $ig = $request->ig;
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessLogo']['name'])) {
        $filename = $_FILES['businessLogo']['name'];
        $size = $_FILES['businessLogo']['size'];
        $tmp_name = $_FILES['businessLogo']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/logo/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_list SET BusinessName = :name, Businesslogo = :logo, BusinessNumber = :number, BusinessAddress = :address, BusinessEmail = :email, BusinessEstablish = :establish, BusinessOpenHour = :open,
            BusinessCloseHour = :close, BusinessBranch = :branch WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':name' => $bus_name,
                    ':logo' => $newImageName,
                    ':number' => $number,
                    ':address' => $address,
                    ':email' => $email,
                    ':establish' => $establish,
                    ':open' => $opening,
                    ':close' => $closing,
                    ':branch' => $branch,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $sql = "UPDATE business_list SET BusinessName = :name,BusinessNumber = :number,BusinessAddress = :address,BusinessEmail = :email,BusinessEstablish = :establish,BusinessOpenHour = :open,
        BusinessCloseHour = :close, BusinessBranch = :branch WHERE bus_id = :id";
        $sql2 = "UPDATE business_links SET bus_fb = :fb, bus_ig = :ig WHERE bus_id = :id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                ':name' => $bus_name,
                ':number' => $number,
                ':address' => $address,
                ':email' => $email,
                ':establish' => $establish,
                ':open' => $opening,
                ':close' => $closing,
                ':branch' => $branch,
                ':id' => $id
            )
        );
        $stmt1 = $pdo->prepare($sql2);
        $stmt1->execute(
            array(
                ':fb' => $fb,
                ':ig' => $ig,
                ':id' => $id
            )
        );
        if ($stmt->errorCode() !== '00000' && $stmt1->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql . "And" . $sql2;
            // Handle the error as needed (e.g., logging, displaying an error message)
            $msg['title'] = "Error";
            $msg['message'] = $errorMsg;
            $msg['icon'] = "error";
            echo json_encode($msg);
        } else {
            $msg['title'] = "Successful";
            $msg['message'] = "Sucessfully Updated";
            $msg['icon'] = "success";
            $msg['status'] = "success";
            echo json_encode($msg);
        }
    }
};

function edtBusinessBrgyClear($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessBrgyClearance']['name'])) {
        $filename = $_FILES['businessBrgyClearance']['name'];
        $size = $_FILES['businessBrgyClearance']['size'];
        $tmp_name = $_FILES['businessBrgyClearance']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/requirements/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_requirement SET bus_brgyclearance = :clearance WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':clearance' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded (Barangay Clearance)";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtDTIPermit($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessDTIPermit']['name'])) {
        $filename = $_FILES['businessDTIPermit']['name'];
        $size = $_FILES['businessDTIPermit']['size'];
        $tmp_name = $_FILES['businessDTIPermit']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/requirements/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_requirement SET bus_dtipermit = :clearance WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':clearance' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded (DTI Permit)";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtSanitaryPermit($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessSanitaryPermit']['name'])) {
        $filename = $_FILES['businessSanitaryPermit']['name'];
        $size = $_FILES['businessSanitaryPermit']['size'];
        $tmp_name = $_FILES['businessSanitaryPermit']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/requirements/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_requirement SET bus_sanitarypermit = :clearance WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':clearance' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded(Sanitary Permit)";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtCedulaPermit($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessCedulaPermit']['name'])) {
        $filename = $_FILES['businessCedulaPermit']['name'];
        $size = $_FILES['businessCedulaPermit']['size'];
        $tmp_name = $_FILES['businessCedulaPermit']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/requirements/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_requirement SET bus_cedula = :clearance WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':clearance' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded(Cedula)";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtMayorPermit($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['businessMayorPermit']['name'])) {
        $filename = $_FILES['businessMayorPermit']['name'];
        $size = $_FILES['businessMayorPermit']['size'];
        $tmp_name = $_FILES['businessMayorPermit']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/requirements/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_requirement SET bus_mayorpermit = :clearance WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':clearance' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded(Mayor's Permit)";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function addJobSpec1($request = null)
{
    $jobSpecs = json_decode($request->jobSpecs);

    foreach ($jobSpecs as $jobSpec) {
        $response[] = "<div class='input-group'>
        <input class='form-control addJobSpec1' id='exampleFormControlTextarea1' value = '" . htmlspecialchars($jobSpec->value) . "' onkeydown='handleJobSpec1Input(event)'>
        <button type='button' class='btn btn-icon btn-success minus-button-jobSpec1' data-key='" . htmlspecialchars($jobSpec->value) . "'><i class='bx bx-minus'></i></button>
        </div>";
    }

    $response[] = "<div class='input-group'>
    <input class='form-control addJobSpec1' id='exampleFormControlTextarea1' onkeydown='handleJobSpec1Input(event)'>
    <button type='button' class='btn btn-icon btn-success' onclick='addJobSpec1()'><i class='bx bx-plus'></i></button>
    </div>";
    echo json_encode($response);
};

function addJobSpec2($request = null)
{
    $jobSpecs = json_decode($request->jobSpecs);
    $response = []; // Initialize an empty array

    foreach ($jobSpecs as $jobSpec) {
        $response[] = "<div class='input-group'>
        <input class='form-control addJobSpec2' id='exampleFormControlTextarea2' value = '" . htmlspecialchars($jobSpec->value) . "' onkeydown='handleJobSpec2Input(event)'>
        <button type='button' class='btn btn-icon btn-success minus-button-jobSpec2' data-key='" . htmlspecialchars($jobSpec->value) . "'><i class='bx bx-minus'></i></button>
        </div>";
    }

    $response[] = "<div class='input-group'>
    <input class='form-control addJobSpec2' id='exampleFormControlTextarea2' onkeydown='handleJobSpec1Input(event)'>
    <button type='button' class='btn btn-icon btn-success' onclick='addJobSpec2()'><i class='bx bx-plus'></i></button>
    </div>";
    echo json_encode($response);
};

function addJob($request = null)
{
    $jobTitle = $request->jobTitle;
    $jobDesc = $request->jobDesc;
    $degree = $request->degree;
    $experience = $request->experience;
    $id = $_SESSION['bus_id'];
    $msg = array();

    $jobSpecifications = $request->jobSpecifications;
    $commaSeparatedArray = [];

    foreach ($jobSpecifications as $jobSpecification) {
        $jobSpecificationValue = $jobSpecification->val;
        if (is_array($jobSpecificationValue)) {
            $commaSeparated = implode(', ', $jobSpecificationValue);
        } else {
            $commaSeparated = $jobSpecificationValue;
        }
        $commaSeparatedArray[] = $commaSeparated;
    }
    $commaSeparatedStringJobSpeci = implode(',', $commaSeparatedArray);
    //status 
    //0-open
    //1-closed
    $sql = "INSERT INTO business_applicant(bus_id,pos_vacant,job_desc,job_spec,degree,year_exp,status)
    VALUES (:id, :jobTile, :jobDesc, :jobSpec, :degree, :year_exp, :status)";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':id' => $id,
            ':jobTile' => $jobTitle,
            ':jobDesc' => $jobDesc,
            ':jobSpec' => $commaSeparatedStringJobSpeci,
            ':degree' => $degree,
            ':year_exp' => $experience,
            ':status' => 1 // Assuming 1 represents a certain status
        )
    );

    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
        echo json_encode($msg);
    } else {
        $msg['title'] = "Successful";
        $msg['message'] = "Sucessfully Added";
        $msg['icon'] = "success";
        $msg['status'] = "success";
        echo json_encode($msg);
    }
};

function edtJob($request = null)
{
    $pos = $request->pos;
    $jobDescEdt = $request->jobDescEdt;
    $degreeEdt = $request->degreeEdt;
    $expEdt = $request->expEdt;
    $id = $request->id;
    $msg = array();

    $edtJobSpecs = $request->edtJobSpec;
    $commaSeparatedArray = [];

    foreach ($edtJobSpecs as $jobSpecification) {
        $jobSpecificationValue = $jobSpecification->value;
        if (is_array($jobSpecificationValue)) {
            $commaSeparated = implode(', ', $jobSpecificationValue);
        } else {
            $commaSeparated = $jobSpecificationValue;
        }
        $commaSeparatedArray[] = $commaSeparated;
    }
    $commaSeparatedStringJobSpeci = implode(',', $commaSeparatedArray);

    $sql = "UPDATE business_applicant
    SET pos_vacant = :pos,
        job_desc = :jobdesc,
        job_spec = :job_spec,
        degree = :degree,
        year_exp = :exp
    WHERE bus_applicant = :id;";


    $pdo = Database::connection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':pos' => $pos,
            ':jobdesc' => $jobDescEdt,
            ':job_spec' => $commaSeparatedStringJobSpeci,
            ':degree' => $degreeEdt,
            ':exp' => $expEdt,
            ':id' => $id
        )
    );
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
        echo json_encode($msg);
    } else {
        $msg['title'] = "Successful";
        $msg['message'] = "Sucessfully Edited";
        $msg['icon'] = "success";
        echo json_encode($msg);
    }
};

function edtJobStatus($request = null)
{
    $jobId = $request->jobId;
    $status = $request->status;

    if ($status == 1) {
        $sql = "UPDATE business_applicant SET status = 0 WHERE bus_applicant = :id";
    } else {
        $sql = "UPDATE business_applicant SET status = 1 WHERE bus_applicant = :id";
    }
    $pdo = Database::connection();
    $stmt = $pdo->prepare($sql);

    $stmt->execute(
        array(
            ':id' => $jobId
        )
    );
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
        echo json_encode($msg);
    } else {
        $msg['title'] = "Successful";
        $msg['message'] = "Sucessfully Edited";
        $msg['icon'] = "success";
        echo json_encode($msg);
    }
};

function addPics($request = null)
{
    // Check if 'bus_id' session variable is set
    if (isset($_SESSION['bus_id'])) {
        $id = $_SESSION['bus_id'];
        $msg = array();
        $sql = "SELECT pic1 FROM business_carousel WHERE bus_id = :id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $numRows1 = $stmt->rowCount();
        if ($numRows1 == 0) {
            if (
                !empty($_FILES['pic1']['name']) &&
                !empty($_FILES['pic2']['name']) &&
                !empty($_FILES['pic3']['name']) &&
                !empty($_FILES['pic4']['name'])
            ) {
                // Define the target directory
                $targetDirectory = '../img/gallery1/';

                // Check if the target directory exists, and create it if not
                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                // Initialize your PDO connection (assuming you have a class named Database for this)
                $pdo = Database::connection();

                // Define valid image extensions and initialize an array to store error messages
                $validImageExtensions = ['jpg', 'jpeg', 'png'];
                $errorMsgs = [];

                // Initialize an array to store the generated filenames
                $newImageNames = [];

                // Loop through each file input
                for ($i = 1; $i <= 4; $i++) {
                    $fieldName = 'pic' . $i;
                    $filename = $_FILES[$fieldName]['name'];
                    $size = $_FILES[$fieldName]['size'];
                    $tmp_name = $_FILES[$fieldName]['tmp_name'];

                    $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
                    $imageExtension = strtolower($imageExtension);

                    // Check if the file extension is valid
                    if (!in_array($imageExtension, $validImageExtensions)) {
                        $errorMsgs[] = "Invalid image extension for $fieldName";
                    }

                    // Check if the file size is within the limit
                    if ($size > 512000) {
                        $errorMsgs[] = "Image size is too large for $fieldName";
                    }

                    // Generate a unique filename
                    $newImageName = uniqid() . '.' . $imageExtension;
                    $targetPath = $targetDirectory . $newImageName;

                    // Move the uploaded file to the destination directory
                    if (!move_uploaded_file($tmp_name, $targetPath)) {
                        $errorMsgs[] = "Failed to move uploaded image for $fieldName";
                    } else {
                        // Store the generated filename in the array
                        $newImageNames[] = $newImageName;
                    }
                }

                // Check if there are any error messages
                if (!empty($errorMsgs)) {
                    $msg['title'] = "Warning";
                    $msg['message'] = implode("\n", $errorMsgs);
                    $msg['icon'] = "warning";
                    $msg['status'] = "error";
                    echo json_encode($msg);
                } else {
                    // Insert the filenames into the database
                    $sql = "INSERT INTO business_carousel (bus_id, pic1, pic2, pic3, pic4) VALUES (:id, :pic1, :pic2, :pic3, :pic4)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

                    // Assign the generated filenames to the variables
                    $stmt->bindParam(':pic1', $newImageNames[0], PDO::PARAM_STR);
                    $stmt->bindParam(':pic2', $newImageNames[1], PDO::PARAM_STR);
                    $stmt->bindParam(':pic3', $newImageNames[2], PDO::PARAM_STR);
                    $stmt->bindParam(':pic4', $newImageNames[3], PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        $msg['title'] = "Successful";
                        $msg['message'] = "Success";
                        $msg['icon'] = "success";
                        $msg['status'] = "success";
                        echo json_encode($msg);
                    } else {
                        $errorInfo = $stmt->errorInfo();
                        $errorMsg = "SQL Error: " . $errorInfo[2];
                        // Handle the error as needed (e.g., logging, displaying an error message)
                        $msg['title'] = "Error";
                        $msg['message'] = $errorMsg;
                        $msg['icon'] = "error";
                        echo json_encode($msg);
                    }
                }
            } else {
                $msg['title'] = "Error";
                $msg['message'] = "Upload an image for all the fields";
                $msg['icon'] = "error";
                $msg['status'] = "error";
                echo json_encode($msg);
            }
        } else {

            if (!empty($_FILES['pic1']['name'])) {
                $filename = $_FILES['pic1']['name'];
                $size = $_FILES['pic1']['size'];
                $tmp_name = $_FILES['pic1']['tmp_name'];

                $validImageExtensions = ['jpg', 'jpeg', 'png'];
                $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
                $imageExtension = strtolower($imageExtension);

                if (!in_array($imageExtension, $validImageExtensions)) {
                    $msg['title'] = "Warning";
                    $msg['message'] = "Invalid image extension";
                    $msg['icon'] = "warning";
                    $msg['status'] = "error";
                    echo json_encode($msg);
                } elseif ($size > 512000) {
                    $msg['title'] = "Warning";
                    $msg['message'] = "Image size is too large";
                    $msg['icon'] = "warning";
                    $msg['status'] = "error";
                    echo json_encode($msg);
                }

                $newImageName = uniqid() . '.' . $imageExtension;
                $targetDirectory = '../img/requirements/';
                $targetPath = $targetDirectory . $newImageName;

                if (move_uploaded_file($tmp_name, $targetPath)) {
                    $sql = "UPDATE business_requirement SET bus_mayorpermit = :clearance WHERE bus_id = :id";
                    $pdo = Database::connection();
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(
                        array(
                            ':clearance' => $newImageName,
                            ':id' => $id
                        )
                    );
                    if ($stmt->errorCode() !== '00000') {
                        $errorInfo = $stmt->errorInfo();
                        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                        // Handle the error as needed (e.g., logging, displaying an error message)
                        $msg['title'] = "Error";
                        $msg['message'] = $errorMsg;
                        $msg['icon'] = "error";
                        echo json_encode($msg);
                    } else {
                        $msg['title'] = "Successful";
                        $msg['message'] = "Sucessfully Updated";
                        $msg['icon'] = "success";
                        $msg['status'] = "success";
                        echo json_encode($msg);
                    }
                } else {
                    $msg['title'] = "Error";
                    $msg['message'] = "Failed to move uploaded image to destination";
                    $msg['icon'] = "error";
                    $msg['status'] = "error";
                    $msg['debug'] = $_FILES; // Add this for debugging
                    echo json_encode($msg);
                }
            }
        }
    }
};

function edtPic1($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic1']['name'])) {
        $filename = $_FILES['pic1']['name'];
        $size = $_FILES['pic1']['size'];
        $tmp_name = $_FILES['pic1']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/gallery1/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_carousel SET pic1 = :pic1 WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':pic1' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtPic2($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic2']['name'])) {
        $filename = $_FILES['pic2']['name'];
        $size = $_FILES['pic2']['size'];
        $tmp_name = $_FILES['pic2']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/gallery1/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_carousel SET pic2 = :pic2 WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':pic2' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtPic3($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic3']['name'])) {
        $filename = $_FILES['pic3']['name'];
        $size = $_FILES['pic3']['size'];
        $tmp_name = $_FILES['pic3']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/gallery1/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_carousel SET pic3 = :pic3 WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':pic3' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function edtPic4($request = null)
{
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic4']['name'])) {
        $filename = $_FILES['pic4']['name'];
        $size = $_FILES['pic4']['size'];
        $tmp_name = $_FILES['pic4']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/gallery1/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_carousel SET pic4 = :pic4 WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':pic4' => $newImageName,
                    ':id' => $id
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function uploadPost($request = null)
{
    $title = $request->title;
    $desc = $request->desc;
    $date = $request->date;
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic']['name'])) {
        $filename = $_FILES['pic']['name'];
        $size = $_FILES['pic']['size'];
        $tmp_name = $_FILES['pic']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/post/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "INSERT INTO business_post(bus_id,post_title,post_desc,photo,post_date) VALUES (:id, :title, :desc, :photo, :date)";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id,
                    ':title' => $title,
                    ':desc' => $desc,
                    ':photo' => $newImageName,
                    ':date' => $date
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $msg['title'] = "Error";
        $msg['message'] = "No image uploaded";
        $msg['icon'] = "error";
        $msg['status'] = "error";
        echo json_encode($msg);
    }
};

function editPost($request = null)
{
    $titleEdt = $request->titleEdt;
    $descEdt = $request->descEdt;
    $dateEdt = $request->dateEdt;
    $msg = array();
    $id = $_SESSION['bus_id'];

    if (!empty($_FILES['pic']['name'])) {
        $filename = $_FILES['pic']['name'];
        $size = $_FILES['pic']['size'];
        $tmp_name = $_FILES['pic']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
            echo json_encode($msg);
        }

        $newImageName = uniqid() . '.' . $imageExtension;
        $targetDirectory = '../img/post/';
        $targetPath = $targetDirectory . $newImageName;

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $sql = "UPDATE business_post SET post_title = :title,post_desc = :desc,photo = :photo,post_date = :date WHERE bus_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id,
                    ':title' => $titleEdt,
                    ':desc' => $descEdt,
                    ':photo' => $newImageName,
                    ':date' => $dateEdt
                )
            );
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
                // Handle the error as needed (e.g., logging, displaying an error message)
                $msg['title'] = "Error";
                $msg['message'] = $errorMsg;
                $msg['icon'] = "error";
                echo json_encode($msg);
            } else {
                $msg['title'] = "Successful";
                $msg['message'] = "Sucessfully Updated";
                $msg['icon'] = "success";
                $msg['status'] = "success";
                echo json_encode($msg);
            }
        } else {
            $msg['title'] = "Error";
            $msg['message'] = "Failed to move uploaded image to destination";
            $msg['icon'] = "error";
            $msg['status'] = "error";
            $msg['debug'] = $_FILES; // Add this for debugging
            echo json_encode($msg);
        }
    } else {
        $titleEdt = $request->titleEdt;
        $descEdt = $request->descEdt;
        $dateEdt = $request->dateEdt;
        $msg = array();
        $id = $_SESSION['bus_id'];

        $sql = "UPDATE business_post SET post_title = :title,post_desc = :desc,post_date = :date WHERE bus_id = :id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                ':id' => $id,
                ':title' => $titleEdt,
                ':desc' => $descEdt,
                ':date' => $dateEdt
            )
        );
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
            // Handle the error as needed (e.g., logging, displaying an error message)
            $msg['title'] = "Error";
            $msg['message'] = $errorMsg;
            $msg['icon'] = "error";
            echo json_encode($msg);
        } else {
            $msg['title'] = "Successful";
            $msg['message'] = "Sucessfully Updated";
            $msg['icon'] = "success";
            $msg['status'] = "success";
            echo json_encode($msg);
        }
    }
};

function edtPostStatus($request = null)
{
    $postId = $request->postId;
    $status = $request->status;

    if ($status == 1) {
        $sql = "UPDATE business_post SET status = 0 WHERE bus_post_id = :id";
    } else {
        $sql = "UPDATE business_post SET status = 1 WHERE bus_post_id = :id";
    }
    $pdo = Database::connection();
    $stmt = $pdo->prepare($sql);

    $stmt->execute(
        array(
            ':id' => $postId
        )
    );
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
        echo json_encode($msg);
    } else {
        $msg['title'] = "Successful";
        $msg['message'] = "Sucessfully Edited";
        $msg['icon'] = "success";
        echo json_encode($msg);
    }
};

function commentAndRating($request = null)
{
    $comment = $request->comment;
    $rating = $request->rating;
    $userid = $request->userid;
    $bus_id = $request->bus_id;

    $sql = "INSERT INTO business_reviews(bus_id,user_id,rating,comment) VALUES (:bus_id, :user_id, :rating, :comment)";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($sql);

    $stmt->execute(
        array(
            ':bus_id' => $bus_id,
            ':user_id' => $userid,
            ':rating' => $rating,
            ':comment' => $comment
        )
    );
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2] . " in query: " . $sql;
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
        echo json_encode($msg);
    } else {
        $msg['title'] = "Successful";
        $msg['message'] = "Your Feedback has been sent";
        $msg['icon'] = "success";
        echo json_encode($msg);
    }
};
