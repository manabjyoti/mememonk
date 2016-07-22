<?php
	session_start();
	if(!isset($_SESSION['filename'])){
	$_SESSION['filename'] = 'manabmemek-' . time();
	}
?>

	
<?php	
include('header.php');
?>    <!--    <script type='text/javascript' src="js/html2canvas.js"></script>
    <script type='text/javascript' src="http://www.nihilogic.dk/labs/canvas2image/base64.js"></script>
      <script type='text/javascript' src="http://www.nihilogic.dk/labs/canvas2image/canvas2image.js"></script>-->
	<script>
	$(document).ready(function(){
	if (localStorage.getItem("sessid") != "<?php echo $_SESSION['filename']; ?>"){
		//alert("i m in");
		// Check browser support
		if (typeof(Storage) != "undefined") {
			// Store
			localStorage.setItem("sessid", "<?php echo $_SESSION['filename']; ?>");
		} else {
			alert("Sorry, your browser does not support Web Storage...");
		}
	}else{	
		var localdata = localStorage.getItem("memeschene");
		if (localdata){
		localdata = JSON.parse(localdata);
			$('#scheheader').val(localdata["scheheader"]);
			$("#talks").html(localdata["talks"]);
			$("#t1 img").attr("src", localdata["t1img"]);
			$("#t2 img").attr("src", localdata["t2img"]);
		}
	}
	});
</script>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-9">
				<ul class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#schene1" role="tab" data-toggle="tab">Schene 1</a></li>
                  <li><a href="#schene2" role="tab" data-toggle="tab">Schene 2</a></li>
                  <!--<li><a href="#schene3" role="tab" data-toggle="tab">Schene 3</a></li>
                  <li><a href="#schene4" role="tab" data-toggle="tab">Schene 4</a></li>-->
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="schene1">
                  <!-- tab content 1 starts -->
                  	<input id="scheheader" name="scheneheader" class="form-control" placeholder="Type your schene header" value=""/>
                      <div class="col-md-3">
                        <div class="thumbnail" id="t1">
                            <img id="avatar1" name="avatar1" class="avatarx" src="images/pic.gif">
                          <div class="caption">
                          
                              <select name="avatar1" onChange="ShowPic(this)" onkeyup="ShowPic(this)" class="form-control avatar smaller">
                              <option value="images/blank.png">None</option>
                              </select>
                            
                            <input id="uploadImage" type="file" class="btn btn-sm btn-block" name="myPhoto" onChange="loadImageFile(this.id, oFReader1);" />
                            
                            <input name="character1" id="character1" class="form-control smaller" placeholder="Character Name" />
                            
                            <textarea name="s1" id="s1" class="form-control smaller"></textarea>
                            <div class="btn-group btn-group-sm">
                              <button type="button" class="btn btn-default s1" name="left" onClick="speak('s1', 'talks')">Talk</button>
                              <button type="button" class="btn btn-default">Think</button>
                              <button type="button" class="btn btn-default">None</button>
                            </div>
                            <!--<input type="button" class="btn btn-sm btn-default s1" name="left" value="Submit" onClick="speak('s1', 'talks')">-->
                            
                          </div>
                        </div>
                    </div>
                    <div id="talks" class="col-md-6">
                        
                    </div>
                    <div class="col-md-3">
                        
                        <div class="thumbnail" id="t2">
                            <img id="avatar2" name="avatar2"  class="avatarx" src="images/pic.gif">
                          <div class="caption">
                            <select name="avatar2"  onChange="ShowPic(this)" class="form-control avatar smaller">
                              <option value="images/blank.png">None</option>
                            </select>
                            <input id="uploadImage2" type="file" class="btn btn-sm btn-block" name="myPhoto" onChange="loadImageFile(this.id, oFReader2);" />
                            <input name="character2" id="character2" class="form-control smaller" placeholder="Character Name" />
                            <textarea name="s2" id="s2" class="form-control smaller"></textarea>
                            <div class="btn-group btn-group-sm">
                             <button type="button" class="btn btn-default s2" name="right" onClick="speak('s2', 'talks')">Talk</button>
                              <button type="button" class="btn btn-default">Think</button>
                              <button type="button" class="btn btn-default">None</button>
                            </div>
                            <!--<input type="button" class="btn btn-default s2" name="right" value="Submit" onClick="speak('s2', 'talks')">-->
        
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- Tab 1 ends -->
                  <div class="tab-pane" id="schene2">
                  	 <!-- tab content 2 starts -->
                     <input id="scheheader2" name="scheneheader2" class="form-control" placeholder="Type your schene header"/>
                      <div class="col-md-3">
                        <div class="thumbnail" id="t3">
                            <img id="avatar3" name="avatar3" src="images/pic.gif">
                          <div class="caption">
                          <p>
                              <select name="avatar3" onChange="ShowPic(this)" class="form-control avatar smaller">
                              <option value="images/blank.png">None</option>
                              </select>
                            <input id="uploadImage3" type="file" class="btn btn-sm btn-block" name="myPhoto" onChange="loadImageFile(this.id, oFReader3);" />
                            <input name="character3" id="character3" class="form-control smaller" placeholder="Character Name" />
                            <textarea name="s3" id="s3" class="form-control smaller"></textarea>
                            <div class="btn-group btn-group-sm">
                             <button type="button" class="btn btn-default s3" name="left" onClick="speak('s3', 'talks2')">Talk</button>
                              <button type="button" class="btn btn-default">Think</button>
                              <button type="button" class="btn btn-default">None</button>
                            </div>
                           <!-- <input id="uploadImage" type="file" class="btn btn-sm" style="width:95px;" name="myPhoto" onChange="loadImageFile();" />
                            </p>
                            <textarea name="s3" id="s3" class="form-control"></textarea>
                            <input type="button" class="btn btn-sm btn-default s3" name="left" value="Submit" onClick="speak('s3', 'talks2')">-->
                            
                          </div>
                        </div>
                    </div>
                    <div id="talks2" class="col-md-6">
                        
                    </div>
                    <div class="col-md-3">
                        
                        <div class="thumbnail" id="t4">
                            <img name="avatar4" src="images/pic.gif">
                          <div class="caption">
                            <p>
                            
                              <select name="avatar4"  onChange="ShowPic(this)" class="form-control avatar smaller">
                              <option value="images/blank.png">None</option>
                              </select>
                            </p>
                            <textarea name="s4" id="s4" class="form-control smaller"></textarea>
                            <input type="button" class="btn btn-default s4" name="right" value="Submit" onClick="speak('s4','talks2')">
        
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- Tab 2 ends -->
                  <div class="tab-pane" id="schene3">...</div>
                  <div class="tab-pane" id="schene4">...</div>
                </div>

              				<?php
							  $imagesDir = 'avatar/';
							  $avatar = glob($imagesDir . '*.png', GLOB_BRACE);
							?>
                            <script type="text/javascript">
							
							 
								$.each(<?php echo json_encode($avatar); ?>, function(val, text) {
									$('.avatar').append( $('<option></option>').val(text).html('Avatar-' + val) )
								});
							 
							 
							</script>
                
              <input type="button" class="btn btn-primary pull-right" onClick="generateschene()" value="Generate Schene">
              <a type="button" class="btn btn-danger pull-right" style="margin-right:15px;" href="destroy.php">Create New </a>
            <div class="row">
            
                <div class="col-md-9" id="divcanvas">
               <!-- <canvas id="sharepanel" width="700" height="300">        
                </canvas>-->
                </div>
                <div id="profilediv" class="row col-md-3" style="font-size:13px; padding:0; display:none;">
                <?php if($user): ?>
               	 <div class="well" style="text-align:center">
                  <img src="https://graph.facebook.com/<?php echo $user; ?>/picture" style="border:1px solid #242424" class="img-circle"><br/>
                  <h4><?php echo $user_profile['name']; ?></h4>, <?php echo($user_profile['location']['name']); ?>
                  <input value="<?php echo $user_profile['id']; ?>" id="fbid" type="hidden" />
                  <input value="<?php echo $user_profile['email']; ?>" id="fbemail"  type="hidden"/>
                 </div>
                 
                 <input type="button" onclick="sharetogallery()" id="sharetogallery" class="btn btn-block btn-sm btn-success" value="Share to Gallery"><br/>
            <div class="modal-box" role="alert" style="color:#00CC33"></div>
            <?php else: ?>
              <strong><a href="<?php echo $loginUrl; ?>" target="_blank">Login</a> using your facebook account to showcase your meme in <a href="gallery.php" target="_blank" style="color: #ff3300">our gallery</a> and share.</strong><br/><br/>
              <p class="well well-sm">If you are not logged in your meme will not be save and will be lost if you close the window.</p>
            <?php endif; ?>
            <a href="temp/<?php echo $_SESSION['filename'];?>.png" class="btn btn-block btn-sm btn-info">Download Image</a>
            
			</div>
            </div>
           <!-- for teting html2canvas --->
<!--            <div id="schenecatch">
            	
            </div>
            <div id="img-out"></div>-->
            
             <!-- for teting html2canvas --->
        </div>
        <div class="col-md-3">
          <h2>Avatar Gallery</h2>
          
			<ul id="gallery" class="col-md-12"></ul>
            <input id="img" type="text"/>
              
<?php
  $imagesDir = 'avatar/';
  //$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
  $images = glob($imagesDir . '*.png', GLOB_BRACE);
 // echo json_encode($images);
  //echo $images[0];
  
?>
<script>
$.each( <?php echo json_encode($images); ?>, function( i, l ){
//alert( "Index #" + i + ": " + l );
//$("#schenex").prepend('<div class="col-md-6" style="height:110px;"><img src="'+ l +'" width="100%" class="thumbnail" style="margin-bottom:10px; border:1px solid #ccc;"/></div>')
$("#gallery").append('<li style="width:30%; height:60px;"><img src="'+ l +'" class="thumbnail" style="margin-bottom:10px; width:100%; height:100%; border:1px solid #ccc;"/></li>')
});
</script>
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
    
	<script src="js/memik.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://gregpike.net/demos/bootstrap-file-input/bootstrap.file-input.js"></script>
    <script>
$('input[type=file]').bootstrapFileInput();
$('.file-inputs').bootstrapFileInput();
</script>
  </body>
</html>
