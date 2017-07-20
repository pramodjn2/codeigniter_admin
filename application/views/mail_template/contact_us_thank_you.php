<?php $this->load->view('mail_template/mail_header',$data); ?>
<?php 
$messageArray  = $mail_result[0]['message'];

$message = str_replace('{USERNAME}',$username,$messageArray);
$message = ucwords($message);
echo $message = str_replace('{SITENAME}',$sitename,$message);

?>
<?php $this->load->view('mail_template/mail_footer'); ?>