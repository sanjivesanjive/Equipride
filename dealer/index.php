<?php
include '../connection.php';

// include "../config.php";

if(isset($_GET["code"]))
  {
    $token=$client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $client->setAccessToken($token['access_token']);
    
    $obj=new Google_Service_Oauth2($client);
    $data=$obj->userinfo->get();
    if(!empty($data->email)&&!empty($data->name)){
      
      
        $_SESSION["name"]=$data->name;
           
      $_SESSION["email"]=$data->email;
        header("location:register.php");
      }
  
  }

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // echo "SELECT * FROM `admin` where (`username`='$email' and `password`='$pass') AND `type`='user'";
    // die();
    $author = mysqli_query($con, "SELECT * FROM `admin` WHERE (`email`='$email' and `password`='$pass') and `type`='dealer'") or die("error");
    $a = mysqli_num_rows($author);
    if ($a == '1') {
        $au_1 = mysqli_fetch_array($author);
        $author_id = $au_1['userid'];
        $close = $au_1['status'];
        if ($close == '0') {
            ?>
            <script type="text/javascript">
                alert("Your Login Has Temporarily Closed! Contact Admin...!");
            </script>
            <?php
        } else {
            $_SESSION['admin_id'] = $author_id;
            // $_SESSION['tech_id']=$author_id;
            ?>
            <script type="text/javascript">
                // alert("Welcome <?php echo $au_1['userid']; ?> - Admin!");
                window.location = "dealer_panal.php";
            </script>
            <?php

        }
    } else {
        ?>
        <script type="text/javascript">
            alert("username and password missmatched");
        </script>
        <?php
    }

}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        <?php echo $title ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" type="image/png" sizes="32x32" href="images/Logo editted.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/Logo editted.png">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.login-block{
    background: #DE6262;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
float:left;
width:100%;
padding : 50px 0;
}
.banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}
</style>
</head>

<!-- <body class="img js-fullheight" style="background-image: url(images/2000x1333.jpg);"> -->
<body >
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
		    <form class="login-form" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="email" class="form-control" name="email" required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" class="form-control" name="password" required >
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" name="login" class="btn btn-login float-right">Submit</button>
  </div>
  
</form>
<!-- <div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="http://grafreez.com">Grafreez.com</a></div> -->
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="images/Equipride132.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Dealer Login</h2>
        </div>	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="images/Equipride2.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Welcome Dealer</h2>
        </div>	
    </div>
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>
</body>
</body>

</html>