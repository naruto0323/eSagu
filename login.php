<?php
include('config.php');
//include "common.php";
//include_once "fbconnect.php";
?>

<!DOCTYPE html>
<body>

<!--Header-->
<header >
    <div >
        <div >
            <a id="logo"  href="index.php"></a>
            <div >
                <ul class="nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="howitworks.php">How it Works? </a></li>
                    <li><a href="contact-us.php">Contact</a></li>
                </ul>
                    <?php
                    if($_SESSION['logged']===true){
                        ?>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<i ></i></a>
                            <ul >

                                <center>Hello,<?php echo $_SESSION['username'];?></center>

                                <li>
                                    <a href="transactions.php">Ask problem</a>
                                </li>
                                <li>
                                    <a href="myorders.php">Previous Advices</a>
                                </li>
                                <li>
                                    <a href="changedetails.php">Change Profile</a>
                                </li>
                                <li>
                                    <a href="referraldata.php">Available crop solution</a>
                                </li>
                                <li class="divider"></li>
                                
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


                
<section id="registration-page" class="container">
    <?php if($_SESSION['logged']===true)
    { ?>
        <center>
        <h2><?php echo $_SESSION['username']; ?>,You are already Logged In !!! </h2>
        <br>
        <form>
            <button name="logout" type="submit" method="get" class="btn btn-primary">Log Out</button><br>
        </form>
        </center>
    <?php } else { ?>

    <form class="center" action="" method="post" >
        <fieldset class="registration-form">
        <input type="text" class="input-xlarge" id="username" name="username" placeholder="Username">
        <br><br><br>
        <input type="password" class="input-xlarge" id="password" name="password" placeholder="Password">
        <input type="hidden" class="input-small" id="login" name="login" value='1'>
        <!--label class="checkbox">
            <input type="checkbox"> Remember me
        </label--><br><br><br>
        <button type="submit" class="btn btn-primary">Sign in</button><br>
            </fieldset>

    </form>
    <center>
        <a href="forgot.php" target="_blank">Forgot your password ?</a>
    </center>
    <?php } ?>
<div class="center">
  

</section>


</body>
</html>