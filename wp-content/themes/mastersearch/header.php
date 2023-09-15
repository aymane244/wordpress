<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head() ?>
    <style>
        .pointer {
            cursor: pointer;
        }
        .hide{
            display: none;
        }
        .show{
            display: block;
        }
        li{
            list-style: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                include "classes/Walker.php";
                wp_nav_menu(
                    array(
                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul id="" class="navbar-nav mx-auto mb-2 mb-lg-0">%3$s</ul>',
                        'walker' => new BootstrapNavBar(),
                        // 'link_before' => '<a class="nav-link" href="">',
                        // 'link_after' => '</a>',
                    )
                );
                ?>
                <div class="d-flex" role="search">
                    <i class="fa-solid fa-magnifying-glass pointer text-success fs-5" id="search"></i>
                </div>
                <?php 
                    if(isset($_SESSION['email'])){
                ?> 
                <li class="nav-item dropdown mx-5">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/wordpress/wp-content/themes/mastersearch/functions/logout.php">Déconnecter</a>
                        </li>
                    </ul>
                </li>
                <?php        
                    }else{
                ?>
                <div class="d-flex ms-4">
                    <a href="login" class="btn btn-success"><i class="fa-solid fa-user"></i> Se connecter</a>
                </div>
                <?php        
                    }
                ?>
            </div> 
        </div>
    </nav>
    <div class="bg-white py-3 hide" id="show-search">
        <div class="my-3 w-50 mx-auto">
            <form class="d-flex" role="search" action="" method="POST">
                <input class="form-control me-2" type="search" placeholder="Chercher un master" aria-label="Chercher in master" name="search_master">
                <button class="btn btn-success" type="submit" name="submit_search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#search").click(function() {
                $("#show-search").toggleClass("show")
            })
        });
    </script>