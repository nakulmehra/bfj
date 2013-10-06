	<?php if($errorMsg != "") { ?>
		<script language="javascript">
			function hideEr() {
				document.getElementById('errorBlock').style.display = 'none';
			}
		</script>
		<script language="javascript">
			(function($){
				$(document).ready(function() {
					$("[AutoHide]").each(function() {
						if (!isNaN($(this).attr("AutoHide"))) {
							eval("setTimeout(function() {jQuery('#" + this.id + "').hide();}, " + parseInt($(this).attr('AutoHide')) * 1000 + ");");
						}
					});
				});
			})(jQuery);
		</script>

		<div id="errorBlock" AutoHide="5" class="errorBlockCF" ondblclick="javascript: document.getElementById('errorBlock').style.display = 'none';">
		  <div class="errorBlockCFImg"><?= (($msg_error) ? "$msg_img_error" : "$msg_img_ok") ?></div>
		  <div class="errorBlockCFMsg"><?= $errorMsg; ?></div>
		  <div class="errorBlockCFBtn"><a href="javascript: void(0);" onclick="javascript: hideEr();"><strong>CLOSE</strong></a>&nbsp;&nbsp;&nbsp;</div>
		  <br clear="all" />
		</div>
	<?php } ?>
	<div id="pageOverlay" class="page_overlay"></div>
	<div id="itemWrapper" class="item_wrapper">
		<div id="itemOverlay" class="item_overlay corner-all"><br/></div>
	</div>
<!-- START FOOTER -->
<div id="footer">
   <p>&copy; BFJ. | Designed by <a href="http://www.vizzmedia.com" target="_blank">Vizz Media</a></p>
</div>
<!-- END FOOTER -->

<!-- REQUIRED FOR IE FONT REPLACEMENT USING CUFON -->
</div>
</body>
</html>
