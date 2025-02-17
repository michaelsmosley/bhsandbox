<div id="logo" class="aim__header__logo <?php if(is_front_page()) {echo 'aim__header__logo--homepage'; } else {echo 'aim__header__logo--page'; } ?>">
    <div id="logo-backdrop"></div>
    <a href="<?php echo get_home_url(); ?>">
        <?php require get_template_directory() . "/assets/svg/aim-logo.svg" ?>
    </a>
</div>
