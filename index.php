<?php

get_header(); ?>
<img src="<?= get_template_directory_uri()?>/assets/img/Slider.jpg" alt="" />
<?php
$categories = get_categories(["hide_empty"=> 0]);
?>
<div class="max-w-screen flex flex-wrap">
    <?php foreach($categories as $category){
        if (function_exists('z_taxonomy_image'))
        echo '<div>'.z_taxonomy_image($category->term_id).'</div>';
    }?>

</div>
<div class="max-w-screen-lg mx-auto">
    <h2 class=" product-title text-center dual-color mb-10 mt-6">
        <span>آخرین</span>
        محصولات
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php while (have_posts()) : the_post();        
        $price = get_post_meta(get_the_ID(),'price', true);
        $finalprice = get_post_meta(get_the_ID(),'final_price', true);
        $cat = get_the_category();
        ?>
        <a href="<?=get_the_permalink()?>" class="post-box relative">
            <span class="cat"><?=$cat[0]->name?></span>
            <?php the_post_thumbnail(); ?>
            <span class="title">
            <?php the_title();?>
            </span>
            
            <?php if (!empty($price)) : ?>
            <span class="mx-auto price block w-fit">  
                <?= toFarsiNumerals(number_format($price,0,',','.'))?>
            </span>
            <?php endif;?>
            
            <?php if (!empty($finalprice)) : ?>
                <span class="mx-auto final-price block w-fit text-orange">
            <?= toFarsiNumerals(number_format($finalprice))?>
            </span>
            <?php endif;?>

        </a>
        <?php endwhile; ?>
    </div>

    <div class="py-5">
      <?php the_posts_pagination()?>  
    </div>

</div>

    

<?php get_footer() ?>