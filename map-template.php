<?php
/*
 * Template Name: Map Template
 */
?>

<?php get_header(); ?>

<main id="main" class="page-main" role="main">
    <div id="map"></div>

    <script>
        function initMap() {
            var uluru = {lat: <?php echo get_theme_mod('latitude');?>, lng: <?php echo get_theme_mod('map-longitude');?>};
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: <?php echo get_theme_mod('map-zoom');?>, center: uluru});
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
</main>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_theme_mod('map-api');?>&callback=initMap">
</script>

<?php get_footer(); ?>
