<div id="post-<?=$id?>" class="post">
	<div class="l-post">
		<div class="img-cont"><img src="assets/images/profile_pic/<?=$profile_pic?>"></div>
	</div>
	<div class="r-post">
		<p><a href="#"><?=$name?></a></p>
		<p id="post-" class="post-text">
			<?= $text?>
		</p>
		<div class="post-text-date">
			<small id="date-<?=$id?>" class="time-elapsed"></small>
		</div>
		<div class="post-actions">			
			<a href="javascript: like_post(<?=$id?>);" id="like-<?=$id?>" class="act"><i class="icon-thumbs-up"></i> Like</a>
			<a href="javascript: write_comment(<?=$id?>);" class="act"><i class="icon-comment"></i> Comment</a>
			<div class="num-likes-post-cont"><small id="num-likes-post-<?=$id?>" ></small></div>
		</div>

		<div id="comments-<?=$id?>" class="comment-container">
			
		</div>
		<form id="frm-comment-<?=$id?>" method="post" onSubmit="comment('<?=$id?>'); return false;">
			<div class="post-comments">
				<div class="img-cont"><img src="assets/images/profile_pic/<?=$this->session->_get('USER_profile_pic')?>"></div>
				<input type="text"  id="txt-comment-<?=$id?>"  class="txt-comment" name="txt-comment" value="Comment..." placeholder="Comment..." 
					onfocus="var txt = $(this).val(); if(txt == 'Comment...'){clear_txt(this,''); $(this).css('color','#000');}" 
					onblur="var txt = $(this).val(); if(txt == ''){clear_txt(this,'Comment...'); $(this).css('color','#A0A0A0');}"><!-- </textarea> -->
				<!-- <button type="button" id="aaaa" class="btn-comment btn btn-primary" onclick="comment('<?=$id?>');"><i class="icon-comment icon-white"></i> Comment</button> -->
				<input type="hidden" value="<?=$id?>" name="post-id" />
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	var timeLogger = new ElapsedTimeLogger('<?=$date?>', '#date-<?=$id?>', 5);
	timeLogger.start();
	check_like_post(<?=$id?>);
	count_like_post(<?=$id?>);
	load_comment(<?=$id?>);
</script>