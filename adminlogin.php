<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
 //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {

$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">ADMIN LOGIN FORM</h4>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Username</label>
<input class="form-control" type="text" name="username" autocomplete="off" required />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required />
</div>
 <div class="form-group">
<label>Verification code : </label>
<input type="text"  name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />&nbsp;<img src="captcha.php">
</div>  

 <button type="submit" name="login" class="btn btn-info">LOGIN </button>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</script>
</body>
</html>
