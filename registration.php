 <?php
    include('config.php');

$number1 = rand(0,5);
$number2 = rand(0,5);

    /*
     * err_code
     * 0 -> No errors
     * 1 -> Empty fields
     * 2 -> Email is invalid
     * 3 -> Passwrd mismatch
     * 4 -> Username is use
     * 5 -> Check() wrong
     */
    $err_code = 0;
    if( isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['password_confirm']) || isset($_POST['answer'])  ){
        if( !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['password_confirm']) || !isset($_POST['answer']) ) {
            echo "Please Fill In All The Fields";
        }
        else if( !isValidEmail(sanitize($_POST['email'])) ){
            $err_code = 2;
            echo "Email Id Is Not Valid";
        }
        else if( $_POST['password_confirm'] != $_POST['password'] ){
            $err_code = 3;
            echo "Password Not Matched";
        }
        else if($_POST["answer"] != $_POST['solution'] ){
            $err_code = 5;
            echo "Check Your Mathematical Operation";
        }
        else {
            $username = sanitize($_POST['username']);
            $email = sanitize($_POST['email']);
            $password = trim($_POST['password']);
            $sql = $mysqli->prepare("SELECT * FROM ".$db_user_talbe." WHERE username=? LIMIT 1");
            $sql->bind_param('s',$username);
            $sql->execute();
            $sql->store_result();
            $num_returns = $sql->num_rows;
            $sql->close();
            echo $num_returns;
            if( $num_returns > 0){
                $err_code = 4;
                echo "Username Is Already In Use";
            }
            else {
                //Everything is fine, insert user
                $passHash = md5('shoppers'.$password.sha1($email));
                
                $sql = $mysqli->prepare("INSERT INTO ".$db_user_talbe." (
                username,
                email_id,
                password
                )
                VALUES (
                ?,
                ?,
                ?
                )");

                $sql->bind_param('sss',$username,$email,$passHash);
                $sql->execute();

                $inserted_id = $mysqli->insert_id;
                $sql->close();
                echo "Registered Successfully :)";
            }
        }
    }
?>
<!DOCTYPE html>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}

a {
    display: block;
    width: 60px;
    background-color: #dddddd;
}
</style>
<body>



  <!--Header-->
  <header >
    <div >
      <div >
        
        <div >
          <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="about-us.php">About Us</a></li>
              <li><a href="howitworks.php">How&nbspIt&nbspWorks? </a></li>
              <li><a href="contact-us.php">Contact</a></li>
              <?php
              if($_SESSION['logged']===true){
                  ?>
                  <li class="dropdown">

                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">

                          <center>Hello,<?php echo $_SESSION['username'];?></center>

                          <li>
                              <a href="main/mytransactions.php">My Transactions</a>
                          </li>
                          <li>
                              <a href="main/myorders.php">My Orders</a>
                          </li>
                          <li>
                              <a href="main/changedetails.php">Change Account Details</a>
                          </li>
                          <li>
                              <a href="main/referraldata.php">My Referral Data</a>
                          </li>
                          <li class="divider"></li>
                          <li>
                              <center>
                                  <form>
                                      <button name="logout" type="submit" method="get" class="btn btn-primary">Log Out</button><br>
                                  </form>
                              </center>
                          </li>
                      </ul>
                  </li>

              <?php } else{ ?>
                  <li><a href="registration.php">Register</a> </li>
                  <li class="login">
                      <a  href="login.php"><i class="icon-lock"></i>Login</a>
                  </li>
              <?php } ?>
          </ul>        
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </header>
  <!-- /header -->


  
          
        
 
  <section id="registration-page" >
    <form class="center" action='' method="POST">
      <fieldset class="registration-form">
        <div class="control-group">
          <!-- Username -->
          <div class="controls">
            username : <input type="text" id="username" name="username" placeholder="Username" class="input-xlarge" required="required">
          </div>
        </div>

        <div class="control-group">
          <!-- E-mail -->
          <div class="controls">
           email:   <input type="text" id="email" name="email" placeholder="E-mail" class="input-xlarge" required="required">
          </div>
        </div>

        <div class="control-group">
          <!-- Password-->
          <div class="controls">
            password:<input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" required="required">
          </div>
        </div>

        <div class="control-group">
          <!-- Password -->
          <div class="controls">
            confirm password:<input type="password" id="password_confirm" name="password_confirm" placeholder="Password (Confirm)" class="input-xlarge" required="required">
          </div>
        </div >
          <div class="control-group">
              <!-- CheckSum -->
              <div class="controls">
                  <?php
                  $number1 = rand(0,5);
                  $number2 = rand(0,5);

                  switch(rand(0,2)) {
                  case 0:
                  $solution = $number1 + $number2;
                  echo "<h3>$number1+$number2=?</h3>";
                  break;
                  case 1:
                  $solution = $number1 - $number2;
                  echo "<h3>$number1-$number2=?</h3>";
                  break;
                  case 2:
                  $solution = $number1 * $number2;
                  echo "<h3>$number1*$number2 = ?</h3>";
                  break;
                  }
                  ?>
                  <h4>Your Answer:</h4><br><input type="integer" name="answer" class="input-xlarge" required="required" >
                  <input type="hidden" name="solution" value="<?php echo $solution; ?>">
              </div>
          </div>
         <br>

        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button class="btn btn-success btn-large btn-block">Register</button>
          </div>
        </div>
     </fieldset>
    </form>
  </section>


</body>
</html>
