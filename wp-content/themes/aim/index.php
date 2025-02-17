<?php
    get_header();
    $post_id = get_the_ID();
    $block_name = 'acf/homepage-hero';
    $is_hero_block = false;
    $check = has_block_in_page_content($page_id, $block_name);
    if ($check['exists'] && $check['is_first']) {
        $is_hero_block = true;
    }

    $block_name_2 = 'acf/hero';
    $is_hero_block_2 = false;
    $check_2 = has_block_in_page_content($page_id, $block_name_2);
    if ($check_2['exists'] && $check_2['is_first']) {
        $is_hero_block_2 = true;
    }

    $class = "";
    if (!$is_hero_block && !$is_hero_block_2) {
        $class = 'aim__main--spacing--extra';
    } else if(!$is_hero_block && $is_hero_block_2) {
        $class = 'aim__main--spacing';
    };
?>
<div class="aim__bg">
</div>
<main class="aim__main <?php echo $class; ?>">
    <?php if (have_posts()):
        while (have_posts()):
            the_post();
            the_content();
        endwhile;
    endif; ?>
</main>

<?php get_footer(); ?>
