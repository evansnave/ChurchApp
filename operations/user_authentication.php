<?php

session_start();
include "connection.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $sql = "SELECT * FROM accounts WHERE account_name = :username ";
    $statement = $db->prepare($sql);
    $statement->execute(
        array(
            'username' => trim($_POST['username'])
        )
    );
    $count = $statement->rowCount();

    if ($count > 0) {
        $result = $statement->fetchAll();

        foreach ($result as $row) {
            if ($row['account_enabled'] == 1) {
                if (password_verify($_POST["password"], $row["account_password"])) {
                    $_SESSION['username']  = $row['account_name'];
                    $_SESSION['name']      = $row['username'];
                    $_SESSION['userId']    = $row['account_id'];
                    $_SESSION['role']      = $row['account_role'];

                    switch ($row['account_role']) {
                        case 'admin':
                            echo "dashboard.php";
                        break;
                        
                        case 'official':
                            echo "registration.php";
                        break;
    
                        case 'cell_leader':
                            $_SESSION['cell_id'] = $row['cell'];
                            echo "cells.php";
                        break;
                        
                        case 'follow_up':
                            $_SESSION['cell_id'] = $row['cell'];
                            echo "follow_up.php";
                        break;
                        default:
                            echo "index.php";                            
                        break;
                    }
                } else {
                    echo 1;
                }
            } else {
                echo 2;
            }
        }
    } else {
        echo 3;
    }
}

// echo "hiihihihihiih";