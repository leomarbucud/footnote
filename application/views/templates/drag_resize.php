<style>
	.draggable {
		width: 90px; 
		height: 90px; 
		padding: 0.5em; 
		float: left; 
		margin: 0px; 
	}
	#draggable3 { 
		cursor: move; 
		/*border: 1px solid #dfdfdf; */
		width: 33.333333%; 
		position: absolute; 
		left: calc(50% - 100px); 
		top: calc(50% - 100px);
		opacity: 0.3;
		background-color: #000000;
		overflow: hidden;
	}
	#image-wrapper {
		/*width: calc(auto + 10px);*/
	}
	#image-wrapper img{
		width: 100%;
	}
	#containment-wrapper { 
		width: 600px; 
		/*border: 2px solid #ccc; */
		position: relative; 
		border: 1px solid #dfdfdf; 
		height: auto;
		padding: 5px;
	}
	#modal{
		/*background-color: #fff;
		opacity: 0.4;*/
		width: 100%;
		height: 100%;
		position: absolute;
	}
</style>
	<script>
	$(function() {
		// $( "#draggable" ).draggable({ axis: "y" });
		// $( "#draggable2" ).draggable({ axis: "x" });
		<?php
			$target = 'assets/images/uploads/1373727216_1_03d6892857bc5f3281bc066630d23760.jpg';
			list($w_orig, $h_orig) = getimagesize($target);
		?>
		var w_orig = <?=$w_orig?>;
		var h_orig = <?=$h_orig?>;
		var w_ratio = w_orig / h_orig;
		var w = $('#image-wrapper img').width();
		var h = w / w_ratio;
		$('#image-wrapper img').height(h);
		$('#computaion').html('orginal width = '+w_orig+'<br/>original height = '+h_orig+'<br/>new width = '+w+'<br/>new height = '+h+'<br/>ration = '+w_ratio);
		var d_w = $( "#draggable3" ).width();
		$( "#draggable3" ).height(d_w);
		$( "#draggable3" )
				.draggable({
					containment: "#image-wrapper",
					drag: function(event, ui) 
					{ 
						$('#x').val(($("#draggable3").css('left').replace(/px/,'') / (w/w_orig)));
						$('#y').val(($("#draggable3").css('top').replace(/px/,'') / (h/ h_orig)));
						// $( "#draggable3 img" )
						// 	.css('margin-top','-'+($("#draggable3").css('top')))
						// 	.css('margin-left','-'+($("#draggable3").css('margin-left')))
						// 	;
					 }
				})
				.resizable({
					aspectRatio: 1,
					containment: "#image-wrapper",
					minWidth: 200,
					minWidth: 200, 
					start: function(event, ui)
					{
						
					},
					resize: function(event, ui)
					{
						$('#width').val(($("#draggable3").width() / (w/w_orig))+8);
						$('#height').val(($("#draggable3").height() / (h/ h_orig))+8);
					}
				});
		/*	$( "#draggable4" ).draggable({ containment: "#demo-frame" });	
		$( "#draggable5" ).draggable({ containment: "parent" });*/
	});
	</script>
<div id="content">
	<div id="center-panel">
		<div id="containment-wrapper">
			<div id="modal"></div>
			<div id="image-wrapper">
				<img src="/my_framework2/assets/images/uploads/1373727216_1_03d6892857bc5f3281bc066630d23760.jpg" />
			</div>
			<div id="draggable3" class="draggable ui-widget-content"></div>
			
		</div>
		<div id="computaion"></div>
		<form action="<?=BASE_URL?>welcome/crop" method="post" />
			Width:<input type="text" id="width" name="width" />
			Height:<input type="text" id="height" name="height" />
			X:<input type="text" id="x" name="x" />
			Y:<input type="text" id="y" name="y" />
			<input type="hidden" name="img" value="/my_framework2/assets/images/uploads/1373727216_1_03d6892857bc5f3281bc066630d23760.jpg" />
			<button type="submit" class="btn btn-primary" > Done cropping</button>
		</form>
	</div>
</div>