<!doctype html>
<html lang="en">
<?php function head($title) {?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>
        <?php echo $title;?>
    </title>
</head>
<?php } ?>
<?php function blockBegin() { ?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #a546fd;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">DATAN PROJECT</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/user/details?id=<?php echo UserController::getCurrentUserId()?>">Profile<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login">Sign in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/create">Sign up</a>
            </li>
            <li>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <hr class="mt-0 mb-4">
<?php } ?>
<?php function blockEnd() { ?>
        </div>
    </div>
</div>
</body>
</html>
<?php }?>
