<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $comment;
$verified = wc_review_is_from_verified_owner($comment->comment_ID);
$comment_rating = ceil(get_comment_meta($comment->comment_ID, "rating", true));
?>

<div class="row">
<?php
if ('0' === $comment->comment_approved) {
    ?>


    <p class="meta pull-left"><em><?php esc_attr_e('Your comment is awaiting approval', 'woocommerce'); ?></em></p>
    <div class="rating rating-<?php echo $comment_rating; ?> size-13 margin-top-10 width-100"><!-- rating-0 ... rating-5 --></div>

<?php } else {
    ?>

    <p class="meta pull-left">
        <strong itemprop="author"><?php comment_author(); ?></strong> <?php
        if ('yes' === get_option('woocommerce_review_rating_verification_label') && $verified) {
            echo '<em class="verified">(' . esc_attr__('verified owner', 'woocommerce') . ')</em> ';
        }
        ?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(wc_date_format()); ?></time>:


    </p>
    <div class="rating rating-<?php echo $comment_rating; ?> size-13 margin-top-10 width-100"><!-- rating-0 ... rating-5 --></div>
<?php
}
?>
</div>