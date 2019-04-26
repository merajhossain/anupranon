<?php

function bqwoo_get_header_minicart() {
    global $woocommerce;  
    $cart_url = $woocommerce->cart->get_cart_url();
    
    $total_item = 0;
    $total_cost = 0;
    $item_list_html = '';

    $items = $woocommerce->cart->get_cart();
    
    if(!empty($items)){
        foreach ($items as $item => $values) {
            $_product = $values['data']->post;
            
            $meta = get_post_meta($values['product_id'],'_bq_product_meta',TRUE);
            $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
            //product image
            $getProductDetail = wc_get_product($values['product_id']);
            $price = get_post_meta($values['product_id'], '_price', true);
            //get_post_meta($values['product_id'], '_regular_price', true)
            //get_post_meta($values['product_id'], '_sale_price', true)

            $item_list_html .= '<a href="'.get_permalink( $values['product_id'] ).'">
                                            ' . $getProductDetail->get_image('shop_catalog') . '
                                            <h6>' . $title . '</h6>
                                            <small><span>' . $values['quantity'] . ' x </span>' . wc_price($price) . '</small>
                                        </a>';

            $total_item++;
            $total_cost += ($price*$values['quantity']);
        }
    }
    
    $mini_cart = array(
        'item_list_html' => $item_list_html,
        'total_item' => $total_item,
        'total_cost' => wc_price( $total_cost ),
        'cart_url' => $cart_url
    );
    
    return $mini_cart;
}


function bq_english_to_bangla_number($enNum){
    $bnNum = null;
    if(is_numeric($enNum)){
        $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
        $bnNum = str_replace(range(0, 9),$bn_digits, $enNum); 
    }
    
    return $bnNum;
}