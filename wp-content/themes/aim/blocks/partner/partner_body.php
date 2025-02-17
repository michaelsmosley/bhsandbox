<?php $partners = get_field('partners_list'); ?>
<div class="aim__partners__slider">
    <?php foreach ($partners as $item): ?>
        <div class="aim__partners__slide">
            <h2 class="aim__partners__slide__headline">
                <?php echo $item['headline']; ?>
            </h2>
            <div class="aim__partners__slide__body">
                <?php echo $item['body']; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>