<?php 
session_start();
require_once("inc/init.php"); 

if (!isset($_SESSION['modernpos_stf_id'])) {
    //header("location: #login.php");
    $_SESSION['modernpos_page'] ="report_daily_cri.php";
    echo "<script>window.location.assign('login.php');</script>";
}
$chkDailyCheck="";
$chkSummaryCheck="";
$txtstartdate="";
$txtfinishdate="";
$txtstartdate1="";
$txtfinishdate1="";
$tr="";
$sql="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");

if(!empty($_GET["startdate"])){
    $txtstartdate1=$_GET["startdate"];
    $txtstartdate=substr($_GET["startdate"],strlen($_GET["startdate"])-4)."-".substr($_GET["startdate"],3,2)."-".substr($_GET["startdate"],0,2);
}
if(!empty($_GET["finishdate"])){
    $txtfinishdate1=$_GET["finishdate"];
    $txtfinishdate=substr($_GET["finishdate"],strlen($_GET["finishdate"])-4)."-".substr($_GET["finishdate"],3,2)."-".substr($_GET["finishdate"],0,2);
}
$statusreport="";
if(!empty($_GET["radio1"]) && $_GET["radio1"]==="daily"){
	$chkDailyCheck="checked='checked'";
	$sql="Select bil.bill_date, foocat.foods_cat_name, sum(bild.amount) as amount "
		."From t_bill bil "
		."Left Join t_bill_detail bild on bil.bill_id = bild.bill_id  "
		."Left Join b_foods foo on foo.foods_id = bild.foods_id "
		."Left Join b_foods_category foocat on foo.foods_cat_id = foocat.foods_cat_id "
		."Where bil.active = '1' and bill_date >= '".$txtstartdate."' and bill_date <= '".$txtfinishdate."' "
		."Group By bil.bill_date, footype.foods_type_name";
	$statusreport="daily";
}else{
	$chkSummaryCheck="checked='checked'";
	$sql="Select bil.bill_date, sum(bild.amount) as amount "
		."From t_bill bil "
		."Left Join t_bill_detail bild on bil.bill_id = bild.bill_id  "
		."Left Join b_foods foo on foo.foods_id = bild.foods_id "
		."Left Join b_foods_category foocat on foo.foods_cat_id = foocat.foods_cat_id "
		."Where bil.active = '1' and bill_date >= '".$txtstartdate."' and bill_date <= '".$txtfinishdate."' "
		."Group By bil.bill_date";
	$statusreport="sum";
}
//echo $sql;
$bilDate="";
$fooName="";
$amt="";
// echo $statusreport;
if ($rComp=mysqli_query($conn,$sql)){
	while($aRec = mysqli_fetch_array($rComp)){
		//$reRecId = $aRec["rec_id"];
		$bilDate = $aRec["bill_date"];
		$bilDate = substr($bilDate,strlen($bilDate)-2)."-".substr($bilDate,5,2)."-".substr($bilDate,0,4);
		$amt = $aRec["amount"];
		if($statusreport=="daily") {
			$fooName = $aRec["foods_cat_name"];
			$tr .= "<tr><td>".$bilDate."</td><td>".$fooName."</td><td>".$amt."</td></tr>";
		}
		else{
			$fooName = '';
			$tr .= "<tr><td>".$bilDate."</td><td>".$amt."</td></tr>";
		}
	}
}

mysqli_close($conn);
?>
<form action="" id="smart-form-register" class="smart-form" method="GET">
    <div class="row">
        <div class="col col-3">&nbsp;
            
        </div>
        <div class="col col-2">
            <label class="label">วันที่</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="startdate" id="startdate" value="<?php echo $txtstartdate1?>" placeholder="วันที่" class="datepicker" data-date-format="dd/mm/yyyy">

        </div>
        <div class="col col-2">
            <label class="label">ถึงวันที่</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="finishdate" id="finishdate" value="<?php echo $txtfinishdate1?>" placeholder="ถึงวันที่" class="datepicker" data-date-format="dd/mm/yyyy">
        </div>
        <div class="col col-2">
            <label class="radio">
                <input type="radio" name="radio1" id="chkDaily" <?php echo $chkDailyCheck;?> value="daily">
                    <i></i>ประจำวัน</label>
            <label class="radio">
                <input type="radio" name="radio1" id="chkSummary" <?php echo $chkSummaryCheck;?> value="summary">
                    <i></i>สรุป</label>
        </div>
        <div class="col col-2">
            <label class="label">&nbsp;&nbsp;</label>
            <button type="button" class="btn btn-primary btn-lg btn-primary" id="btnSearch">ค้นหา :</button>
            
        </div>
        <div class="col col-1">
            <label class="label">&nbsp;&nbsp;</label>
            <ul class="demo-btns">
                <li id="uiLoading">
                    <a href="javascript:void(0);" class="btn btn-sm bg-color-blueDark txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
</form>
<div class="content"></div>
<section id="widget-grid" class="">
    
    
    
    <div class="row">
         <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
            
             <!-- Widget ID (each widget will need unique ID)-->
             <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
                
                 <header>
                    <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                    <h2>Column Filters </h2>
                </header>
                 <!-- widget div-->
                 <div>
                     <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <table id="datatable_tabletools" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                <th data-class="expand">วันที่</th>
                                <?php if ($statusreport=="daily") {?> <th data-hide="phone, tablet">ชื่อรายการ</th> <?php }?>
                                <th data-hide="phone,tablet">มูลค่า</th>
                                
                                </tr>
                            </thead>
                            <tbody><?php echo $tr;?></tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

		
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
	var pagefunction = function() {
		/* BASIC ;*/
			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};
                        $('#dt_basic').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

		/* END BASIC */
		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column').DataTable({
	    	//"bFilter": false,
	    	//"bInfo": false,
	    	//"bLengthChange": false
	    	//"bAutoWidth": false,
	    	//"bPaginate": false,
	    	//"bStateSave": true // saves sort state using localStorage
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}		
		
	    });
	    
	    // custom toolbar
	    //$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    	   
	    // Apply the filter
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
	    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    } );
	    /* END COLUMN FILTER */
	    /* TABLETOOLS */
		$('#datatable_tabletools').dataTable({
			
			// Tabletools options: 
			//   https://datatables.net/extensions/tabletools/button_options
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
	        "oTableTools": {
	        	 "aButtons": [
	             "copy",
	             "csv",
	             "xls",
	                {
	                    "sExtends": "pdf",
	                    "sTitle": "SmartAdmin_PDF",
	                    "sPdfMessage": "SmartAdmin PDF Export",
	                    "sPdfSize": "letter"
	                },
	             	{
                    	"sExtends": "print",
                    	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                	}
	             ],
	            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
	        },
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_tabletools) {
					responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_tabletools.respond();
			}
		});
		
		/* END TABLETOOLS */
	}
	
	$("#chkvalidation").attr("hidden",true);
	// PAGE RELATED SCRIPTS

	// pagefunction	

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
		
	
	$("#btnSearch").click(submitForm);
	$("#uiLoading").hide();
    //$("#btnSearch").click(submitRecDaily);
	// end pagefunction
	
	// Load form valisation dependency 
	loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                    });
                });
            });
	});
	function submitForm(){
//            alert("aaaa");
        $("#smart-form-register").submit();
    }
</script>
