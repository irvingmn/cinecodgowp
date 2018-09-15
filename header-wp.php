<header class="WP-Header">
    <?php  
    if(has_custom_header()):
        twentythirteen_custom_header_marup();
    endif; 
    ?>
    <div class="WP-Heaer-brandig">
        <h1 class="WP-Header-title">
            <a href="<?php  echo esc_url(home_url('/'));?>"><?php  bloginfo('name'); ?></a>
        </h1>
        <p class="WP-Header-description"><?php  bloginfo('description'); ?></p>

    </div>
</header>