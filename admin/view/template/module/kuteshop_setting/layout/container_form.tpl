<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <?php if ($error_warning) { ?>
    <div class="ui error message">
        <div class="header"><?php echo $error_warning; ?></div>
        <ul class="list">
            <?php foreach($errors as $k => $error){ ?>
                <?php if($k != 'warning'){ ?>
                    <li><?php echo $error?></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>

    <?php if ($success) { ?>
    <div class="ui success message">
        <ul class="list">
            <li><?php echo $success; ?></li>
        </ul>
    </div>
    <?php } ?>
    <div class="box">
        <div class="ui dividing header">
            <div class="ui two column left aligned grid segment">
                <div class="column">
                    <i class="settings icon" style="font-size:1.3rem;"></i>
                    <div class="content" style="font-size:1.5rem;">
                        <?php echo $heading_title?>
                        <div class="sub header"><?php echo (isset($text_sub_header) ? $text_sub_header : "")?></div>
                    </div>
                </div>
                <div class="column" style="float: right;text-align: right;">
                    <?php if (count($buttons) > 0) { ?>
                    <div class="ui buttons">
                        <?php foreach($buttons as $button) { ?>
                        <div class="ui button <?php echo (isset($button['class']) ? $button['class'] : "")?>" onclick="<?php echo (isset($button['onclick']) ? $button['onclick'] : "javascript:;")?>"><?php echo (isset($button['text']) ? $button['text'] : "New Button")?></div>
                        <?php echo (isset($button['after']) ? $button['after'] : "")?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>


        </div>
        <div class="content <?php echo (isset($main_class) ? $main_class : "")?>">
            <form id="form" action="" method="POST" enctype="multipart/form-data">
                <?php echo $main_html?>
            </form>

        </div>
    </div>
</div>
<?php echo $footer; ?>