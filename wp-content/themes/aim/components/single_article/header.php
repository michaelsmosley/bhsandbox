<?php
    $featured_image = get_field("featured_image");
?>
<header class="aim__blog__header">
    <div></div>
    <div>
        <?php generate_breadcrumbs(); ?>
        <h1 class="aim__blog__header__title">
            <?php the_title(); ?>
        </h1>
    </div>
    <?php require_once get_template_directory() . '/components/single_article/sidebar.php'; ?>
    <?php echo get_responsive_image($featured_image, 646, 430); ?>
</header>
