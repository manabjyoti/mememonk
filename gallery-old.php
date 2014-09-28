<?php
	session_start();
	//$_SESSION['filename'] = 'manabmemek-' . time();
	include('header.php');
?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
        
        <ul id="gallery">
        </ul>
          <?php
  $imagesDir = 'gallery/';
  //$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
  $images = glob($imagesDir . '*.png', GLOB_BRACE);
 // echo json_encode($images);
  //echo $images[0];
  
?>



<script>
$(document).on('click', '.closePopup', function (e) 
            {
                e.preventDefault();
                $.magnificPopup.close();
            });
			
	$.each( <?php echo json_encode($images); ?>, function( i, l ){
	//alert( "Index #" + i + ": " + l );
	$("#gallery").prepend('<li><a id="id'+i+'" href="gallery-single.php?id='+ l +'" style="background-image:url('+ l +');">&nbsp;</a></li>')
	});

$(function(){
$('#gallery li').magnificPopup({
  		delegate: 'a', // child items selector, by clicking on it popup will open
		type: 'ajax',
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		closeOnContentClick : false,
		modal:true,

    gallery: {
      enabled: true 
    },
	
	ajax: {
	  settings: null, // Ajax settings object that will extend default one - http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings
	  // For example:
	  // settings: {cache:false, async:false}
	
	  cursor: 'mfp-ajax-cur', // CSS class that will be added to body during the loading (adds "progress" cursor)
	  tError: '<a href="%url%">The content</a> could not be loaded.' //  Error message, can contain %curr% and %total% tags if gallery is enabled
	},
	callbacks: {
  parseAjax: function(mfpResponse) {
    // mfpResponse.data is a "data" object from ajax "success" callback
    // for simple HTML file, it will be just String
    // You may modify it to change contents of the popup
    // For example, to show just #some-element:
    mfpResponse.data = $(mfpResponse.data).find('#lightbox');
    
    // mfpResponse.data must be a String or a DOM (jQuery) element
    
    console.log('Ajax content loaded:', mfpResponse);
  },
  ajaxContentAdded: function() {
    // Ajax content is loaded and appended to DOM
    console.log(this.content);
  }
}


  
	});

});

</script>
        </div>
        <!--<div class="col-md-3">
          <a href="home.php" class="btn btn-primary">Go Home</a>
          
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>-->
        
     </div>
      

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
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
