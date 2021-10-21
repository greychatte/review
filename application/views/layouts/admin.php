<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="/public/images/favicon.png" type="image/x-icon">
        <title><?php echo $title; ?></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="/public/styles/materialize.min.css" rel="stylesheet">
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/materialize.min.js"></script>
    </head>
    <body >
       	<header>
            <div class="container">
            </div>
        </header>
        <main>
        	<div id="alert-msg" class="alertmsg"></div>
        	<?php echo $content; ?>
    	</main>
    </body>
</html>