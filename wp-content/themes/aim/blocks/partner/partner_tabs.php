<?php $partners = get_field('partners_list'); ?>
<div class="aim__partners__tabs">
    <?php foreach ($partners as $index => $item): ?>
        <div class="aim__partners__tabs__tab" id="<?php echo $id.'_'.$index; ?>" idx="<?php echo $index; ?>">
            <?php if($item['active_logo'] && $item['inactive_logo']): ?>
                <div class="aim__partners__tabs__logo">
                    <img src="<?php echo $item['active_logo']['url']; ?>" alt="$item['active_logo']['alt']" class="aim__partners__tabs__logo--active"/>
                    <img src="<?php echo $item['inactive_logo']['url']; ?>" alt="$item['inactive_logo']['alt']" class="aim__partners__tabs__logo--inactive"/>
                </div>
            <?php else: ?>
                <div class="aim__partners__tabs__logo h4 aim__partners__tabs__logo--active">
                    <?php echo $item['headline']; ?>
                </div>
                <div class="aim__partners__tabs__logo h4 aim__partners__tabs__logo--inactive">
                    <?php echo $item['headline']; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>