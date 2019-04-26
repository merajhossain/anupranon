<?php

/*
 * Template Name: Search Load
 */

   $catName = $_POST['catType'];
   /***Book Search***/
   $products = array();
   if( $catName == 'book'){
     function bn2enNumber ($number){
         $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
         $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
         $en_number = str_replace($search_array, $replace_array, $number);

         return $en_number;
     }
     $args = array(
      	'post_type' => 'product',
        'posts_per_page' => -1
      );
      $products = array();

      $query = new WP_Query( $args );


      if ( $query->have_posts() ) {
      	while ( $query->have_posts() ) {
      		$query->the_post();

          $writerName = '';
          $postID = get_the_ID();
          $term_list = wp_get_post_terms( $postID, 'writer');
          foreach ($term_list as $key => $writer) {
            $writerName = $writer->name;
          }

          $title = get_the_title();
          $meta = get_post_meta($post->ID,'_bq_product_meta',TRUE);
          $bnTitle = $meta["_bn_title"];
          $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'shop_catalog');
          $thumbSrc = $thumb[0];
          /*if( $thumbSrc == ''){
            $thumbSrc =bloginfo('template_url').'/images/avatar2.jpg';
          }*/
          $usdRate = $value = anupranan_get_theme_option( 'dollarRate' );
          $regular_price = floor(get_post_meta( get_the_ID(), '_regular_price', true) * $usdRate);
          $sale_price = floor(get_post_meta( get_the_ID(), '_sale_price', true) * $usdRate);
          $price = floor(!empty($sale_price) && $sale_price>0 ? $sale_price : $regular_price);
          $perMalink = get_the_permalink();
          $productArray = array(
                          'title' =>  $bnTitle,
                          'label' =>  $title,
                          'price' => bn2enNumber($price),
                          'salePrice' => bn2enNumber($sale_price),
                          'regularpPrice' => bn2enNumber($regular_price),
                          'url' => $perMalink,
                          'image' => $thumbSrc,
                          'writer' => $writerName
                      );
          array_push($products, $productArray) ;

      	}
      	wp_reset_postdata();
      }

      echo json_encode($products);
   }

   if( $catName == 'writer' ){
    $terms = get_terms( 'writer' );
    foreach ($terms as $term) {
      $title = $term->name;
      $writerBnName = get_term_meta($term->term_id, 'bn_bangla_title', true);
      $perMalink = get_term_link( $term );
      $writerThumbId = get_term_thumbnail_id($term->term_id);
      $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
      $writerThumSrc = $writerThum[0];
      /*if( $writerThumSrc == ''){
        $writerThumSrc =bloginfo('template_url').'/images/avatar2.jpg';
      }*/
      $productArray = array(
                      'title' =>  $writerBnName,
                      'label' =>  $title,
                      'price' => '',
                      'salePrice' => '',
                      'regularpPrice' => '',
                      'url' => $perMalink,
                      'image' => $writerThumSrc,
                      'writer' => ''
                  );
      array_push($products, $productArray) ;

    }

    echo json_encode($products);
  }

  if( $catName == 'publisher' ){
   $terms = get_terms( 'publisher' );
   foreach ($terms as $term) {
     $title = $term->name;
     $writerBnName = get_term_meta($term->term_id, 'bn_bangla_title', true);
     $perMalink = get_term_link( $term );
     $writerThumbId = get_term_thumbnail_id($term->term_id);
     $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
     $writerThumSrc = $writerThum[0];
     /*if( $writerThumSrc == ''){
       $writerThumSrc =bloginfo('template_url').'/images/avatar2.jpg';
     }*/
     $productArray = array(
                     'title' =>  $writerBnName,
                     'label' =>  $title,
                     'price' => '',
                     'salePrice' => '',
                     'regularpPrice' => '',
                     'url' => $perMalink,
                     'image' => $writerThumSrc,
                     'writer' => ''
                 );
     array_push($products, $productArray) ;

   }

   echo json_encode($products);
 }

 if( $catName == 'product_cat' ){
    $terms = get_terms( 'product_cat' );
    foreach ($terms as $term) {
      $title = $term->name;
      $writerBnName = get_term_meta($term->term_id, 'bn_bangla_title', true);
      $perMalink = get_term_link( $term );
      $writerThumbId = get_term_thumbnail_id($term->term_id);
      $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
      $writerThumSrc = $writerThum[0];
      /*if( $writerThumSrc == ''){
        $writerThumSrc =bloginfo('template_url').'/images/avatar2.jpg';
      }*/
      $productArray = array(
                      'title' =>  $writerBnName,
                      'label' =>  $title,
                      'price' => '',
                      'salePrice' => '',
                      'regularpPrice' => '',
                      'url' => $perMalink,
                      'image' => $writerThumSrc,
                      'writer' => ''
                  );
      array_push($products, $productArray) ;

    }

    echo json_encode($products);
  }

?>
