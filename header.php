<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta name="keywords" content="HTML5,CSS3,Template" />
        <meta name="description" content="" />
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <?php wp_head(); ?>
    </head>
    <body <?php body_class("smoothscroll enable-animation"); ?>>
        <!-- SLIDE TOP -->
        <div id="slidetop">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h6><i class="icon-heart"></i> Anupranan</h6>
                        <p>Anupranon Prokashon is fastest growing online marketplace, offering an unparalleled shopping experience in Bangladeshl. Anupranon Prokashon  hosts a wide assortment of books alongside a rapidly growing miscellany of general merchandise.</p>
                    </div>

                    <div class="col-md-4">
                        <h6><i class="icon-attachment"></i> My Account</h6>
                        <ul class="list-unstyled">
                            <?php if (is_user_logged_in()): ?>
                                <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><i class="fa fa-angle-right"></i> <?php echo esc_html($label); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('my-account'))); ?>"><i class="fa fa-angle-right"></i> Login</a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('my-account'))); ?>"><i class="fa fa-angle-right"></i> Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h6><i class="icon-envelope"></i> CONTACT INFO</h6>
                        <p><?php $value = anupranan_get_theme_option( 'logo-text' ); echo $value; ?></p>
                        <h5><?php $value = anupranan_get_theme_option( 'mobile' ); echo $value; ?></h5>
                    </div>

                </div>

            </div>

            <a class="slidetop-toggle" href="#"><!-- toggle button --></a>

        </div>
        <!-- /SLIDE TOP -->

        <!-- wrapper -->
        <div id="wrapper">

            <!-- Top Bar -->
            <div id="topBar" class="dark">
                <div class="container">

                    <!-- right -->
                    <ul class="top-links list-inline pull-right">
                        <?php
                        if (is_user_logged_in()):
                            $current_user = wp_get_current_user();
                            $fullname = (!empty($current_user->user_firstname) || !empty($current_user->user_lastname)) ? $current_user->user_firstname . ' ' . $current_user->user_lastname : $current_user->user_login;
                            ?>
                            <li class="text-welcome hidden-xs">Welcome to Anupranan, <strong><?php echo $fullname; ?></strong></li>
                            <li>
                                <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> MY ACCOUNT</a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a tabindex="-1" href="<?php echo esc_url(get_permalink(get_page_by_path('my-account'))); ?>"><i class="glyphicon glyphicon-pushpin"></i> Dashboard</a></li>
                                    <li><a tabindex="-1" href="<?php echo esc_url(site_url("my-account/customer-logout/")) ?>"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="hidden-xs"><a href="<?php echo esc_url(get_permalink(get_page_by_path('my-account'))); ?>">LOGIN</a></li>
                            <li class="hidden-xs"><a href="<?php echo esc_url(get_permalink(get_page_by_path('my-account'))); ?>">REGISTER</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <!-- /Top Bar -->

            <div id="header" class="clearfix">
                <!-- TOP NAV -->
                <header id="topNav">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                              <!-- Mobile Menu Button -->
                              <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                                  <i class="fa fa-bars"></i>
                              </button>

                              <!-- BUTTONS -->
                              <ul class="pull-right nav nav-pills nav-second-main">

                                  <!-- SEARCH -->
                                  <li class="search">
                                      <a href="javascript:;">
                                          <i class="fa fa-search"></i>
                                      </a>
                                  </li>
                                  <!-- /SEARCH -->


                                  <!-- QUICK SHOP CART -->
                                  <?php $mini_cart = bqwoo_get_header_minicart(); ?>
                                  <li class="quick-cart">
                                      <a href="#">
                                          <span id="headerMiniCarttotalItem" class="badge badge-aqua btn-xs badge-corner"><?php echo $mini_cart['total_item']; ?></span>
                                          <i class="fa fa-shopping-cart"></i>
                                      </a>
                                      <div class="quick-cart-box">
                                          <h4>Shop Cart</h4>

                                          <div id="headerMiniCartItemList" class="quick-cart-wrapper">
                                              <?php echo $mini_cart['item_list_html']; ?>
                                          </div>

                                          <!-- quick cart footer -->
                                          <div class="quick-cart-footer clearfix">
                                              <a href="<?php echo $mini_cart['cart_url']; ?>" class="btn btn-primary btn-xs pull-right">VIEW CART</a>
                                              <span class="pull-left"><strong>TOTAL:</strong> <span id="headerMiniCarttotalCost"><?php echo $mini_cart['total_cost']; ?></span>
                                          </div>
                                          <!-- /quick cart footer -->

                                      </div>
                                  </li>
                                  <!-- /QUICK SHOP CART -->

                              </ul>
                              <!-- /BUTTONS -->

                              <!-- Logo -->
                              <a class="logo pull-left" href="<?php echo site_url(); ?>">
                                  <img src="<?php $value = anupranan_get_theme_option( 'logo' ); echo $value; ?>" width="200" height="40" alt="" />
                              </a>
                              <!--
                                      Top Nav

                                      AVAILABLE CLASSES:
                                      submenu-dark = dark sub menu
                              -->
                              <div class="navbar-collapse pull-right nav-main-collapse collapse">
                                  <nav class="nav-main">
                                      <?php wp_nav_menu(array('theme_location' => 'primary','menu' => 'primary', 'menu_id' => 'topMain', 'menu_class' => 'nav nav-pills nav-main')); ?>

                                      <!--                                <ul id="topMain" class="nav nav-pills nav-main">
                                                                          <li>
                                                                              <a href="index.html">Home</a>
                                                                          </li>
                                                                          <li>
                                                                              <a href="catagories.html">Catagories</a>
                                                                          </li>
                                                                          <li>
                                                                              <a href="books.html">Books</a>
                                                                          </li>
                                                                          <li>
                                                                              <a href="reviews.html">Reviews</a>
                                                                          </li>
                                                                          <li>
                                                                              <a href="blog.html">BLOG</a>
                                                                          </li>
                                                                      </ul>-->
                                  </nav>
                              </div>
                              <div class="row">
                                <div class="col-md-12">

                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="margin-top-20 margin-bottom-20 clearfix">
                          <!-- /SEARCH HEADER -->
                          <div class="col-md-8 col-md-offset-2 searchFormWrapper">
                            <?php echo get_search_form() ?>
                            <div class="col-md-4 searchResult"></div>
                          </div><!-- /.col-lg-6 -->
                        </div>

                        <!--<a href="#">
                          <div class="row search-result-type">
                              <div class="col-md-2 col-sm-2" style="padding-top:5px;"><img style="width: 90%;" src="https://d1jpltibqvso3j.cloudfront.net/images/product/26000/25190/250X360/25190.jpg" onerror="this.onerror=null;this.src='https://www.boibazar.com/asset/images/book-no-photo.jpg';" alt="21"></div>
                              <div class="col-md-7 col-sm-7" style="padding-top:5px;"><span style="font-weight: 600;font-size: 16px; font-family: Kiron;">21</span>
                                  <br><span style="font-size: 14px; font-family: Kiron;">কামাল উদ্দিন আহাম্মদ</span></div>
                              <div class="col-md-3">৳ ১১৩<span style="font-size: 14px; font-family: Kiron;   color: red;"> (২৫% OFF)</span></div>
                          </div>
                      </a>-->
                    </div>
                </header>
            </div>
