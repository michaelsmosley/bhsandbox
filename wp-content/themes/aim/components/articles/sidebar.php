<?php
    $selected_categories = array();
    if ( isset( $_GET['categories'] ) && ! empty( $_GET['categories'] ) ) {
        $selected_categories = array_map( 'absint', explode( ',', $_GET['categories'] ) );
    }

    $selected_tags = array();
    if ( isset( $_GET['tags'] ) && ! empty( $_GET['tags'] ) ) {
        $selected_tags = array_map( 'absint', explode( ',', $_GET['tags'] ) );
    }

    $search_value = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';

    $categories = get_categories([
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
    ]);

    $tags = get_tags([
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
    ]);
?>

<div class="aim__blog__articles__sidebar">
    <button id="toggleMobileFiltersButton" class="aim__blog__articles__toggle-button">
        <div>Filters</div>
        <?php include get_template_directory() . '/assets/icons/chevron-down.svg'; ?>
    </button>
    <div id="toggleMobileFiltersContent" class="aim__blog__articles__toggle-content">
 <!-- CATEGORIES -->
    <h3 class="aim__blog__articles__tags-title">Categories</h3>
    <ul class="aim__blog__articles__categories-list">
        <?php foreach ( $categories as $category ) :
            $is_cat_selected = in_array( $category->term_id, $selected_categories, true );
            $li_class = 'aim__blog__articles__category-item';
            if ( $is_cat_selected ) {
                $li_class .= ' aim__blog__articles__category-item--checked';
            }
            ?>
            <li class="<?php echo esc_attr( $li_class ); ?>">
                <label>
                    <input
                        type="checkbox"
                        class="aim__blog__articles__category-checkbox"
                        data-category-id="<?php echo esc_attr( $category->term_id ); ?>"
                        <?php checked( $is_cat_selected ); ?>
                    />
                    <?php echo esc_html( $category->name ); ?>
                    <div class="aim__blog__articles__close-box">
                        <?php require get_template_directory() . '/assets/icons/close_2.svg'; ?>
                    </div>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- TAGS -->
    <h3 class="aim__blog__articles__tags-title">Popular Tags</h3>
    <ul class="aim__blog__articles__tags-list">
        <?php foreach ( $tags as $tag ) :
            $is_tag_selected = in_array( $tag->term_id, $selected_tags, true );

            $li_class = 'aim__blog__articles__tag-item';
            if ( $is_tag_selected ) {
                $li_class .= ' aim__blog__articles__tag-item--checked';
            }
            ?>
            <li class="<?php echo esc_attr( $li_class ); ?>">
                <label>
                    <input
                        type="checkbox"
                        class="aim__blog__articles__tag-checkbox"
                        data-tag-id="<?php echo esc_attr( $tag->term_id ); ?>"
                        <?php checked( $is_tag_selected ); ?>
                    />
                    <span><?php echo esc_html( $tag->name ); ?></span>
                    <div class="aim__blog__articles__close-box">
                        <?php require get_template_directory() . '/assets/icons/close_2.svg'; ?>
                    </div>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>

    <button
        type="button"
        id="aim__blog__articles__clear"
        class="aim__blog__articles__reset-filter btn btn-primary btn-primary-small"
    >
        Reset
    </button>
    </div>
</div>
