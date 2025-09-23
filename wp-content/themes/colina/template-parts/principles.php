<?php
$option_name = preg_replace("/\W/", "_", strtolower(get_option('stylesheet')));
$theme_options = get_option($option_name);
?>

<div class="principles-grid">
    <div class="principle-card div1">
        <div class="principle-icon">
            <img src="<?php echo $theme_options['principle_1_image']; ?>" alt="<?php echo $theme_options['principle_1_title']; ?>">
        </div>
        <div class="content">
            <div class="principle-title"><?php echo $theme_options['principle_1_title']; ?></div>
            <div class="principle-content">
                <?php echo $theme_options['principle_1_content']; ?>
            </div>
        </div>
    </div>
    <div class="principle-card div2">
        <div class="principle-icon">
            <img src="<?php echo $theme_options['principle_2_image']; ?>" alt="<?php echo $theme_options['principle_2_title']; ?>">
        </div>
        <div class="content">
            <div class="principle-title"><?php echo $theme_options['principle_2_title']; ?></div>
            <div class="principle-content">
                <?php echo $theme_options['principle_2_content']; ?>
            </div>
        </div>

    </div>
    <div class="principle-card div3">
        <div class="principle-icon">
            <img src="<?php echo $theme_options['principle_3_image']; ?>" alt="<?php echo $theme_options['principle_3_title']; ?>">
        </div>
        <div class="content">
            <div class="principle-title"><?php echo $theme_options['principle_3_title']; ?></div>
            <div class="principle-content">
                <?php echo $theme_options['principle_3_content']; ?>
            </div>
        </div>
    </div>
    <div class="principle-card div4">
        <div class="principle-icon">
            <img src="<?php echo $theme_options['principle_4_image']; ?>" alt="<?php echo $theme_options['principle_4_title']; ?>">
        </div>
        <div class="content">
            <div class="principle-title"><?php echo $theme_options['principle_4_title']; ?></div>
            <div class="principle-content">
                <?php echo $theme_options['principle_4_content']; ?>
            </div>
        </div>
    </div>
    <div class="principle-card div5">
        <div class="principle-icon">
            <img src="<?php echo $theme_options['principle_5_image']; ?>" alt="<?php echo $theme_options['principle_5_title']; ?>">
        </div>
        <div class="content">
            <div class="principle-title"><?php echo $theme_options['principle_5_title']; ?></div>
            <div class="principle-content">
                <?php echo $theme_options['principle_5_content']; ?>
            </div>
        </div>
    </div>
</div>