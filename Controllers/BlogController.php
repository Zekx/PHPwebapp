<?php
    if (!isset($_SESSION)) { session_start();}
    require_once('../Models/Post.php');
    require_once('../Models/User.php');
    require_once('SqlController.php');
    
    //retrieves posts from the server.
    function getPosts(){
        try{
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

    function createPost(){
        if(!isset($_POST['topic']) && !isset($_POST['body'])){
            exit;
        }
        
        echo json_encode(array("topic"=>$_POST['topic'], "body"=>$_POST['body']));
    }

    function login(){
        //Check if the username and password have been given.
        if(!isset($_POST['username']) || $_POST['username'] == null){
            header("Location: {$_SERVER['HTTP_REFERER']}");
            
            $_SESSION['error'] = "Form is incomplete!";
            exit;
        }
        if(!isset($_POST['password']) || $_POST['password'] == null){
            header("Location: {$_SERVER['HTTP_REFERER']}");
            
            $_SESSION['error'] = "Form is incomplete!";
            exit;
        }
        
        $user = retrieveLogin($_POST['username'], $_POST['password']);
        if($user != null){
            echo "User found... welcome " . $user->firstname . " " . $user->lastname . ".";
            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
            $_SESSION["user"] = $user->username;
            $_SESSION["logged"] = true;
            
            header("Location:" . ' http://localhost/index.php');
            exit;
        }
        else{
            header("Location: {$_SERVER['HTTP_REFERER']}");
            $_SESSION['error'] = "Username or password is incorrect!";
            exit;
        }
    }

    function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['logged']);
        
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    if(isset($_POST['action']) && !empty($_POST['action'])){
        $action = $_POST['action'];
        switch($action){
            case 'getPosts' : getPosts(); break;
            case 'login' : login(); break;  
            case 'logout' : logout(); break;
            case 'createPost' : createPost(); break;
        }
    }
?>