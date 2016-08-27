<p class=""> Post your message: </p>
<p class=""> Press TAB to switch section easier.</p>
<p class="">Post title:</p>
<form action="dashboard/post" method="post">
	<input class="" type="text" name="Post_title" placeholder="Enter your title here">
	<p class="">Post message:</p>
	<textarea class="" type="text" name="Post" placeholder="Enter your message here"></textarea>
	<input class="" type="submit" value="Post"/>
</form>
<script type="text/javascript">
	$(function() {
		$('form').each(function() {
			$(this).find('textarea').keypress(function(e) {
				// Submit form if enter is pressed without shift
				if(e.which == 10 || e.which == 13 && ! e.shiftKey) {
					this.form.submit();
				}
			});
			$(this).find('input[type=submit]').hide();
		});
	});
</script>
<p class=""> All posts </p>
<p class="">
<?php foreach($this->overview as $key => $value):?>
<p class=""><?=$value['post_title']?></p>
<p class=""><strong><?=$value['username']?></strong> on </p>
<p class=""><?=date("d-m-Y H:i:s", strtotime($value['post_date']))?></p>
<?=$value['post_content']?>
<?php endforeach;?>
