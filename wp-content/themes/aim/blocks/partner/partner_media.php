<?php
    $partners = get_field('partners_list');
    $id = uniqid();
    $video_id = 'video-' . $id;

    if(!$partners) {
        return '';
    }
?>

<div class="aim__partners__media-wrapper">
    <?php foreach ($partners as $item):
        $media_type = $item['media_type'];
        $image = $item['image'];
        $video_url = $item['video_url'];
        $video_poster = $item['video_poster'];
        if($media_type !== 'no_media' || !$image): ?>
            <div class="aim__partners__media">
                <?php
                    if ($media_type === 'image') {
                        echo get_responsive_image(
                            $image,
                            1920,
                            900,
                            array(
                                'container_class' => 'aim__partners__image',
                                'alt' => esc_attr($eyebrow),
                                'priority' => true,
                                'lazy' => false,
                                'format' => 'jpeg',
                                'quality' => 90,
                                'size' => 'max'
                            ),
                            true,
                        );
                    } else if ($media_type === 'video' && $video_url && $video_poster):
                ?>
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
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
