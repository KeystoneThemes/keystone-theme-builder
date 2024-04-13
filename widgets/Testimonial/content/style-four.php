<?php
/**
 * @author [jaism]
 * @email [jasimnwu41@gmail.com]
 * @create date 2022-08-23 12:15:00
 * @modify date 2022-08-23 12:15:00
 * @desc [description]
 */
?>
<?php
use  Elementor\Icons_Manager;
?>
<div class="stonex-testimonial_four_single stonex-testimonial__single">
    <div class="stonex-testimonial__meta-content">
        <div class="testimonial-content">
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
            <?php
            if (!empty($item['stonex_testimonial_content'])) : ?>
                <p class="stonex-size-<?php echo $item['size'] ?> stonex-testimonial__decription"> <?php echo $item['stonex_testimonial_content'] ?></p>
            <?php endif; ?>
            <?php 
                   
            if ( 'yes' == $item['enable_rated_text'] ) {
                echo '<p class="tm-bottom-text stonex-size-'.$item['review_size'].'"><span class="bottom-rated-text stonex-size-'.$item['rated_size'].'" >'.$item['rated_text'].'</span>'.$item['review_text'].'</p>';
            }
                 
            ?>
        </div>
    </div>
</div>