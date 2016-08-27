<?php foreach($this->userinfo as $key => $value):?>
<p class="">Welcome to the profile of <?=$value['username']?>.</p>
<p class="">Registered at: <?=date("d-m-Y", strtotime($value['registration_date']))?>.</p>
<?php endforeach;?>
<p class="content"> Nothing more to find here, yet. </p>
