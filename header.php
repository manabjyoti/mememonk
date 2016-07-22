<?php
// including the main facebook sdk file
require 'fbconnect/src/facebook.php';

// building the Facebook object with the app and secret id
require 'fbconnect/constants.php';
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
// adding the album info
$album_name = 'mememonk Album';
$album_description = 'Album created by album';

// Get the user id
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');

    // getting the user album
    $user_albums = $facebook->api("/me/albums");
    
    if ($user_albums) {
      foreach ($user_albums['data'] as $key => $album) {
        if ($album['name'] == $album_name) {
          $album_id = $album['id'];
          break;
        }
        else {
          $album_id = 'blank';
        }
      }
    }

    // if the album is not present, create the album
    if ($album_id == 'blank') {
      $graph_url = "https://graph.facebook.com/me/albums?" . "access_token=". $user;
      
      $album_data = array(
        'name' => $album_name,
        'message' => $album_description,
      );

      $new_album = $facebook->api("me/albums", 'post', $album_data);
      $album_id = $new_album['id'];
    }
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  // building the logout url
  $params = array(
    'next' => 'http://demos.amitavroy.com/fbconnect/logout.php'
  );
  $logoutUrl = $facebook->getLogoutUrl($params);
} 
else {
  // building the login url
  $params = array(
    'scope' => 'user_photos' // taking the photo upload permission
  );
  $loginUrl = $facebook->getLoginUrl($params);
}
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mememonk, a better place to create your meme">
    <meta name="author" content="Manabjyoti Sarma">
    <link rel="icon" href="images/pic.gif">
    <title>mememonk</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>	
	<script src="js/rasterizeHTML.allinone.js"></script>  
  </head>

  <body>
	
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>-->
          <a href="index.php"><img src="images/logo.png" alt="memmonk" style="margin-top:1px;"></a>
          
        </div>
        <div class="navbar-header pull-right">
        <a href="home.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Go Start </a>  <a href="gallery.php" class="btn btn-default"><span class="glyphicon glyphicon-picture"></span> Go Gallery</a> &nbsp; &nbsp;
          <!--  Generating the login / logout link -->
			  <?php if($user): ?>
              
                  <img src="https://graph.facebook.com/<?php echo $user; ?>/picture" style="border:1px solid #242424" class="img-circle">
                  <span class="whitetext">Welcome <?php echo $user_profile['name']; ?></span>
                  <a href="fbconnect/logout.php" class="btn btn-danger btn-group-sm" style="margin:8px;">Logout</a>
            <?php else: ?>
            
              <a href="<?php echo $loginUrl; ?>" class="btn btn-primary btn-group-sm" style="margin:8px;">Facebook Login</a>
            <?php endif; ?>
            <!--  Dump data when available -->
            <?php //if (isset($user_profile)): ?>
            <!--  <h3>Your User Object (/me)</h3>-->
            <?php //print_r($user_profile); ?>
            <?php //endif; ?>
          </div>
        <!--<div class="navbar-collapse collapse">
        
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div>--><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background:url(images/bg.jpg)">
      <div class="container">
        <br/><br/>
      </div>
    </div>