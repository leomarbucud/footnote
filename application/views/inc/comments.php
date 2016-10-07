<div class="comments">
	<div class="lc-post">
		<div class="img-cont"><img src="assets/images/profile_pic/<?=$profile_pic?>"></div>
	</div>
	<div class="rc-post">
		<p><a href="#"><?=$name?></a></p>
		<p class="comment">
			<?=str_replace("\\'", "'", str_replace("\\\\","\\", str_replace("\\r\\n", "<br />", $comment)))?>
		</p>
		<div class="comment-time-elapsed">
			<small id="date-comment-<?=$id?>"></small>
		</div>
		<div class="comment-actions">
			<a href="#">Like</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	var timeLogger = new ElapsedTimeLogger('<?=$date?>', '#date-comment-<?=$id?>', 5);
	timeLogger.start();
</script>