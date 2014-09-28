<?php
	session_start();
	//$_SESSION['filename'] = 'manabmemek-' . time();
	include('header.php');
?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
        <script>
$(document).ready(function()
{
  $("span.on_img").mouseover(function ()
  {
    $(this).addClass("over_img");
  });

  $("span.on_img").mouseout(function ()
  {
    $(this).removeClass("over_img");
  });
});

$(function() {
$(".love").click(function() 
{
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this);


$(this).fadeOut(300);
$.ajax({
type: "POST",
url: "ajax_love.php",
data: dataString,
cache: false,

success: function(html)
{
parent.html(html);
parent.fadeIn(300);
} 
});


return false;

 });
});
</script>
       <style>
	   /**
		 * Grid container
		 */
		#tiles {
		  list-style-type: none;
		  position: relative; /** Needed to ensure items are laid out relative to this container **/
		  margin: 0;
		  padding: 0;
		}
		
		/**
		 * Grid items
		 */
		#tiles li {
		  width: 210px;
		  background-color: #ffffff;
		  border: 1px solid #dedede;
				  border-radius: 2px;
			 -moz-border-radius: 2px;
		  -webkit-border-radius: 2px;
		  display: none; /** Hide items initially to avoid a flicker effect **/
		  cursor: pointer;
		  padding: 4px;
		}
		
		#tiles li.inactive {
		  visibility: hidden;
		  opacity: 0;
		}
		
		#tiles li img {
		  display: block;
		}
		
		/**
		 * Grid item text
		 */
		#tiles li p {
		  color: #666;
		  font-size: 13px;
		  line-height: 20px;
		  text-align: center;
		  font-weight: 200;
		  margin: 7px 0 2px 7px;
		}
		
		.on_img
		{
		  color:#FF0066; font-size:20px; 
		 
		  cursor:pointer;
		   width:60px;

		}       
		
		.over_img
		{
		  color:#FFdd00; font-size:20px; cursor:pointer;
		  width:60px;
		}
		.box
		{
		padding:6px;
		}
		a
		{
		text-decoration:none;
		
		}
		a:hover
		{
		text-decoration:none;
		
		}
	   </style> 
      <div id="main" role="main">

      <ul id="tiles">
        <!-- These are our grid blocks -->
        <?php
          
include('config.php');
$sql=mysql_query("select * from images order by img_id DESC");

while($row=mysql_fetch_array($sql))
{

$img_id=$row['img_id'];
$img_url=$row['img_url'];
$love=$row['love'];
$fid = $row['fid'];
// Get the user id
$memeuser = $fid;

if ($memeuser) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile_meme = $facebook->api('/'.$fid);
	} catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if($memeuser): 
$name = $user_profile_meme['name'];
$location = $user_profile_meme['location']['name'];
else:
$name = "User Unknown";
$location = "";
endif;
//		  $imagesDir = 'gallery/';
//		  $images = glob($imagesDir . '*.png', GLOB_BRACE);
//		  foreach ($images as $img) {
		  echo '<li><img src="'. $img_url .'" width="100%" height="auto">
		  <div style="border-bottom:1px solid #ccc; height:40px;"><img src="https://graph.facebook.com/'.$fid.'/picture" style="border:1px solid #242424" class="img-sm img-circle pull-left">
		   <h5> '.$name.'<br/><span style="font-size:12px; color:#999;">'.$location.'</span></h5></div>
		  <div class="box" align="left">
<a href="#" class="love" id="'. $img_id .'">
<span class="on_img glyphicon glyphicon-heart" align="left">'. $love .'</span> 
</a><a href="gallery-single.php?id='. $img_url .'" class="btn btn-xs pull-right btn-primary">Share</a>
</div>
</li>';		
		  }
		
		?>
        <!-- End of grid blocks -->
      </ul>

  </div>

  <!-- include jQuery -->

  <!-- Include the imagesLoaded plug-in -->
  <script src="js/jquery.imagesloaded.js"></script>

  <!-- Include the plug-in -->
  <script src="js/jquery.wookmark.min.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      var $tiles = $('#tiles'),
          $handler = $('li', $tiles),
          $main = $('#main'),
          $window = $(window),
          $document = $(document),
          options = {
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $main, // Optional, used for some extra CSS styling
            offset: 15, // Optional, the distance between grid items
            itemWidth: 215 // Optional, the width of a grid item
          };

      /**
       * Reinitializes the wookmark handler after all images have loaded
       */
      function applyLayout() {
        $tiles.imagesLoaded(function() {
          // Destroy the old handler
          if ($handler.wookmarkInstance) {
            $handler.wookmarkInstance.clear();
          }

          // Create a new layout handler.
          $handler = $('li', $tiles);
          $handler.wookmark(options);
        });
      }

      /**
       * When scrolled all the way to the bottom, add more tiles
       */
      function onScroll() {
        // Check if we're within 100 pixels of the bottom edge of the broser window.
        var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
            closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

        if (closeToBottom) {
          // Get the first then items from the grid, clone them, and add them to the bottom of the grid
          var $items = $('li', $tiles),
              $firstTen = $items.slice(0, 10);
          $tiles.append($firstTen.clone());

          applyLayout();
        }
      };

      // Call the layout function for the first time
      applyLayout();

      // Capture scroll event.
      $window.bind('scroll.wookmark', onScroll);
    })(jQuery);
  </script>
        
        </div>
        <!--<div class="col-md-3">
          <a href="home.php" class="btn btn-primary">Go Home</a>
          
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>-->
        
     </div>
      

      <hr>

      <footer>
        <p>&copy; mememonk 2014</p>
      </footer>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<script src="js/memik.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.8.9/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
