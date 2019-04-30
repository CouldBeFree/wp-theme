<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside class="sidebar">
    <div class="sidebar__top">
        <img src="<?php echo get_field('sidebar_image');?>" alt="sidebar-image">
        <?php echo get_field('sidebar-text') ?>
    </div>
    <?php
        $video = get_field('video');
        $subheadline = get_field('video_subheadline');
    ?>
    <?php if($video):?>
        <div class="sidebar__bottom">
            <div class="video-holder">
                <img src="<?php echo get_field('video_play');?>" alt="play" id="video-play">
                <video src="<?php echo $video?>" id="video"></video>
            </div>
            <?php echo $subheadline?>
        </div>
    <?php endif;?>
</aside>
