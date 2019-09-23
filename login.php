<?php
session_start();
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");

$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error($conn);
    echo "<script>alert(".mysql_error().");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");

$username="";
$password="";
$stfid="";
$page="";
if(isset($_GET["txtusername"])){
    $username = $_GET["txtusername"];
}else{
    $username = "";
}
if(isset($_GET["txtpassword"])){
    $password = $_GET["txtpassword"];
}else{
    $password = "";
}
$sql="Select staff_id  "
		."From b_staff "
        ."Where active = '1' and username = '".$username."' and password1 = '".$password."' " ;
$result = mysqli_query($conn,$sql);
if($result){
	while($row = mysqli_fetch_array($result)){
		$stfid = $row["staff_id"];
	}
}
if (isset($_SESSION['modernpos_page'])) {
	$page = $_SESSION['modernpos_page'];
}

if($stfid !=""){
	$_SESSION['modernpos_stf_id'] = $stfid;
	if($page === ""){
		echo "<script>window.location.assign('index.php');</script>";
	}else{
		echo "<script>window.location.assign('".$page."');</script>";
	}
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo_modernpos.jpg" alt="ModernPOS"> </span>

		<!-- END AJAX-DROPDOWN -->
	</div>

	<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> <a href="<?php echo APP_URL; ?>/register.php" class="btn btn-danger">Creat account</a> </span>

</header>

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				<h1 class="txt-color-red login-header-big">Modern POS</h1>
				<div class="hero">

					<div class="pull-left login-desc-box-l">
						<h4 class="paragraph-header">It's POS application. Experience the simplicity of Modern POS, everywhere you go!</h4>
						
					</div>
					
					<!--<img src="<?php echo ASSETS_URL; ?>/img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">-->

				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">About Modern POS - Are you up to date?</h5>
						<p>
							Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">Not just your average template!</h5>
						<p>
							Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi voluptatem accusantium!
						</p>
					</div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
					<form action="<?php echo APP_URL; ?>" id="login-form" class="smart-form client-form">
						<header>
							Sign In
						</header>

						<fieldset>
							
							<section>
								<label class="label">User Name</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="username" name="txtusername" id="txtusername">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username </b></label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="txtpassword" id="txtpassword">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note">
									<a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
								</div>
							</section>

							<section>
								<label class="checkbox">
									<input type="checkbox" name="remember" checked="">
									<i></i>Stay signed in</label>
							</section>
						</fieldset>
						<footer>
							<button type="button" class="btn btn-primary" id = "btnLogin" name = "btnLogin">
								Sign in
							</button>
						</footer>
					</form>

				</div>
				
				<h5 class="text-center"> - Or sign in using -</h5>
													
								<ul class="list-inline text-center">
									<li>
										<a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
									</li>
									<li>
										<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
				
			</div>
		</div>
	</div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	//alert("aaaa");
	$("#btnLogin").click(submitLogin);
	//$("#btnLogin").click(submitLogin);
		function submitLogin() {
			//alert("aaaa");
        	window.location.assign('#login.php?txtusername='+$("#txtusername").val()+'&txtpassword='+$("#txtpassword").val());
		};
    	//alert("bbbb");
	//runAllForms();
//alert("bbbb");
	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				txtusername : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				txtpassword : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				txtpassword : {
					required : 'Please enter your password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		
	});
	
	
</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>