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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Funny Talks</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/rasterizeHTML.allinone.js"></script>  	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>			
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
          <a href="index.php" ><img src="images/logo.png" alt="memmonk" style="margin-top:2px;"></a>
          
        </div>
        <div class="navbar-header pull-right">
        <a href="home.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Go Start </a>  <a href="gallery.php" class="btn btn-default"><span class="glyphicon glyphicon-picture"></span> Go Gallery</a> &nbsp; &nbsp;
          <!--  Generating the login / logout link -->
			  <?php if($user): ?>
              
                  <img src="https://graph.facebook.com/<?php echo $user; ?>/picture" style="border:1px solid #242424" class="img-circle">
                  <span class="whitetext">Welcome <?php echo $user_profile['name']; ?></span>
                  <a href="fbconnect/logout.php" class="btn btn-danger btn-group-sm" style="margin:8px;">Logout</a>
            <?php else: ?>
              <a href="<?php echo $loginUrl; ?>" target="_blank" class="btn btn-primary btn-group-sm" style="margin:8px;">Facebook Login</a>
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
    <div class="jumbotron" style="background:#ffcc00">
      <div class="container"><br/>
        <h1>Build your thoughts and share with your friends</h1>
        <p>
        <strong>meme</strong>(/mi:m/) ~ an image, video, piece of text, etc., typically humorous in nature, that is copied and spread rapidly by Internet users, often with slight variations.<br/><br/>
        mememonk helps you to create your own meme and share it with your facebook friends. It gives a new dimensions to your <strong>thoughts, jokes or social message</strong> and helps you to draw much more <strong>attention and user engagement</strong> than a regular facebook post.<br/><br/>
        mememonk is fully devoted to security &amp; privacy and <strong>does not store</strong> any of your <strong>login data</strong>.
        </p>
        <p><a href="home.php" class="btn btn-danger btn-lg" role="button">GO GENERATE </a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Create</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Generate</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Share</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; <span style="color: #ffcc00">meme</span><span style="color: #ff3300">monk</span> 2014 | All rights reserved<span class="pull-right" ><img src="https://graph.facebook.com/manabjyoti.sarma/picture" class="img-circle" height="40"> Manabjyoti Sarma</span></p><br/>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
