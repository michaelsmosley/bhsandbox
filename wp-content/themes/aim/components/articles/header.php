<?php
    require_once 'list_query.php';
    $featured_query = get_posts_query();
    $search_value = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
?>
<div class="aim__blog__articles__header">
    <div class="aim__blog__articles__header__left">
        <h1 class="aim__blog__articles__heading">Articles</h1>
        <div class="aim__blog__articles__search-container">
            <input
                type="text"
                autofocus
                id="aim__blog__articles__search-input"
                class="aim__blog__articles__search-input"
                placeholder="Search"
                contenteditable="true"
            />
            <button
                type="button"
                id="aim__blog__articles__search-clear"
                class="aim__blog__articles__search-clear"
            >
                <?php require get_template_directory() . '/assets/icons/close_2.svg'; ?>
            </button>
            <div
                id="aim__blog__articles__search-icon"
                class="aim__blog__articles__search-icon"
            >
                <?php require get_template_directory() . '/assets/icons/magnifying-glass.svg'; ?>
            </div>
        </div>
    </div>
    <div class="aim__blog__articles__header__right">
        <span>
            <?php
                $results_count = $featured_query->found_posts;
                echo esc_html( $results_count ) . ' ' . ( $results_count == 1 ? 'Result' : 'Results' );
            ?>
            <?php if($search_value): ?>
                for
                <strong>
                     <?php echo $search_value ?>
                </strong>
            <?php endif; wp_reset_postdata() ?>
        </span>
    </div>
</div>
