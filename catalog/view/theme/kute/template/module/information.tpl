<div class="block left-module">
    <p class="title_block">Infomations</p>
    <div class="block_content">
            <div class="layered layered-category">
                <div class="layered-content">
                    <ul class="tree-menu">
                    <?php foreach ($informations as $information) { ?>
                        <li>
                            <span></span><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a>
                        </li>
                    <?php } ?>
                    <li>
                        <span></span><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a>
                    </li>
            
                    <li>
                        <span></span><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a>
                    </li>
                    </ul>
            </div>
        </div>
    </div>
</div>