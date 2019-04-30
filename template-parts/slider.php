<?php if( get_field('slider')): ?>
    <?php while( the_repeater_field('slider') ): ?>
        <div class="image-item item">
            <img src="<?php the_sub_field('image'); ?>" alt="label">
        </div>
    <?php endwhile; ?>
<?php endif; ?>