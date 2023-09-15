<?php
    get_header();
?>
    <h1 class="text-inline"><?php the_title() ?></h1>
<?php
    if(have_posts()){
        while(have_posts()){
            the_post();
            get_template_part('template-parts/content/content-posts');
        }
    }
    get_footer();
?>