<?php foreach($this->userinfo as $key => $value):?>
<p class="">Welcome to your profile <?=$value['username']?>.</p>
<p class="">You registered at: <?=$value['registration_date']?>.</p>
<p class="">You registered with <?=$value['email']?> as your email address. </p>
<?php endforeach;?>
<p class="content"> Nothing more to find here, yet. </p>
