<?php
    session_start();
    //Database Information
    $db_host = "localhost"; //Host address (most likely localhost)
    $db_name = "onetimetest"; //Name of Database
    $db_user = "root"; //Name of database user
    $db_pass =  "esagu123";; //Password for database user
    
    //Database table names
    $db_user_talbe = "lo"; //User table

    /* Create a new mysqli object with database connection parameters */
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    GLOBAL $mysqli;

    if(mysqli_connect_errno()) {
        echo "Connection Failed: " . mysqli_connect_errno();
        exit();
    }
    
    //Completely sanitizes text
    function sanitize($str)
    {
        return strtolower(strip_tags(trim(($str))));
    }
    //Checks if an email is valid
    function isValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
            echo "Email Id Is Not Valid";
        }
    }
    
    if(!isset($_SESSION['logged']))
        $_SESSION['logged'] = false;
    //Login
    /*
     * login_err
     * 0 -> No error
     * 1 -> Empty fields
     * 2 -> Wrong username or password
     * 3 -> Already logged in
     */
    $login_err = 0;
    if(isset($_POST['login']) && $_POST['login']==1){
        if($_SESSION['logged']){
            $login_err = 3;
            echo "Already Logged In";
        }
        else {
            if(!empty($_POST['username']) && !empty($_POST['password'])){
                $username = sanitize($_POST['username']);
                $password = trim($_POST['password']);
                $sql = $mysqli->prepare("SELECT * FROM ".$db_user_talbe." WHERE username=? LIMIT 1");
                $sql->bind_param('s',$username);
                $sql->execute();
                $sql->store_result();
                $sql->bind_result($id, $username, $email, $passHash);
                $num_returns = $sql->num_rows;
                if($num_returns == 0){
                    $login_err = 2;
                }
                else {
                    
                    while($sql->fetch()){
                        $user=array('id'=>$id, 'username'=>$username, 'password'=>$passHash, 'email'=>$email);
                    }
                    $passHash = md5('shoppers'.$password.sha1($user['email']));
                    if($passHash != $user['password']){
                        $login_err = 2;
                        echo "Wrong Username/Password";
                    }
                    else {
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user'] = $user;
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['logged'] = true;
                       /* if(isset($_SESSION['previous'])) {
                            header("Location: " . $_SESSION['previous']);
                        }
                        else {
                            header("Location:index.php"); */
                    
                        echo "Logged In";
                    }
                }
                $sql->close();
            }
            else {
                $login_err = 1;
                echo "Fill In All The Fields";
            }
        }
    }
    else if(isset($_GET['logout'])){
        if($_SESSION['logged']){
            $_SESSION['username'] = null;
            $_SESSION['user'] = null;
            $_SESSION['id'] = null;
            $_SESSION['logged'] = false;            
            session_destroy();
            echo "Logged Out";
        }
    }
?>
