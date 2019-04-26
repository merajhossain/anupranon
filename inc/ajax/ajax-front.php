<?php
// test fn start
add_action('wp_ajax_bq_test', 'bq_test_fn');
add_action('wp_ajax_nopriv_bq_test', 'bq_test_fn');

function bq_test_fn() {
    global $wpdb, $current_user;
    $testData = '';
    $test = $_POST['test'];

    global $woocommerce;
    $items = $woocommerce->cart->get_cart();

    $testReply = array(
        'error' => 0,
        'reply' => 'Sent Successfully',
        'test' => $items
    );

    echo json_encode($testReply);
    die();
}
// test fn end

add_action('wp_ajax_bq_update_mini_cart', 'bq_update_mini_cart_fn');
add_action('wp_ajax_nopriv_bq_update_mini_cart', 'bq_update_mini_cart_fn');

function bq_update_mini_cart_fn() {
    $mini_cart = bqwoo_get_header_minicart();

    echo json_encode($mini_cart);
    die();
}