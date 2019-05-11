<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="product-comments-block-tab">
  <div class="comment row">
    <div class="col-sm-3 author">
        <div class="grade">
            <span>Grade</span>
            <span class="reviewRating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($review['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star"></i></span>
                  <?php } ?>
                  <?php } ?>
            </span>
        </div>
        <div class="info-author">
            <span><strong><?php echo $review['author']; ?></strong></span>
            <em><?php echo $review['date_added']; ?></em>
        </div>
    </div>
    <div class="col-sm-9 commnet-dettail"><?php echo $review['text']; ?></div>
  </div>
</div>
<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_no_reviews; ?></p>
<?php } ?>
