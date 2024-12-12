<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?=get_home_url()?>/" target="_self">
    <link rel="icon" type="image/png" href="<?=get_template_directory_uri()?>/assets/img/logo.png">
    <?php wp_head() ?>
</head>

<body <?php body_class('flex flex-col') ?> >
    <?php wp_body_open(); ?>

    <header class="px-4">
        <div class="flex max-w-screen-xl mx-auto h-[70px]">
            <div class="flex-none  pl-1">
                <a class="relative z-2" href="<?php echo home_url() ?>">
                    <?php the_custom_logo()?>
                </a>
            </div>
            <div id="menu" class="flex-1 pt-1">
                <button class="menu-icon block md:hidden mt-6" onclick="jQuery('#menu').toggleClass('open')"></button>
                <div id="menu-items" class="pt-5 hidden md:block text-center">
                    <?= wp_nav_menu(array('theme_location' => 'header-menu')); ?>
                </div>
            </div>
            <div class="flex-none pt-2" id="search-container">
                
            </div>
        </div>
    </header>

    <main class="flex-auto">