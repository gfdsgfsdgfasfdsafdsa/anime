<!doctype html>
<html lang="en">
<head>
    <title>Anime | Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= ROOTURL ?>assets/css/bootstrap.min.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="shortcut icon" href="<?= ROOTURL ?>images/icons/logo-icon.png" type="image/x-icon">

    <!-- Font awesome -->
    <link rel="stylesheet" href="<?= ROOTURL ?>assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= ROOTURL ?>assets/fontawesome/css/all.min.css">

    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?= ROOTURL ?>assets/css/style.green.css" id="theme-stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="<?= ROOTURL ?>css/admin-styles.css">
</head>
<style>
    *{
        font-weight: normal;
    }
    .lbl-text{
        font-size: 17px;
    }
</style>
<body>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Account Login</h1>
                            </div>
                            <p>Animeanime.</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <?php
                            if(Session::get('m')){
                                alert(Session::get('m'), 'danger'); Session::remove('m');
                            }
                            ?>
                            <?php if(isset($errorMgs)) alert('<strong>Error: </strong>'.$errorMgs, 'danger'); ?>
                            <form action="<?= ROOTURL ?>admin/sign-in" method="post" class="form-validate">
                                <div class="form-group">
                                    <input id="login-username" type="text" value="<?= setValue('username') ?>" name="username" data-msg="Please enter your username" class="input-material">
                                    <label for="login-username" class="label-material">Enter User Name</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" data-msg="Please enter your password" class="input-material">
                                    <label for="login-password" class="label-material">Enter Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= ROOTURL ?>assets/js/jquery.min.js"></script>
<script src="<?= ROOTURL ?>assets/js/popper.min.js"> </script>
<script src="<?= ROOTURL ?>assets/js/bootstrap.min.js"></script>
<script src="<?= ROOTURL ?>assets/readmore/src/readMoreJS.min.js"></script>
<script src="<?= ROOTURL ?>assets/js/front.js"></script>
</body>
</html>

