<?php
use  Elementor\Icons_Manager;
?>
<div class="stonex-testimonial__single">
    <div class="testimonial-wrapper">
        <div class="testimonial-image-wrapper d-flex">
            <div class="user-identity d-flex align-items-center">
                <div class="testimonial-image-area">
                    <?php
                    if (!empty($item['stonex_testimonial_user_img'])) : ?>
                        <div class="stonex-testimonial__img">
                            <img src="<?php echo $item['stonex_testimonial_user_img']['url'] ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="stonex-testimonial__bottom-meta">
                    <div class="stonex-testimonial__name">
                        <?php
                        if (!empty($item['stonex_testimonial_name'])) {
                            echo '<p class="stonex-size-'.$item['name_size'].'">'.$item['stonex_testimonial_name'] . '</p>';
                        }
                        ?>
                    </div>
                    <div class="stonex-testimonial__position">
                        <?php
                        if (!empty($item['stonex_testimonial_position'])) {
                            echo '<p class="stonex-size-'.$item['position_size'].'">'. $item['stonex_testimonial_position'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>

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


        </div>
        <div class="testimonial-content-wrapper">
            <div class="testimonial-content">
                <?php

                if (!empty($item['stonex_testimonial_content'])) {
                    echo '<p class=" stonex-testimonial__decription stonex-size-'.$item['size'].'">' . $item['stonex_testimonial_content'] . '</p>';
                }
                ?>
                 <?php 
                if ( 'yes' == $item['enable_rated_text'] ) {
                    echo '<p class="tm-bottom-text stonex-size-'.$item['review_size'].'"><span class="bottom-rated-text stonex-size-'.$item['rated_size'].'" >'.$item['rated_text'].'</span>'.$item['review_text'].'</p>';
                }
            ?>
            </div>

        </div>
    </div>
</div>