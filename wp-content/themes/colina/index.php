<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
</head>

<body>
    <main>
        <?php get_header(); ?>
        <?php get_footer(); ?>
    </main>
</body>

</html>