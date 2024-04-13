<?php
use  Elementor\Icons_Manager;

?>

<div class="stonex-testimonial__single">

    <div class="testimonial-two-top-meta">
            <?php
            if (!empty($item['stonex_testimonial_content'])) {
                echo '<p class="stonex-testimonial__decription stonex-size-'.$item['size'].'">' . $item['stonex_testimonial_content'] . '</p>';
            }

            ?>
    </div>

    <div class="stonex-testimonial__meta-content testimonial-image-wrapper">
        <div class="user-identity">
            <div class="stonex-testimonial__name">
                <?php
                if (!empty($item['stonex_testimonial_name'])) {
                    echo '<p class="stonex-size-'.$item['name_size'].'" >' . $item['stonex_testimonial_name'] . '</p>';
                }
                ?>
            </div>
            <div class="stonex-testimonial__position">
                <?php
                if (!empty($item['stonex_testimonial_position'])) {
                    echo '<p class="stonex-size-'.$item['position_size'].'" >' . $item['stonex_testimonial_position'] . '</p>';
                }
                ?>
            </div>
        </div>
    </div>

</div>