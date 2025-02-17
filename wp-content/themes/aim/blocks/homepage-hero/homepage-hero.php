<?php
    /**
     * Block Name: Homepage Hero
     * Description: Homepage Hero block with background image or video and text overlay.
     */

    $image_or_video = get_field('image_or_video'); // Image array with type and URL
    $video_url = get_field('video_url'); // Video URL (YouTube or Vimeo)
    $video_poster_url = get_field('video_poster_image'); // Poster image URL

    $heading = get_field('heading');
    $sub_heading = get_field('sub_heading');
?>

<div class="aim__homepage-hero">
    <div class="aim__homepage-hero__content">
        <div class="aim__homepage-hero__media">
            <?php
                if ($video_poster_url) {
                    echo get_responsive_image(
                        $video_poster_url,
                        1920,
                        900,
                        [
                            'container_class' => 'aim__homepage-hero__media__image',
                            'alt' => esc_attr($heading),
                            'priority' => true,
                            'lazy' => false,
                            'format' => 'jpeg',
                            'quality' => 30,
                            'size' => 'max'
                        ],
                        true
                    );
                }
                if ($video_url) {
                    if (strpos($video_url, 'vimeo.com') !== false) {
                        $srcVimeo = mergeQueryParams($video_url, [
                            "autoplay" => 1,
                            "muted" => 1,
                            "loop" => 1,
                            "controls" => 0,
                            "title" => 0,
                            "byline" => 0,
                            "portrait" => 0,
                            "background" => 1,
                        ]);
                        echo '<iframe class="aim__homepage-hero__media__video" width="100%" height="100%" src="' . esc_url($srcVimeo) . '" frameborder="0" allow="autoplay; muted"></iframe>';
                    } elseif (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                        $srcYouTube = mergeQueryParams($video_url, [
                            "autoplay" => 1,
                            "muted" => 1,
                            "loop" => 1,
                            "controls" => 0,
                        ]);
                        echo '<iframe class="aim__homepage-hero__media__video" width="100%" height="100%" src="' . esc_url($srcYouTube) . '" frameborder="0" allow="autoplay; muted"></iframe>';
                    }
                } elseif ($image_or_video) {
                    if ($image_or_video['type'] === 'image') {
                        echo get_responsive_image(
                            $image_or_video,
                            1920,
                            900,
                            [
                                'container_class' => 'aim__homepage-hero__media__image',
                                'alt' => esc_attr($heading),
                                'priority' => false,
                                'lazy' => true,
                                'format' => 'jpeg',
                                'quality' => 90,
                                'size' => 'max'
                            ],
                            true
                        );
                    } elseif ($image_or_video['type'] === 'video') {
                        echo '<video class="aim__homepage-hero__media__video" autoplay muted loop playsinline poster="' . esc_url($video_poster_url) . '">
                            <source src="' . esc_url($image_or_video['url']) . '" type="video/mp4">
                          </video>';
                    }
                }
            ?>
        </div>
        <div class="aim__homepage-hero__heading">
            <div>
                <?php if ($sub_heading) : ?>
                    <h2><?php echo esc_html($sub_heading); ?></h2>
                <?php endif; ?>
                <?php if ($heading) : ?>
                    <h1><?php echo esc_html($heading); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>