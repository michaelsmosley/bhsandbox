<?php get_header(); ?>
<div class="aim__bg">
</div>
<main class="aim__main">
    <?php
    $page_404 = get_page_by_path('404-2');
    if ($page_404):
        $post = $page_404;
        setup_postdata($post);
        the_content();
        wp_reset_postdata();
    endif;
    ?>
</main>

<?php get_footer(); ?>