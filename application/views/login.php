<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?= base_url('assets/css/style-login.css'); ?>">
  <title>Document</title>
</head>
<body>
  <div class="form-wrapper">
    <form method='POST' action=<?= base_url('login'); ?>>
      <div class="form-group">
        <h1>Login</h1>
        <label for="email">Email</label>
        <input type="email" name="email" id='email'  value=<?= set_value('email'); ?>>
        <?= form_error('email');?>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value=<?= set_value('password'); ?>>
        <?= form_error('password');?>
      </div>
      <button type="submit">Login</button>
    </form>
    <ul>
      <li><a href="https://asharifauzan.github.io" target="_blank">Portofolio</a></li>
      <li><a href="https://github.com/asharifauzan/CI-Product-Management" target="_blank">GitHub</a></li>
    </ul>
  </div>
</body>
</html>
