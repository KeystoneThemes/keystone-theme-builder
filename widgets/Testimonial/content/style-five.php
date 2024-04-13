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
<div class="stonex-testimonial_five_single stonex-testimonial__single">
    <div class="stonex-testimonial__meta-content">
        <div class="user-image">
            <?php
            if (!empty($item['stonex_testimonial_user_img'])) : ?>
                <div class="stonex-testimonial__img">
                    <img src="<?php echo $item['stonex_testimonial_user_img']['url'] ?>" alt="">
                </div>
            <?php endif; ?>
        </div>
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
            <div class="user-identity">
                <div class="stonex-testimonial__name">
                    <?php
                    if (!empty($item['stonex_testimonial_name'])): ?>
                        <p class="stonex-size-<?php echo $item['name_size'] ?> " ><?php echo esc_html( $item['stonex_testimonial_name'] ) ?> </p>
                    <?php endif; ?>
                </div>
                <div class="stonex-testimonial__position">
                    <?php
                    if (!empty($item['stonex_testimonial_position'])): ?>
                        <p class="stonex-size-<?php echo $item['position_size'] ?>"><?php echo esc_html( $item['stonex_testimonial_position'] )?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>