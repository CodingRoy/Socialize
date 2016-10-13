<?php foreach($this->userinfo as $key => $value):?>
<p class="">Welcome to your profile <?=$value['username']?>.</p>
<p class="">You registered at: <?=date("d-m-Y", strtotime($value['registration_date']))?>.</p>
<p class="">You registered with <?=$value['email']?> as your email address. </p>
<?php endforeach;?>
<p class="">Do you want to leave? We're sorry to hear that, <a href="#" onclick="confirmation(1)">clik here to delete your account.</a></p>
<p id="confirmation1" style="display:none;"> Are you sure you want to delete your account? <a href="<?php echo URL?>user/delete">Yes</a>, <a href="#" id="no">No</a></p>
<p class="content"> Nothing more to find here, yet. </p>
