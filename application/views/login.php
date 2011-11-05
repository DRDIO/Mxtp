<style>

.login {
    margin: auto;
    width: 480px;
    font-size: 36px;
    font-weight: bold;
    margin-top: 16px;
}

.login input {
    border: none;
    color: #fff;
    font-size: 48px;
    -webkit-box-sizing: border-box;
    -mox-box-sizing: border-box;
    box-sizing: border-box;
    padding: 4px 8px;
}

.login input[type="text"], .login input[type="password"] {
    background: #555;
    width: 480px;
    outline: none;
    margin: 8px 0 16px 0;
}

.login input[type="submit"] {
    font-size: 36px;
    cursor: pointer;
    float: right;
    border: none;
    background: #B256A9;

    -moz-border-radius-topleft: 16px;
    -webkit-border-top-left-radius: 16px;
    border-top-left-radius: 16px;
}

</style>

<div class="login">
    <form method="post" action="login/login">
    // Username<br />
    <input type="text" name="username" /><br />
    // Password<br />
    <input type="password" name="password" /><br />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
    <input type="submit" value="Login!" />
    </form>
</div>