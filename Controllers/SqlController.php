<?php
    function retrieveLogin($user, $password){
        try{
            $userfound = null;
            
            $config = parse_ini_file('config.ini');
            
            $servername = $config['servername'];
            $username = $config['username'];
            $password = $config['password'];
            $db = $config['dbname'];

            //Create Connection
            $conn = new mysqli($servername, $username, $password, $db);
            if(mysqli_connect_errno()){
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }    
        
            $sql = "SELECT * from users where username = '".$user."'";

            if($result = mysqli_query($conn ,"SELECT * from users where username = '$user'")){
                //output result
                $row = mysqli_fetch_assoc($result);
                
                $userfound = new User($row['firstname'], $row['lastname'], $row['username'], $row['phone'], $row['email'], $row['position']);
                $checkPassword = $row['pass'];
                
                if(hash('sha256', $password) != $checkPassword){
                    $userFound = null;
                }
                
                $result->close();
            }

            $conn->close();

            return $userfound;
        }
        catch(Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
?>