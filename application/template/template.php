<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo html::specialchars($title); ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="/css/template.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.7.2.custom.css" media="screen" />

        <link rel="shortcut icon" href="/favicon.ico" />

        <script type="text/javascript" src="/js/core/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="/js/core/jquery-ui/js/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="/js/swfobject.js"></script>
        <script type="text/javascript" src="/js/playlist_player.js"></script>
        <script type="text/javascript" src="/js/search.js"></script>
        <script type="text/javascript" src="/js/create.js"></script>

        <?php foreach ($cssFiles as $cssFile): echo html::stylesheet($cssFile, null, false); endforeach; ?>
        <?php foreach ($jsFiles as $jsFile): echo html::script($jsFile, null, false); endforeach; ?>
    </head>

    <body>
        <div id="page">
            <div id="header">
                <a href="/" id="logo">
                    // MXTP.me
                </a>
                <div id="headerlinks">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/listen">Listen</a></li>
                        <li><a href="/create">Create</a></li>
                        <li><a href="/profile">Profile</a></li>
                        <li><a href="/twitter">Twitter</a></li>
<?php if (!$loggedIn): ?>
                        <li style="float: right;"><a href="/login">Login</a></li>
                        <li style="float: right; background: #B256A9;"><a href="/register">Register</a></li>
<?php else: ?>
                        <li style="float: right;"><a href="/logout">Logout</a></li>
<?php endif; ?>
                    </ul>
                </div>
            </div>

            <div id="content">
                <?php echo $content; ?>
            </div>
        </div>
    </body>
</html>
