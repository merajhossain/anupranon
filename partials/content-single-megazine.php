<?php
$portrait_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portrait-thumb');
$thumb_url = !empty($portrait_thumb_url[0]) ? esc_url($portrait_thumb_url[0]) : NO_IMG_URL;
$comments_count = wp_count_comments(get_the_ID());
$total_comments = (!empty($comments_count) && $comments_count->approved > 0) ? $comments_count->approved : 0;

$multi_images = get_multi_images_src('large-thumb','portrait-thumb');
//echo '<pre>'; print_r($multie_images); echo '</pre>';
?>

<div class="row">
    <div class="megazine-single-thumb-holder col-sm-12 col-md-4 col-lg-4">
        <img src="<?php echo $thumb_url; ?>" />
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8">
        <?php the_content(); ?>
    </div>
</div>

<?php if(!empty($multi_images)): ?>
<div id="megazineGallery" class="row">
    <h3 class="col-sm-12 col-md-12 col-lg-12">Megazine Gallery</h3>
    <ul class="row">
        <?php foreach($multi_images as $gallery_image): ?>
        <li class="col-lg-2 col-md-2 col-sm-6 col-xs-4">
            <img class="img-responsive" src="<?php echo $gallery_image[0][0]; ?>">
        </li>
        <?php endforeach; ?>
    </ul>             
</div> <!-- /container -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">         
            <div class="modal-body">                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endif; ?>