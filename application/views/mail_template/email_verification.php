<?php $this->load->view('mail_template/mail_header',$data); ?>
<?php 
$messageArray  = $mail_result[0]['message'];

$message = str_replace('{USERNAME}',$username,$messageArray);
$message = str_replace('{SITENAME}',$sitename,$message);
$message = str_replace('{SITEURL}',$siteurl,$message);
echo $message = str_replace('{EMAIL}',$email,$message);

?>
<?php $this->load->view('mail_template/mail_footer'); ?>