<?php 
$this->load->view('common/header');
?>



<div class="jumbotron">
  <div class="container text-center">
    <h1>My Portfolio</h1>      
    <p>Some text that represents "Me"...</p>
  </div>
</div>
  
<div class="container-fluid bg-3 text-center">    
  <h3>Social Login</h3><br>
  <div class="row">
   
 

<?php
if(!empty($authUrl)) {
    echo '<div class="col-sm-3"><a href="'.$authUrl.'"><img src="'.base_url().'assets/images/glogin.png" alt="Glogin"/></a></div>';
	echo '<div class="col-sm-3"><a href="'.$fbauthUrl.'"><img src="'.base_url().'assets/images/flogin.png" alt="Facebook"/></a></div>';
	echo '<div class="col-sm-3"><a href="'.$linkedinoauthURL.'"><img src="'.base_url().'assets/images/sign-in-with-linkedin.png" alt="Linkedin" /></a></div>';
	echo '<div class="col-sm-3"><a href="'.$twitteroauthURL.'"><img src="'.base_url().'assets/images/sign-in-with-twitter.png" alt="Twitter"/></a></div>';
}else{

?>
<div class="wrapper">
    <h1>Profile Details </h1>
    <?php
    echo '<div class="welcome_txt">Welcome <b>'.$userData['first_name'].'</b></div>';
    echo '<div class="google_box">';
    echo '<p class="image"><img src="'.$userData['picture_url'].'" alt="" width="300" height="220"/></p>';
    echo '<p><b>ID : </b>' . $userData['oauth_uid'].'</p>';
    echo '<p><b>Name : </b>' . $userData['first_name'].' '.$userData['last_name'].'</p>';
    echo '<p><b>Email : </b>' . $userData['email'].'</p>';
    echo '<p><b>Gender : </b>' . $userData['gender'].'</p>';
    echo '<p><b>Locale : </b>' . $userData['locale'].'</p>';
    echo '<p><b>Profile Link : </b>' . $userData['profile_url'].'</p>';
    echo '<p><b>You are login with : </b>' . $userData['oauth_provider'].'</p>';
    echo '<p><b>Logout from <a href="'.base_url().'user_authentication/logout">logout</a></b></p>';
    echo '</div>';
    ?>
</div>
<?php } ?>

 </div>
</div><br>
<?php 
$this->load->view('common/footer');
?>