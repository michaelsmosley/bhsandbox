<?php $partners = get_field('partners_list'); ?>
<div class="aim__partners--mobile__tabs">
    <?php foreach ($partners as $index => $item):
        $media_type = $item['media_type'];
        $image = $item['image'];
        $video_url = $item['video_url'];
        $video_poster = $item['video_poster'];
        $uuid = uniqid();
    ?>
        <div class="aim__partners--mobile__tabs__tab" id="<?php echo $id.'_'.$index; ?>" idx="<?php echo $index; ?>">
            <?php if($item['active_logo'] and $item['inactive_logo']): ?>
                <div class="aim__partners--mobile__tabs__logo">
                    <img src="<?php echo $item['active_logo']['url']; ?>" alt="$item['active_logo']['alt']" class="aim__partners--mobile__tabs__logo--active"/>
                    <img src="<?php echo $item['inactive_logo']['url']; ?>" alt="$item['inactive_logo']['alt']" class="aim__partners--mobile__tabs__logo--inactive"/>
                </div>
            <?php else: ?>
                <div class="aim__partners--mobile__tabs__logo h5">
                    <?php echo $item['headline']; ?>
                </div>
            <?php endif; ?>
            <div>
                <span class="aim__partners--mobile__tabs__tab__icon--plus">
                    <?php include get_template_directory() . '/assets/icons/plus-black.svg'; ?>
                </span>
                <span class="aim__partners--mobile__tabs__tab__icon--minus">
                    <?php include get_template_directory() . '/assets/icons/minus-black.svg'; ?>
                </span>
            </div>
        </div>
        <div class="aim__partners--mobile__tabs__content" id="tab_content_<?php echo $index; ?>">
            <?php if($media_type !== 'no_media'): ?>
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
            <div class="aim__partners__slider">
                <div class="aim__partners__slide">
                    <h2 class="aim__partners--mobile__headline">
                        <?php echo $item['headline']; ?>
                    </h2>
                    <div class="aim__partners--mobile__body">
                        <?php echo $item['body']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>