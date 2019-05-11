<div class="container page-top">
    <div class="row">
        <?php foreach($category as $pop) { ?>
        <div class="col-sm-4">
            <div class="block-popular-cat">
                <div class="parent-categories"><?php echo $pop['name']?></div>
                <div class="block-popular-inner">
                    <div class="image banner-boder-zoom2">
                        <a href="<?php echo $url->link('product/category', 'path=' . $pop['category_id']); ?>"><img src="<?php echo $pop['image']?>" alt="popular"></a>
                    </div>
                    <div class="sub-categories">
                        <?php if(is_array($pop['sub']) && count($pop['sub'])) { ?>
                        <ul>
                            <?php $i = 0 ?>
                            <?php foreach($pop['sub'] as $child) { ?>
                                <?php if($i > 3) continue?>
                                <li><a href="<?php echo $url->link('product/category', 'path=' . $pop['category_id'] . "_" . $child['category_id']); ?>"><?php echo $child['name']?></a></li>
                                <?php $i++?>
                            <?php } ?>
                        </ul>
                        <a href="<?php echo $url->link('product/category', 'path=' . $pop['category_id']); ?>" class="more">More</a>
                        <?php } else { ?>
                            <?php echo $pop['description']?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>