<?php

/**
 * Block Name: Text and Image
 * Description: Text and Image block with title, text, button, and image or video.
 */

$headline = get_field('headline');
$body = get_field('body');
$button_url = get_field('button_url');
$custom_button_url = get_field('custom_button_url');
$button_label = get_field('button_label');

// Use custom URL if provided, otherwise use page link
$final_button_url = $custom_button_url ? $custom_button_url : $button_url;

$media_alignment = get_field('media_alignment');
$aspect_ratio = get_field('aspect_ratio');
$media_type = get_field('media_type');

$image = get_field('image');

$video_url = get_field('video_url');
$video_poster = get_field('video_poster');
$video_id = 'video-' . uniqid();
?>

<div class="aim__text-and-image">
    <div class="aim__text-and-image__text">
        <div class="aim__text-and-image__text__body">
            <?php if ($headline): ?>
                <p class="h4"><?php echo esc_html($headline); ?></p>
            <?php endif; ?>
            <?php if ($body): ?>
                <div class="body-m"><?php echo $body; ?></div>
            <?php endif; ?>
        </div>
        <?php if ($final_button_url && $button_label): ?>
            <a href="<?php echo esc_url($final_button_url); ?>"
                class="btn btn-primary aim__text-and-image__text__button button-l">
                <?php echo esc_html($button_label); ?>
                <?php include get_template_directory() . '/assets/icons/arrow-top-right.svg'; ?>
            </a>
        <?php endif; ?>
    </div>
    <?php if ($image and $media_type !== "video"): ?>
        <div
            class="aim__text-and-image__media aim__text-and-image__media--<?php echo esc_attr($media_alignment); ?> aim__text-and-image__media--ratio-<?php echo esc_attr($aspect_ratio); ?>">
            <?php echo get_responsive_image($image, 646, 430); ?>
        </div>
    <?php elseif(!$image and $video_url and $media_type == "video"): ?>
    <?php $video_id = 'video-' . uniqid(); ?>
    <div class="aim__text-and-image__media aim__text-and-image__media--<?php echo esc_attr($media_alignment); ?>">
        <div class="video-block" id="<?php echo esc_attr($video_id); ?>" data-video-url="<?php echo esc_attr($video_url); ?>">
            <div class="video-block__wrapper">
                <?php if ($video_poster): ?>
                    <div class="video-block__poster <?php echo esc_attr($video_id); ?>-poster">
                        <?= get_responsive_image($video_poster, 646, 430) ?>
                        <button class="video-block__play-button" aria-label="Play video">
                            <?php include get_template_directory() . '/blocks/video/play.svg'; ?>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="video-block__video-container" style="display: none;">
                    <!-- Video iframe will be injected here via JavaScript -->
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>