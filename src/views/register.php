<h1>Register</h1>
<?php if ($err) echo "<p style='color:red;'>$err</p>"; ?>
<form method="post">
    <label>User: <input type="text" name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <button type="submit">Register</button>
</form>
<p><a href="index.php">Login</a></p>
<button id="dark-toggle" class="toggle"><span class="sun">☀</span><span class="moon">🌙</span><span class="knob"></span></button>
