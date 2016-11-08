<h1>Dashboard: <?php echo $this->header; ?></h1>
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
<?php foreach($this->overview as $key => $value):
  $fav = $value['favuser'] ? explode('|', $value['favuser']) : [];
  foreach($fav as $id => $array){
    if ($array == SESSION::get('user_id')) { ?>
			<a name="<?=$value['post_id']?>"></a>
      <div class="ui block post">
      <h3 class="title"><?=$value['post_title']?></h3>
      <p class="ui right floated"><strong><?=$value['username']?></strong> on <br><?=date("d-m-Y H:i:s", strtotime($value['post_date']))?></p>
      <p class="content"><?=$value['post_content']?></p>
			<a href="<?php echo URL ?>dashboard/fav/<?=$value['post_id']?>">
			<?php $fav = $value['favuser'] ? explode('|', $value['favuser']) : [];
			echo '<button class="ui info labeled ';
			foreach($fav as $id => $array){ echo ($array == SESSION::get('user_id')) ? 'active ' : '';}
			echo 'button">Favourite</button>';
			echo '</a><button class="ui label">'.$value['favcount'].'</button>';?><br>
      <a href="#<?=$value['post_id']?>" onclick="confirmation(<?=$value['post_id']?>)"><button class="ui warning button">Delete post</button></a>
      <p id="confirmation<?=$value['post_id']?>" style="display:none;">
      	<strong>Delete post '<?=$value['post_title']?>' ?</strong>
      	<a href="<?php echo URL ?>dashboard/delete/<?=$value['post_id']?>"><button class="ui danger button">Yes</button></a><a href="#" id="no<?=$value['post_id']?>"><button class="ui button">No</button></a>
      </p>
    <?php echo '</div>';}} endforeach;?>
