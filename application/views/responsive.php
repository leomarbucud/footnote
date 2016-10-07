<script>
	function show_files()
	{
		var box = document.getElementById('f');
		var fl = document.getElementById('img');
		box.innerHTML = '';
		for (var i = 0; i < fl.files.length; i++)
        {
			box.innerHTML += (fl.files[i].name);
		}
	}
</script>
<div id="content">
	<div id="left-panel">
		<div id="l-content">
			<div id="p-container">
				<img src="assets/images/profile_pic/<?=$profile_pic?>">
				<a href="#"><?=$name?></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div id="center-panel">
		<div id="c-content">
			<div id="write-container">
				<form method="post" id="frm-write" action="<?=BASE_URL?>post/write" enctype="multipart/form-data">					
					<textarea id="write" name="write" placeholder="Write..."
						onfocus="var txt = $(this).val(); if(txt == 'Write...'){clear_txt(this,''); $(this).css('color','#000');}" 
						onblur="var txt = $(this).val(); if(txt == ''){clear_txt(this,'Write...'); $(this).css('color','#A0A0A0');}">Write...</textarea>
					<div id="write-controls">
					    <div class="btn-group">
					    	<div class="btn-file btn btn-primary">
					    		<i class="icon-picture icon-white"></i> 
								<span>Upload Image</span>
								<input type="file" name="my-img[]" id="img" onchange="show_files();"/>
							</div>
							<button type="button" id="btn-write"class="btn btn-primary" onclick="write_post()"><i class="icon-pencil icon-white"></i> Write</button>
					   
					    </div>					
					     <div type="text" id="">
					     	<span id="f"></span>
					     </div>
					</div>
				</form>
			</div>
			<div id="loading-post"></div>
			<div id="progress"></div>
			<div id="post-container">
				<div id="post-content">
				</div>
				<div id="loading-container">
					<a href="javascript: load_posts();">View more</a>
				</div>
			</div>
		</div>
	</div>
	<div id="right-panel"></div>
	<div style="clear:both" ></div>
</div>
<div style="clear: both"></div>