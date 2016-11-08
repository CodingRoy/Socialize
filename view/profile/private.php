<div class="ui fluid block post">
  <?php foreach($this->userinfo as $key => $value):?>
  <h1 class="title">Welcome to your profile <?=$value['username']?>.</h1>
  <p class="content">You registered at: <?=date("d-m-Y", strtotime($value['registration_date']))?>.</p>
  <p class="">You registered with <?=$value['email']?> as your email address. </p>
  <?php endforeach;?>
  <p class="">Do you want to leave? We're sorry to hear that, <br>
  <a href="#" class="ui warning button" onclick="confirmation(1)">Delete your account.</a></p>
  <p id="confirmation1" style="display:none;"><strong>Are you sure you want to delete your account?</strong>
  <a href="<?php echo URL?>user/delete"><button class="ui danger button">Yes</button></a><a href="#" id="no1"><button class="ui button">No</button></a></p>
  <p class=""> Nothing more to find here, yet. </p>
</div>
