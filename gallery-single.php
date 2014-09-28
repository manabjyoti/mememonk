

<?php
	session_start();
	//$_SESSION['filename'] = 'manabmemek-' . time();
?>

<?php
if(isset($_GET['id'])){
$imgid = $_GET['id'];
include('header.php');
?>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async  data-pin-color="white" data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
<div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-9">
 <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53fccfec2719a079"></script>
<meta property="og:image" content="<?php echo $imgid ; ?>" />       
            <div class="ajax-text-and-image white-popup-block"><div id="lightbox" class="ajax-text-and-image">
            

            <link href="style.css" rel="stylesheet">
                <style>
                .ajax-text-and-image {
                    max-width:615px; margin: 20px auto; background: #FFF; padding: 0; line-height: 0;
                }
                .ajcol {
                    width: 615px; float:left;
                }
                .ajcol2 {
                    width: 100%; float:left;
                }
                .ajcol img {
                    width: 100%; height: auto;
                }
                @media all and (max-width:30em) {
                    .ajcol { 
                        width: 100%;
                        float:none;
                    }
                }
                </style>
                <div class="ajcol">
                    <img src="<?php echo $imgid ; ?>" width="615" height="auto"><br/>
                </div>
                
                <div style="clear:both; line-height: 0;"></div>
                </div><!-- end of lightbox -->
                <div style="padding: 1em" class="addthis_sharing_toolbox"></div>
                <div class="ajcol2" style="line-height: 1.231;">
                    <div style="padding: 1em">		   
                        <?php if ($user) : ?>
                        <h4>Welcome <?php echo $user_profile['name']; ?></h4>
                        <!--<form enctype="multipart/form-data" method="POST" action="fbconnect/upload.php">
                        <label>Adding photo to album: <?php print $album_name ?></label>
                        <input name="photo" type="hidden" value="<?php echo $imgid ; ?>" readonly>-->
            
                        <label>Say something:</label>
                        <textarea id="msg" name="message" type="text" value="" rows="2" class="form-control"></textarea>
                        <!--
                        <label></label>
                        <input type="submit" value="SHARE TO THE TIMELINE" class="btn btn-primary" />--><br/>
                       <!-- <button type="submit" class="btn btn-primary">
                          <span class="glyphicon glyphicon-share"></span> SHARE TO THE TIMELINE
                        </button>
                        
                        <input type="hidden" name="album_id" value="<?php print $album_id; ?>">
                      </form>-->
                      <button id="fbsubmit" type="submit" class="btn btn-primary">
                          <span class="glyphicon glyphicon-share"></span> SHARE TO THE TIMELINE
                        </button>
                      <script>
					  $("#fbsubmit").click(function(){
                      	$.post( "fbconnect/upload.php", { photo: "<?php echo $imgid ; ?>", album_id: "<?php print $album_id; ?>", message: $('#msg').val()})
						 .done(function( data ) {
						 alert( "Image Sucessfully posted to your timeline");
						 });
					  });
					  </script>
                      <?php else: ?>
                       <a href="<?php echo $loginUrl; ?>" class="btn btn-primary btn-group-sm" style="margin:8px;">Facebook Login</a>
                      <?php endif; ?>
                        
                    </div>
                </div>
            </div>

 		</div>
        <div class="col-md-3">
        <h2>Quick Links</h2>
          <a href="home.php" class="btn btn-primary">Prev</a><a class="btn btn-default" href="#" role="button">Next</a>
       </div>
        
     </div>
      

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->
<?php
}else{
?>	
NOT AUTHORIZE ! :(
    <!-- Placed at the end of the document so the pages load faster -->
  <?php
  }
  ?>  
	<script src="js/memik.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.8.9/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
