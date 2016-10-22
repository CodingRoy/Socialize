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
 //make a non JQuery javascript to submit post on enter
</script>
<p class=""> All posts </p>
<?php foreach($this->overview as $key => $value):?>
<hr>
<p class=""><?=$value['post_title']?></p>
<p class=""><strong><?=$value['username']?></strong> on <?=date("d-m-Y H:i:s", strtotime($value['post_date']))?></p>
<p class=""><?=$value['post_content']?></p>
<p class="">
<?php $fav[] = $value['favuser'] ? explode('|', $value['favuser']) : [];
foreach($fav as $key => $array){
echo ($key == SESSION::get('user_id')) ? 'Including you ' : ''; } ?>
<?=$value['favcount']?>
<?php echo ($value['favcount'] != 1) ? ' people' : ' person'; ?> marked this as favourite
<?php if ($value['post_by'] === Session::get('user_id')){ ?></p>
<p class=""><a href="#" onclick="confirmation(<?=$value['post_id']?>)">Delete this post</a></p>
<p id="confirmation<?=$value['post_id']?>" style="display:none;">Delete post '<?=$value['post_title']?>'?<a href="<?php echo URL ?>/dashboard/delete/<?=$value['post_id']?>"> Yes</a>, <a href="#" id="no">No</a></p>
<?php } endforeach;?>
