<?php
use  Elementor\Icons_Manager;

?>

<div class="stonex-testimonial_two_single stonex-testimonial__single">

    <?php if (!empty($item['rating_icon'])) : ?>
            <div class="rating_area">
                <?php for ($i = 0; $i < 5; $i++) :
                    $class = '';
                ?>
                    <?php if ($ratting > $i) {
                        $class = "active_color";
                    } ?>
                    <span class="inactive_color"><?php Icons_Manager::render_icon($item['rating_icon'], ['class' => $class, 'aria-hidden' => 'true']) ?></span>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <div class="testimonial-two-top-meta">
            <?php
            if (!empty($item['stonex_testimonial_content'])) {
                echo '<p class="stonex-testimonial__decription  stonex-size-'.$item['size'].'">' . $item['stonex_testimonial_content'] . '</p>';
            }

            ?>
    </div>

    <div class="testimonial-image-wrapper" >
        <div class="user-identity d-flex align-items-center">
            <div class="user-image">
                <?php
                if (!empty($item['stonex_testimonial_user_img'])) : ?>
                    <div class="stonex-testimonial__img">
                        <img src="<?php echo $item['stonex_testimonial_user_img']['url'] ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
            <div class="user-name-pos">
                <div class="stonex-testimonial__name">
                    <?php
                    if (!empty($item['stonex_testimonial_name'])) {
                        echo '<p class= "stonex-size-'.$item['name_size'].'" >' . $item['stonex_testimonial_name'] . '</p>';
                    }
                    ?>
                </div>
                <div class="stonex-testimonial__position">
                    <?php
                    if (!empty($item['stonex_testimonial_position'])) {
                        echo '<p class="stonex-size-'.$item['position_size'].'">' . $item['stonex_testimonial_position'] . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>