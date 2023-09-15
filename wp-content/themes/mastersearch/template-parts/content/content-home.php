<head>
    <style>
        .div-position {
            position: absolute;
            top: 25%;
            left: 23%;
        }

        body {
            background-color: #F9F9F9;
        }
        a {
            text-decoration: none;
            color: black;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 50%;
        }

        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .slick-list:focus {
            outline: none;
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: '';
        }

        .slick-track:after {
            clear: both;
        }

        .slick-loading .slick-track {
            visibility: hidden;
        }

        .slick-slide {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }

        [dir='rtl'] .slick-slide {
            float: right;
        }

        .slick-slide img {
            display: block;
        }

        .slick-slide.slick-loading img {
            display: none;
        }

        .slick-slide.dragging img {
            pointer-events: none;
        }

        .slick-initialized .slick-slide {
            display: block;
        }

        .slick-loading .slick-slide {
            visibility: hidden;
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }
        .slick-arrow.slick-hidden {
            display: none;
        }
        .slick-height{
            height: 200px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php
the_content();
?>
<?php
if (function_exists('the_custom_logo')) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id);
}
include "../wordpress/wp-content/themes/mastersearch/functions/getUniversities.php";
?>
<!--<div class="position-relative w-100">
    <img src="<?php echo bloginfo('url') . '/wp-content/uploads/2023/05/glasses-1024x768.jpg'; ?>" alt="Image" class="w-100" height="400rem">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-50" style="background-color: black;"></div>
    <div class="text-white text-center div-position fs-4">
        <p class="mt-3">
            Recherchez dans notre base de données des programmes de maîtrise, <br>
            y compris des programmes à temps partiel, à distance, <br>
            MA, MSc, MBA, MRes et MPhil,<br>
            ainsi que d'autres opportunités d'études de troisième cycle.<br><br>
        </p>
        <form class="d-flex justify-content-center" role="search">
            <a href="university_list/" target="_blank" rel="noopener noreferrer" class="btn btn-success me-4">Liste des universités</a>
            <a href="masters_list/" target="_blank" rel="noopener noreferrer" class="btn btn-success">Liste des masters</a>
        </form>
    </div>
</div>
<div class="mt-4 container">
    <h3 class="text-center">Catégories de recherche populaires</h3>
    <div class="row justify-content-center mb-5">
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-calculator fs-1"></i> <br><br>
                        Master Algèbre, Géométrie et analyse
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                    <i class="fa-solid fa-dna fs-1"></i> <br><br>
                        Biologie de l’Environnement
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                    <i class="fa-solid fa-joint fs-1"></i> <br><br>
                        Sciences des matériaux
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-atom fs-1"></i><br><br>
                        Sciences et techniques nucléaires
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-seedling fs-1"></i><br><br>
                        Amélioration et valorisation des ressources végétales
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-database fs-1"></i> <br><br>
                        Big Data et Cloud Computing
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-microchip fs-1"></i> <br><br>
                        Electronique embarquée
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mt-4 h-100">
                <div class="card-body">
                    <h5 class="text-center">
                        <i class="fa-solid fa-computer fs-1"></i> <br><br>
                        Génie Logiciel pour le Cloud
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="text-center my-4">Disciplines populaires</h3>
<div class="container bg-white p-3 rounded">
    <div class="row justify-content-center">
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-desktop fs-3"></i> <br> <span class="fs-5">Informatique</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 ms-3 mt-4">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-user-nurse fs-3"></i> <br> <span class="fs-5">Medcine</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-briefcase fs-3"></i> <br> <span class="fs-5">Commerce</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 ms-3 mt-4">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-book fs-3"></i> <br> <span class="fs-5">Droit</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-calculator fs-3"></i> <br> <span class="fs-5">Finance</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-microscope fs-3"></i> <br> <span class="fs-5">Biology</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-flask fs-3"></i> <br> <span class="fs-5">Chimie</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-brain fs-3"></i> <br> <span class="fs-5">Psychologie</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-globe fs-3"></i> <br> <span class="fs-5">Marketing</span>
                </a>
            </p>
        </div>
        <div class="col-md-2 mt-4 ms-3">
            <p class="text-center">
                <a href="">
                    <i class="fa-solid fa-book-open fs-3"></i> <br> <span class="fs-5">Eductaion</span>
                </a>
            </p>
        </div>
    </div>
</div>-->
<div class="container my-3">
    <div class="college slider">
        <?php
            foreach($universtiesLimit as $universty){
        ?> 
        <div class="slide bg-white rounded border text-center slick-height">
            <a href=<?= "universities?id=".$universty->id ?> target="_blank" rel="noopener noreferrer">
                <img src=<?="/wordpress/wp-content/uploads/".$universty->university_logo ?> alt="Image" class="w-75 mx-auto">
                <p class=""><?= $universty->university_name ?></p>
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<!--<img src=<?= $logo[0] ?> />-->
<!--<a href="index.php"><?php echo get_bloginfo('name') ?></a>-->
<script>
    $(document).ready(function() {
        //carroussel
        $('.college').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });
</script>