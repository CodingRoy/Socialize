<!DOCTYPE html>
<html lang="en">
<head>
    <title>Socialize</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="<?php echo URL ?>public/js/validate.js"></script>
    <script src="<?php echo URL ?>public/js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/ui.min.css">
</head>
<body>
  <header class="ui grid menu">
    <nav>
      <ul>
        <li><a class="item" href="<?php echo URL ?>" id="index"><i class="home icon"></i>Socialize</a></li>
        <li><a class="item" href="<?php echo URL ?>about" id="about"><i class="info icon"></i>About</a></li>
        <li><a class="item" href="<?php echo URL ?>dashboard" id="dashboard"><i class="comments icon"></i>Dashboard</a></li>
        <?php if (Session::get('loggedIn') == true):?>
          <li><a href="<?php echo URL; ?>user/profile/<?=Session::get('username')?>" data-item="profile" class="ui right floated item"><i class="user icon"></i><?=Session::get('username')?></a>
            <ul>
              <li><a class="item" href="<?php echo URL; ?>index/settings" id="settings"><i class="settings icon"></i>Settings</a></li>
              <li><a class="item" href="<?php echo URL; ?>index/logout" id="logout"><i class="sign out icon"></i>Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a class="ui right floated item" href="<?php echo URL ?>login"><i class="sign in icon"></i>Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <main role="main" class="ui grid content">
