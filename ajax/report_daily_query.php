<?php 
session_start();
require_once("inc/init.php"); 

if (!isset($_SESSION['modernpos_stf_id'])) {
    //header("location: #login.php");
    $_SESSION['modernpos_page'] ="report_daily_cri.php";
    echo "<script>window.location.assign('login.php');</script>";
}
$startdate="";
$enddate="";
if(isset($_GET["startdate"])){
    $startdate = $_GET["startdate"];
}else{
    $startdate = "";
}
if(isset($_GET["finishdate"])){
    $enddate = $_GET["finishdate"];
}else{
    $enddate = "";
}

$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error($conn);
    echo "<script>alert(".mysql_error().");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");
$sql="Select staff_id  "
		."From b_staff "
        ."Where active = '1' and username = '".$username."' and password1 = '".$password."' " ;
$result = mysqli_query($conn,$sql);
if($result){
	while($row = mysqli_fetch_array($result)){
		$stfid = $row["staff_id"];
	}
}

?>

<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <h1 class="page-title txt-color-blueDark">
            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-pencil-square-o"></i>
                    Forms
            <span>
                    Form Layouts
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


<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <h2>รายละเอียด ข้อมูล </h2>				
                </header>
                <div>
                <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                </div>
                    <div class="widget-body no-padding">
                        <form action="" id="smart-form-register" class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label">สาขา</label>
                                        <label class="select" id="goType1">
                                            <select id="cboBranch">
                                                <option value="1">บางนา1</option>
                                                <option value="2">บางนา2</option>
                                                <option value="5">บางนา5</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="branchId" id="branchId" value="<?php echo $brId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">ประจำปี</label>
                                        <label class="select" id="goType1">
                                            <select id="cboYear">
                                                <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="yearId" id="yearId" value="<?php echo $yearId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เดือน</label>
                                        <label class="select" id="goType1">
                                            <select id="cboMonth">
                                                <option value="01">มกราคม</option>
                                                <option value="02">กุมภาพันธ์</option>
                                                <option value="03">มีนาคม</option>
                                                <option value="04">เมษายน</option>
                                                <option value="05">พฤษภาคม</option>
                                                <option value="06">มิถุนายน</option>
                                                <option value="07">กรกฎาคม</option>
                                                <option value="08">สิงหาคม</option>
                                                <option value="09">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="monthId" id="monthId" value="<?php echo $monthId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">งวด</label>
                                        <label class="select" id="goType1">
                                            <select id="cboPeriod">
                                                <option value="1">งวดต้นเดือน</option>
                                                <option value="2">งวดสิ้นเดือน</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="periodId" id="periodId" value="<?php echo $periodId;?>">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-4">
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="label">จำนวนข้อมูล</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reDesc" id="reDesc" value="<?php echo $cnt;?>" placeholder="จำนวนข้อมูล"></label>
                                                <label class="label">จำนวนข้อมูล Excel</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reExcel" id="reExcel" value="<?php echo $excelCnt;?>" placeholder="จำนวนข้อมูล"></label>
                                            </section>
                                            <section class="col col-6">
                                                <label class="label">จำนวนคนไข้</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reCntHn" id="reCntHn" value="<?php echo $cntHn;?>" placeholder="จำนวนคนไข้"></label>
                                            </section>
                                        </div>
                                        <div class="row" id="divSendEmail">
                                            <section class="col col-10">
                                                <label class="label">TO</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailTO" id="reEmailTO" value="<?php echo $labEmailTo;?>" placeholder="TO"></label>
                                                <label class="label">FROM</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailFrom" id="reEmailFrom" value="<?php echo $labEmailFrom;?>" placeholder="FROM"></label>
                                                    
                                                <label class="label">Subject</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailSubject" id="reEmailSubject" value="<?php echo $labEmailSubject;?>" placeholder="Subject"></label>
                                                    
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <button type="button" id="btnComposeEmail" class="btn btn-primary btn-sm">compose email</button>
                                                <div id="divView"></div>
                                            </section>
                                        </div>
                                    </section>
                                                                        
                                    <section class="col col-8">
                                        <table id="dt_basic" class="table table-striped table-bordered table-hover responsive" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-class="expand" width="40%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สิทธิการรักษา</th>
                                                    <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>จำนวน</th>
                                                    <th data-class="expand" width="20%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>มูลค่า</th>
                                                    <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ส่วนลด</th>
                                                    <th data-class="expand" width="20%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สุทธิ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $trPaid;?>
                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <div class="row">
                                    <section class="col col-2">    
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkReVoid" checked="true" id="chkReVoid"><i data-swchon-text="ใช้งาน" data-swchoff-text=" ยกเลิก"></i>สถานะ</label>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnReVoid" class="btn btn-primary btn-sm">ต้องการยกเลิก</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSave" class="btn btn-primary btn-sm">เปลี่ยนแปลง เดือนปี ข้อมูล</button>
                                    </section>
                                    <section class="col col-2" >
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSaveSum" class="btn btn-primary btn-sm">แก้ไข ข้อมูล</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnPrint" class="btn btn-primary btn-sm">Print</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnPrintDetail" class="btn btn-primary btn-sm">Print รายละเอียด</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSendEmail" class="btn btn-primary btn-sm">ส่ง email แจ้งยอด</button>
                                    </section>
                                    <section class="col col-2 ">
                                        <ul class="demo-btns">
                                            <li id="uiLoading">
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                    <div class="alert alert-block alert-success col col-5"  id="compAlert">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
                                        <p id="compVali">
                                                You may also check the form validation by clicking on the form action button. Please try and see the results below!
                                        </p>
                                    </div>
                                </div>

                            </footer>
                        </form>
                    </div>
                    <div class="widget-body no-padding">
                        
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<script type="text/javascript">
	
	pageSetUp();
	loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>