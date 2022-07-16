<!DOCTYPE html>
<html lang="en">
<head>
    <title>Watch Anime Online, Watch Anime Online</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= ROOTURL ?>images/icons/logo-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= ROOTURL ?>css/styles.css">
</head>
<style>

</style>
<body>

<header>
    <nav>
        <div class="nav-left-items">
            <div class="btn-group">
                <button style="background-color: transparent; border: none; font-size: 30px; outline: none;"
                        class="text-primary" data-toggle="dropdown">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= ROOTURL ?>">Home</a>
                    <a class="dropdown-item" href="<?= ROOTURL ?>home">Browse</a>
                    <a class="dropdown-item" href="<?= ROOTURL ?>recently-added">Recently Updated</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#requestModal">Request</a>
                </div>
            </div>
            <div class="nav-logo">
                <img src="<?= ROOTURL ?>images/logo.png" alt="">
            </div>
        </div>
        <div class="nav-right-items">
<!--            <button class="btn btn-primary h-100 sign-in">Sign in</button>-->
<!--            <button class="btn btn-primary h-100 sign-in-icon fas fa-user" style="border-radius: 100%; width: 55px; display: none;"></button>-->
        </div>
    </nav>
</header>

<!-- Request Model -->
<form action="" method="post" class="modal fade" id="requestModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="py-4 px-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="text-center font-weight-bold text-primary" style="font-size: 25px">Send Your Request</h5>
                <p style="font-size: 14px" class="text-center">If the anime is not found in our library, you can send your
                    request here, we will try to make it available asap!</p>
                <div class="alert-modal-request"></div>
                <div class="input-group">
                    <input name="anime" type="text" class="form-control" placeholder="Anime name" style="background-color: #E6E6E6;border-color: #cccccc;border-right-color: transparent;" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text" style="border-left-color: transparent; background-color: #E6E6E6;">
                            <span class="fas fa-video"></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary w-100 mt-3 btn-anime-request" type="submit">Send Request</button>
                <div class="d-flex justify-content-center mt-2 request-load mb-n3">
                    <!--                    <div class="spinner-grow text-primary" role="status">-->
                    <!--                        <span class="sr-only">Loading...</span>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</form>


<div class="container d-flex justify-content-center flex-column" style="margin-top: 100px;">
    <div style="margin: 0 auto;">
        <img src="<?= ROOTURL ?>images/logo.png" style="width: 200px;">
    </div>
    <form action="<?= ROOTURL ?>search" method="get" class="input-group nav-search mt-5" style="max-width: 640px; margin: 0 auto;">
        <input type="text" name="keyword" class="form-control pl-4" placeholder="Enter anime name"
               style="height: 100%; padding: 15px 20px;border-top-left-radius: 10px; border-bottom-left-radius: 10px;" autocomplete="off">
        <div class="input-group-append">
            <button type="submit" class="input-group-text d-flex justify-content-center"
                    style="background-color: #007BFF; width: 90px; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                <span class="fas fa-search text-white"></span>
            </button>
        </div>
    </form>
    <div style="margin: 0 auto;" class="mt-2">anime - Just a better place to watch anime online for free!</div>
    <div style="margin: 0 auto;" class="mt-2">
        <a href="https://www.facebook.com/Oxysomeanimeofficial/" class="text-primary">
            <i class="fab fa-facebook"></i>
            Visit us on facebook</a>
    </div>
    <div style="margin: 0 auto;">
        <a href="<?= ROOTURL ?>home" class="btn btn-primary border-0 px-4 py-1 mt-3">Go to home page</a>
    </div>
</div>
