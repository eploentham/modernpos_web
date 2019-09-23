<?php 
session_start();
require_once("inc/init.php"); 

if (!isset($_SESSION['modernpos_stf_id'])) {
    //header("location: #login.php");
    $_SESSION['modernpos_page'] ="report_daily_cri.php";
    echo "<script>window.location.assign('login.php');</script>";
}

?>

<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-pencil-square-o"></i> 
				รายงาน
			<span>>  
				รายงานประจำวัน
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
		<!-- Button trigger modal -->
		<a href="ajax/modal-content/model-content-2.html" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Launch form modal
		</a>
		
		<!-- MODAL PLACE HOLDER -->
		<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<!-- END MODAL -->
		
	</div>
</div>

<div class="alert alert-block alert-success" id="chkvalidation">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p>
		You may also check the form validation by clicking on the form action button. Please try and see the results below!
	</p>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">


	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">
			
			<!-- Widget ID (each widget will need unique ID)-->
			
			<!-- end widget -->
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>ระบุวันที่</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form action="" id="order-form" class="smart-form" novalidate="novalidate">
							<header>
								Order services
							</header>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="startdate" id="startdate" placeholder="Expected start date">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="finishdate" id="finishdate" placeholder="Expected finish date">
										</label>
									</section>
								</div>
							</fieldset>
							<footer>
								<button type="button" class="btn btn-primary" id="btnOk">
									ดึงข้อมูล
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->				

		</article>
		<!-- END COL -->

		<!-- NEW COL START -->
		
		<!-- END COL -->		

	</div>

	<!-- END ROW -->

</section>
<!-- end widget grid -->

		
<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	$("#chkvalidation").attr("hidden",true);
	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var pagefunction = function() {

		var $checkoutForm = $('#checkout-form').validate({
		// Rules for form validation
			rules : {
				fname : {
					required : true
				},
				lname : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				phone : {
					required : true
				},
				country : {
					required : true
				},
				city : {
					required : true
				},
				code : {
					required : true,
					digits : true
				},
				address : {
					required : true
				},
				name : {
					required : true
				},
				card : {
					required : true,
					creditcard : true
				},
				cvv : {
					required : true,
					digits : true
				},
				month : {
					required : true
				},
				year : {
					required : true,
					digits : true
				}
			},
	
			// Messages for form validation
			messages : {
				fname : {
					required : 'Please enter your first name'
				},
				lname : {
					required : 'Please enter your last name'
				},
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				phone : {
					required : 'Please enter your phone number'
				},
				country : {
					required : 'Please select your country'
				},
				city : {
					required : 'Please enter your city'
				},
				code : {
					required : 'Please enter code',
					digits : 'Digits only please'
				},
				address : {
					required : 'Please enter your full address'
				},
				name : {
					required : 'Please enter name on your card'
				},
				card : {
					required : 'Please enter your card number'
				},
				cvv : {
					required : 'Enter CVV2',
					digits : 'Digits only'
				},
				month : {
					required : 'Select month'
				},
				year : {
					required : 'Enter year',
					digits : 'Digits only please'
				}
			},
	
			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
				
		var $registerForm = $("#smart-form-register").validate({

			// Rules for form validation
			rules : {
				username : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
				passwordConfirm : {
					required : true,
					minlength : 3,
					maxlength : 20,
					equalTo : '#password'
				},
				firstname : {
					required : true
				},
				lastname : {
					required : true
				},
				gender : {
					required : true
				},
				terms : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				login : {
					required : 'Please enter your login'
				},
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				password : {
					required : 'Please enter your password'
				},
				passwordConfirm : {
					required : 'Please enter your password one more time',
					equalTo : 'Please enter the same password as above'
				},
				firstname : {
					required : 'Please select your first name'
				},
				lastname : {
					required : 'Please select your last name'
				},
				gender : {
					required : 'Please select your gender'
				},
				terms : {
					required : 'You must agree with Terms and Conditions'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		var $reviewForm = $("#review-form").validate({
			// Rules for form validation
			rules : {
				name : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				review : {
					required : true,
					minlength : 20
				},
				quality : {
					required : true
				},
				reliability : {
					required : true
				},
				overall : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				name : {
					required : 'Please enter your name'
				},
				email : {
					required : 'Please enter your email address',
					email : '<i class="fa fa-warning"></i><strong>Please enter a VALID email addres</strong>'
				},
				review : {
					required : 'Please enter your review'
				},
				quality : {
					required : 'Please rate quality of the product'
				},
				reliability : {
					required : 'Please rate reliability of the product'
				},
				overall : {
					required : 'Please rate the product'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		
		var $commentForm = $("#comment-form").validate({
			// Rules for form validation
			rules : {
				name : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				url : {
					url : true
				},
				comment : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				name : {
					required : 'Enter your name',
				},
				email : {
					required : 'Enter your email address',
					email : 'Enter a VALID email'
				},
				url : {
					email : 'Enter a VALID url'
				},
				comment : {
					required : 'Please enter your comment'
				}
			},

			// Ajax form submition
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {
						$("#comment-form").addClass('submited');
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		var $contactForm = $("#contact-form").validate({
			// Rules for form validation
			rules : {
				name : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				message : {
					required : true,
					minlength : 10
				}
			},

			// Messages for form validation
			messages : {
				name : {
					required : 'Please enter your name',
				},
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				message : {
					required : 'Please enter your message'
				}
			},

			// Ajax form submition
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {
						$("#contact-form").addClass('submited');
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		var $orderForm = $("#order-form").validate({
			// Rules for form validation
			rules : {
				name : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				phone : {
					required : true
				},
				interested : {
					required : true
				},
				budget : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				name : {
					required : 'Please enter your name'
				},
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				phone : {
					required : 'Please enter your phone number'
				},
				interested : {
					required : 'Please select interested service'
				},
				budget : {
					required : 'Please select your budget'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		// START AND FINISH DATE
		$('#startdate').datepicker({
			dateFormat : 'dd.mm.yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
			}
		});
		
		$('#finishdate').datepicker({
			dateFormat : 'dd.mm.yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#startdate').datepicker('option', 'maxDate', selectedDate);
			}
		});
		
	};
	$("#btnOk").click(submitForm);
	// end pagefunction
	
	// Load form valisation dependency 
	loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
	function submitForm(){
//            alert("aaaa");
        window.location.assign('#ajax/report_daily_query.php?startdate='+$("#startdate").val()+'&finishdate='+$("#finishdate").val());
    }
</script>
