<?php

//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_blank",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)

*/
$page_nav = array(
	"dashboard" => array(
		"title" => "Dashboard",
		"icon" => "fa-home",
		"sub" => array(
			"analytics" => array(
				"title" => "Analytics Dashboard",
				"url" => "ajax/dashboard.php"
			),
			"social" => array(
				"title" => "Social Wall",
				"url" => "ajax/dashboard-social.php"
			)
		)
	),
	"report" => array(
		"title" => "รายงาน",
		"icon" => "fa-code",
		"sub" => array(
			"repordaily" => array(
				'title' => 'รายงานประจำวัน',
				'icon' => 'fa-folder-open',
				'sub' => array(
					'rptdailybill' => array(
						'title' => 'ยอดขายประจำวัน',
						'url' => "ajax/report_daily_cri.php"
					),
					'rptdailytype' => array(
						'title' => 'ยอดขาย ตามประเภท',
						'url' => 'ajax/report_daily_cri_type.php'
					),
					'rptdailycategory' => array(
						'title' => 'ยอดขาย ตามกลุ่ม',
						'url' => 'ajax/report_daily_cri_cat.php'
					),
					'rptdailytopping' => array(
						'title' => 'ยอดขาย ตามTopping',
						'url' => 'ajax/report_daily_cri_topping.php'
					),
					'rptdailytimeperiod' => array(
						'title' => 'ยอดขาย ตามช่วงเวลา',
						'url' => 'ajax/report_daily_cri_timeperiod.php'
					),
					'rptdailycloseday' => array(
						'title' => 'ยอดขาย ปิดวัน',
						'url' => 'ajax/report_daily_cri_closeday.php'
					)
				)
			),
			"reportmonthly" => array(
				"title" => "รายงานประจำเดือน",
				"url" => 'ajax/smartui-carousel.php'
			),
			"reportyearly" => array(
				"title" => "รายงานประจำปี",
				"url" => 'ajax/smartui-tab.php'
			)
		)
	)
	
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>