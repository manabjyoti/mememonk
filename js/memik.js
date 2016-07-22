// Author Manabjyoti Sarma
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

		oFReader1 = new FileReader(); 
		oFReader1.onload = function (oFREvent) {
		  document.getElementById("avatar1").src = oFREvent.target.result;
		};
		
		oFReader2 = new FileReader();
		oFReader2.onload = function (oFREvent) {
		  document.getElementById("avatar2").src = oFREvent.target.result;
		};
		
		oFReader3 = new FileReader();
		oFReader3.onload = function (oFREvent) {
		  document.getElementById("avatar3").src = oFREvent.target.result;
		};
	
	function loadImageFile(inptid, avtr) {
	  if (document.getElementById(inptid).files.length === 0) { return; }
	  var oFile = document.getElementById(inptid).files[0];
	  if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
	  avtr.readAsDataURL(oFile);  
	}
	

	
	function ShowPic(sImage)
		{
			//var avatar = document.proof.avatar.options[document.proof.avatar.selectedIndex].value; 					
			//document.ShowRoom.src = avatar;
			$("img[name="+ sImage.name +"]").attr("src", $('select[name='+ sImage.name +']').val());
		}

		
	function speak(valx, tlk){
			var setclass = $("."+valx).attr('name');
			valxd = $("#"+valx).val();
			talkx = $("#"+tlk).html();
			var uqid = Math.floor((Math.random() * 9999) + 111);
			talkx = talkx + "<p id='"+ uqid +"' class='bubble "+ setclass +"' ondblclick='toggle(this)'   data-toggle='tooltip' data-placement='top' title='Drag to MOVE or Double Click to REMOVE'>"+ valxd +"</p>";
			$("#"+tlk).html(talkx);
			$("#"+valx).val("");
			$(".bubble" ).draggable({ containment: "#"+tlk });
			$(".bubble").tooltip();
		}
		
	function toggle(ele){
		$("#"+ ele.id).hide(100);	
	}
	
	function generateid(){
		var d = new Date();
    	var n = d.getTime();
		return n;
		}
					
	function generateschene(){
		if($("#talks").height()> 210){
			var hgt = $("#talks").height() + 80 + $('#scheheader').height();
		}else{
			var hgt = 280 + $('#scheheader').height();
		}
							
		if($("#talks2").height()> 0 && $("#talks2").height()< 220 ){
			hgt = hgt + 300 + $('#scheheader2').height();
		}
							
		if($("#talks2").height()> 220 ){
			hgt = hgt + $("#talks2").height() + 100 + $('#scheheader2').height();
		}
						
						
						var canv = document.createElement('canvas');
						canv.id = 'sharepanel';
						canv.width = 615;
						canv.height = hgt;
						canv.style = 'background: url("images/loader.gif") center center no-repeat;';
						//alert(hgt);
						//document.body.appendChild(canv); // adds the canvas to the body element
						$('#divcanvas').html(canv);
						//var bgurl1 = "background:url(images/pic.jpg)";
						var canvas = document.getElementById("sharepanel");
						canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
						var schene = "<link href='style.css' rel='stylesheet'><table width='95%' style='border:2px solid #242424;padding:5px; margin:10px;'><tr><td colspan='3'><img src='images/logo-watermark.png'/ style='float:right'><h2 style='margin:0px;'>";
						schene = schene + $('#scheheader').val() + "</h2></td></tr><tr><td width='180px'>";						
						schene = schene + "<img width='100%' src='" + $("#t1 img").attr("src") +"'>";
						schene = schene + "<h4 style='text-align:center'>" + $("#t1 #character1").val() + "</h4></td><td width='326px'>";
						schene = schene + $("#talks").html();
						schene = schene + "</td><td width='180px'>";
						schene = schene + "<img width='100%' src='" + $("#t2 img").attr("src") +"'>";
						schene = schene + "<h4 style='text-align:center'>" + $("#t2 #character2").val() + "</h4></td></tr></table>";
						//$("#temppanel").html(schene);
						// shene two started
						if($("#talks2").height()> 0){
						schene = schene + "<table width='100%' style='border:2px solid #242424; border-top:0px;padding:5px;'><tr><td colspan='3'><h2 style='margin:0px;'>";
						schene = schene + $('#scheheader2').val() + "</h2></td></tr><tr><td width='180px'>";						
						schene = schene + "<img width='180' src='" + $("#t3 img").attr("src") +"'>";
						schene = schene + "<h4 style='text-align:center'>" + $("#t3 #character3").val() + "</h4></td><td width='330px'>";
						schene = schene + $("#talks2").html();
						schene = schene + "</td><td width='180px'>";
						schene = schene + "<img width='180' src='" + $("#t4 img").attr("src") +"'>";
						schene = schene + "</td></tr></table>";
						}


						rasterizeHTML.drawHTML(schene, canvas, function(){
							
							try{
							var dataimg = canvas.toDataURL("image/png");
							console.log(dataimg);
							}catch(err) {
								alert (err.message);	
							}
							 $.ajax({
								  type: "POST",
								  url: "script-temp.php",
								  data: { 
									 img: dataimg
								  }
								}).done(function(o) {
								  console.log('saved'); 
								});
							
						});

						
						$("body, html").animate({ 
							scrollTop: $( "#divcanvas" ).offset().top 
						}, 600);
						$("#profilediv").show();
						//store to local storage
						var storeschene = {talks : $("#talks").html(), scheheader: $('#scheheader').val(), t1img: $("#t1 img").attr("src"),character1: $("#t1 #character1").val(), t2img: $("#t2 img").attr("src"), character2: $("#t2 #character2").val()}
						localStorage.setItem("memeschene", JSON.stringify(storeschene));
						
		}
		

		function sharetogallery(){
			var fid = $('#fbid').val();
			var mailid = $('#fbemail').val();
			$.ajax
				({ 
					url: 'script.php',
					data: {"fid": fid, "mailid": mailid},
					type: 'post',
					success: function(result)
					{
						$('.modal-box').text(result).fadeIn(700, function() 
						{
							setTimeout(function() 
							{
								$('.modal-box').fadeOut();
							}, 2000);
						});
					}
				});
		}