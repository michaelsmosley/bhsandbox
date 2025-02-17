<?php

/**
 * Block Name: Testimonials
 * Description: Testimonials block
 */
use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();
$is_blue = get_field('testimonials_color_theme') === "blue";
$selected_testimonials = get_field('select_testimonials');
$eyebrow = get_field('eyebrow');

if (!empty($selected_testimonials)) : ?>
    <div class="aim__testimonials <?php if ($is_blue) : echo 'aim__testimonials--blue'; endif; ?>" id="<?php echo $uuid ?>">
        <div class="aim__testimonials__background aim__testimonials__background--blue"></div>
        <div class="aim__testimonials__wrap">
            <?php if ($eyebrow) : ?>
                <div class="aim__testimonials__eyebrow">
                    <p><?php echo esc_html($eyebrow) ?></p>
                    <div class="aim__testimonials__eyebrow__line"></div>
                </div>
            <?php endif; ?>
            <div class="aim__testimonials__slider-wrap">
                <div class="aim__testimonials__slider">
                    <?php foreach ($selected_testimonials as $post) :
                        $image = get_field('image', $post->ID);
                        $responsive_image = 0;
                        if ($image) {
                            $responsive_image = get_responsive_image($image, 1920, 1080, $args = array(), $lqip = true);
                        }

                        $student_name = get_field('name', $post->ID);
                        $testimonial = get_field('testimonial', $post->ID);
                        $affiliation = get_field('affiliation', $post->ID);
                    ?>
                        <div class="aim__testimonials__slide">
                            <div class="aim__testimonials__slide__left">
                                <?php if ($responsive_image) : ?>
                                    <div class="aim__testimonials__image">
                                        <?php echo $responsive_image; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="aim__testimonials__slide__right<?php echo $image ? '--has-image' : ''; ?>">
                                <p class="aim__testimonials__content"><?php echo $testimonial; ?></p>
                                <p class="aim__testimonials__name aim__testimonials__content"><?php echo esc_html($student_name); ?></p>
                                <p class="aim__testimonials__affiliation h7"><?php echo esc_html($affiliation); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="aim__testimonials__footer <?php if ($is_blue) : echo 'aim__testimonials__footer--white'; endif; ?>">
            <div class="aim__testimonials__footer__numbers">
                <span id="current-slide-index">1</span>
                <span class="aim__testimonials__footer__total">/<?php echo count($selected_testimonials); ?></span>
            </div>
            <div class="aim__testimonials__footer__buttons">
                <button class="aim__testimonials__prev-button <?php if ($is_blue) : echo 'aim__testimonials__prev-button--white'; endif; ?>" aria-label="Previous Slide">
                    <?php require get_template_directory() . '/assets/icons/arrow-right.svg' ?>
                </button>
                <button class="aim__testimonials__next-button <?php if ($is_blue) : echo 'aim__testimonials__next-button--white'; endif; ?>" aria-label="Next Slide">
                    <?php require get_template_directory() . '/assets/icons/arrow-right.svg' ?>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>