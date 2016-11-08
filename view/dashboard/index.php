<h1>Dashboard</h1>
<h2> Post your message: </h2>
<h5> Press TAB to switch section easier.</h5>
<p class="ui field title">Post title:</p>
<form action="<?php echo URL ?>dashboard/post" method="post">
	<input class="ui field rounded" type="text" name="Post_title" placeholder="Enter your title here">
	<p class="ui field title">Post message:</p>
	<textarea class="ui text field rounded" type="text" name="Post" placeholder="Enter your message here" rows="4" onkeyup="checkSubmit(event)"></textarea>
	<input class="" id="post" type="submit" value="Post"/>
</form>
<script type="text/javascript">
	document.getElementById("post").style.display = "none";
</script>
<h2> All posts </h2>
<?php foreach($this->overview as $key => $value):?>
<div class="ui block post">
	<a name="<?=$value['post_id']?>"></a>
		<h3 class="title"><?=$value['post_title']?></h3>
		<p class="ui right floated"><strong><?=$value['username']?></strong> on <?=date("d-m-Y H:i:s", strtotime($value['post_date']))?></p>
		<p class="content"><?=$value['post_content']?></p>
		<a href="<?php echo URL ?>dashboard/fav/<?=$value['post_id']?>">
		<?php $fav = $value['favuser'] ? explode('|', $value['favuser']) : [];
		echo '<button class="ui info labeled ';
		foreach($fav as $id => $array){ echo ($array == SESSION::get('user_id')) ? 'active ' : '';}
		echo 'button">Favourite</button>';
		echo '</a><button class="ui label">'.$value['favcount'].'</button>';
		if ($value['post_by'] === Session::get('user_id')){ ?>
		<p class=""><a href="#<?=$value['post_id']?>" onclick="confirmation(<?=$value['post_id']?>)">Delete this post</a></p>
		<p id="confirmation<?=$value['post_id']?>" style="display:none;">
			Delete post '<?=$value['post_title']?>'?
			<a href="<?php echo URL ?>dashboard/delete/<?=$value['post_id']?>"> Yes</a>, <a href="#<?=$value['post_id']?>" id="no<?=$value['post_id']?>">No</a>
		</p>
	<?php } echo "</div>"; endforeach;?>
