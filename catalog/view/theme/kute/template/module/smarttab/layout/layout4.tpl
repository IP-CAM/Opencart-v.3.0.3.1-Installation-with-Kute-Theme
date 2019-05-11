<div class="box-products box-advanced-modules <?php echo (isset($parent_class) ? $parent_class : '')?>">
    <div class="container">
        <div class="box-product-head">
            <span class="box-title"><?php echo $translator->_($title)?></span>
            <ul class="box-tabs nav-tab">
                <li class="active"><a data-toggle="tab" href="#tab-<?php echo md5($title)?>-0"><?php echo $translator->_('All')?></a></li>
                <?php $count = 0; ?>
                <?php foreach($tabs as $key => $tab) { ?>
                    <li><a data-toggle="tab" href="#tab-<?php echo $tab['tab_id']?>"><?php echo $tab['title']?></a></li>
                    <?php $count++; ?>
                <?php } ?>
            </ul>
        </div>
        <div class="box-product-content">
            <div class="box-product-adv">
                <ul class="owl-carousel nav-center" data-items="1" data-dots="false" data-autoplay="false" data-loop="false" data-nav="<?php echo (count($banners) > 1 ? 'true' : 'false')?>">
                    <?php if(count($banners) > 0) { ?>
                        <?php foreach($banners as $banner) { ?>
                            <li><a href="<?php echo $banner['link']?>"><img src="<?php echo $banner['image']?>" alt="<?php echo $banner['title']?>"></a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="box-product-list">
                <div class="tab-container">
                    <div id="tab-<?php echo md5($title)?>-0" class="tab-panel active">
                        <?php echo $all['content'];?>
                    </div>
                    <?php $count = 0; ?>
                    <?php foreach($tabs as $key => $tab) { ?>
                        <div id="tab-<?php echo $tab['tab_id']?>" class="tab-panel">
                            <?php echo $tab['content']?>
                        </div>
                        <?php $count++; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
