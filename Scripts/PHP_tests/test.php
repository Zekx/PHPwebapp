<?php
    require_once('../../Models/Post.php');
    require_once('../../Models/User.php');
    include('../../Controllers/SqlController.php');
    
    //retrieves posts from the server.
    function getPosts(){
        try{
            $servername = "localhost";
            $username = "root";
            $password = "Silver50";
            $db = "bung";

            //Create Connection
            $conn = new mysqli($servername, $username, $password, $db);
            if(mysqli_connect_errno()){
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }    
        
            $data[] = []; 
            $counter = 0;
            $sql = "select p.*, u.firstname, u.lastname from posts p, users u where p.userid = (select id from users where username = 'bung')";

            if($result = $conn->query($sql)){
                //output result
                while($row = mysqli_fetch_assoc($result)){    
                    $data[$counter] = new Post($row['id'], $row['firstname'] . " " . $row['lastname'], $row['title'], $row['body'], $row['datePosted'], $row['removed']);
                    
                    $counter++;
                }
                
                $result->close();
            }

            $conn->close();

            echo json_encode($data);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    function login(){
        //Check if the username and password have been given.
        $username = "bung";
        $password = "Silver50";

        $user = retrieveLogin($username, $password);
        if($user != null){
            echo "User found... welcome " . $user->firstname . " " . $user->lastname . ".";
            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
            $_SESSION["user"] = $user;
            
            header("Location:" . 'http://localhost/index.php');
            exit;
        }
        else{
            $_SESSION['error'] = "Username or password is incorrect!";
            exit;
        }
    }

    if(isset($_POST['action']) && !empty($_POST['action'])){
        $action = $_POST['action'];
        switch($action){
            case 'getPosts' : getPosts(); break;
            case 'login' : login(); break;  
        }
    }

    login();
?>