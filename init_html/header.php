<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="/css/bootstrap.min.css"> <!-- Bootstrap -->
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>
<header>
    <!-- navigation	menu -->
    <nav id="navfix" class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/index.php"><img class="img img-responsive" src="/favicon.png"/> Key
                Distribution
                System</a>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- Tempory navigation for different site functions -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($logged) { ?>
                        <li><span>Welcome, <strong><?php echo $user->getUsername() ?>!</strong></span></li>
                        <li><a href="/index.php?logout=1">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="/login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        <!-- <hr class="shadow"> -->
    </nav>
    <!-- <div id="forfixednav">
    </div> -->
</header><!-- Header end, Wrapper Start -->
<div class="container">
