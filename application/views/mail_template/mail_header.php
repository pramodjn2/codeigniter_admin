<?php
$websetting = $this->session->userdata('websetting');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php if(isset($title)){echo $title;} ?></title>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
}
.red_button {
	background-color: #428BCA;
	border: medium none !important;
	border-radius: 5px;
	color: #fff;
	padding: 8px 20px;
	cursor: pointer;
}
.clear {
	clear: both;
}
.circle-img {
	border-radius: 100% 100% 100% 100%;
	width: 100%;
}
table tr{border:none;}
tbody td{border:none;}
</style>
</head>

<body>
<div style="width:100%; margin:0 auto; background-color:#f1f1f1; font:300 14px 'Roboto'; padding:30px 0px;">
	<div style="width:80%; margin:0 auto;">
    	<div style="width:100%; margin:0 auto; background-color:#428BCA; padding:10px 5px;">
        	<a href="<?php echo base_url(); ?>">
            	<?php 
		        $email_logo = image_check($websetting['site_logo'],SITE_LOGO);
				?>
            	<img src="<?=$email_logo;?>" alt="<?=$websetting['site_name'];?>" height="26px" width="46px">
            </a>
        </div>
        
<div style="width:100%; margin:0 auto; background-color:#fff; padding:10px 5px; border:1px solid #ccc;">