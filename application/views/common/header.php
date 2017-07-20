<!DOCTYPE html>
<html lang="en">
<head>

<?php
$websetting = $this->session->userdata('websetting');


if(empty($title) && !empty($websetting)){
	$title =  $websetting['meta_title'];
}
if(empty($keywords) && !empty($websetting)){
	$keywords =  $websetting['meta_keywords'];
}
if(empty($description) && !empty($websetting)){
	$description =  $websetting['meta_description'];
}


if(empty($og_title)){
	$og_title =  $websetting['meta_title'];
}
if(empty($og_description)){
	$og_description =  $websetting['meta_description'];
}
if(empty($og_image)){
	$og_image =   base_url('assets/images/header-logo.png');
}

?>

<title><?=$title?></title>
<meta name="description" content="<?=$keywords?>"/>
<meta name="keywords" content="<?=$description?>"/>


<meta property="og:locale" content="en_GB" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo base_url(); ?>" />
<meta property="og:site_name" content="<?php echo $websetting['site_name']; ?>" />
<meta property="og:title" content="<?=$og_title; ?>" />
<meta property="og:image" content="<?=$og_image; ?>" />
<meta property="og:description" content="<?=$og_description; ?>" />



  


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="canonical" href="<?php echo base_url(); ?>" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/icons/fontawesome/css/font-awesome.css'); ?>">
    
    
    <!-- Related css to this page -->	
		 <?php
        	if(isset($stylesheet) && !empty($stylesheet)){
				$i=0;
				foreach($stylesheet as $value){$i++;								
					$tab = ($i!=1)?"\t\t ":"";
					echo $tab.'<link rel="stylesheet" href="'.$this->config->item('site_url').$value.'">'."\n";
				}
			}
			if(isset($style) && !empty($style)){
				foreach($style as $value){
					echo $value;
				}
			}
		?>
        <!-- End Related css to this page -->	
        
        <script> 
		var base_url = "<?php echo base_url();?>";
		var site_url = "<?php echo site_url('/');?>";
		var session_user_id = '<?php echo $this->session->userdata('user_id'); ?>';
        </script>
    </head>
<body>
<div class="main-wrapper">
<?php $this->load->view('common/top_navigation'); ?>





	

