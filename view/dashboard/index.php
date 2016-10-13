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
<?php foreach($this->overview as $key => $value):?>
<hr>
<p class=""><?=$value['post_title']?></p>
<p class=""><strong><?=$value['username']?></strong> on <?=date("d-m-Y H:i:s", strtotime($value['post_date']))?></p>
<p class=""><?=$value['post_content']?></p>
<?php if ($value['post_by'] === Session::get('user_id')){ ?>
<p class=""><a href="<?php echo URL ?>/dashboard/delete/<?=$value['post_id']?>"> Delete post</a></p>
<?php } endforeach;?>
