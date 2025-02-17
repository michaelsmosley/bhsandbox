<?php
/**
 * Block Name: Video
 * Description: Video component with poster image and play button
 */

$video_poster = get_field('video_poster');
$video_url = get_field('video_url');
$video_title = get_field('video_title');

// Generate unique ID for the video component
$video_id = 'video-' . uniqid();
?>
<div class="video-block" id="<?php echo esc_attr($video_id); ?>" data-video-url="<?php echo esc_attr($video_url); ?>">
    <div class="video-block__wrapper">
        <?php if ($video_poster): ?>
            <div class="video-block__poster <?php echo esc_attr($video_id); ?>-poster">
                <?= get_responsive_image($video_poster, 1920, 1080) ?>
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