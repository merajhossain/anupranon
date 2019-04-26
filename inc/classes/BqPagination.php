<?php

class BqPagination {

    private $full_url = "";
    private $base_url = "";
    private $page_var_name = "page";
    private $print_pagin = FALSE;
    private $total_item = 0;
    private $cur_page = 1;
    private $per_page = 10;
    private $offset = 0;
    private $show_first_last = TRUE;
    private $show_next_prev = TRUE;
    private $first_link_text = "First";
    private $last_link_text = "Last";
    private $next_link_text = "Next";
    private $prev_link_text = "Prev";
    private $pagin_to_show = 5;
    private $current_class = "current";
    private $additional_pagin_classes = "";
    private $before_pagin_link = "<li>";
    private $after_pagin_link = "</li>";
    private $pagin_holder_start = "<ul>";
    private $pagin_holder_end = "</ul>";
    private $additional_query_string = "";

    function __construct($args = array()) {
        if (!empty($args)) {
            foreach ($args as $key => $val) {
                if (!empty($val)) {
                    $this->$key = $args[$key];
                }
            }
        }

        $this->set_current_full_url();
        $this->set_base_url();
    }

    private function set_current_full_url() {
        if (empty($this->full_url)) {
            $http_type = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? "https://" : "http://";
            $this->full_url = "$http_type$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
    }

    private function set_base_url() {
        if (empty($this->base_url)) {
            if (!empty($this->full_url)) {
                $full_url_parts = explode('?', $this->full_url);
                if (!empty($full_url_parts[0])) {
                    $this->base_url = $full_url_parts[0];
                }
            }
        }
    }

    private function get_additional_query_var_array() {
        $query_var_array = array();

        if (!empty($this->full_url)) {
            $full_url_parts = explode('?', $this->full_url);
            if (!empty($full_url_parts[1])) {
                $this->additional_query_string = $full_url_parts[1];
            }
        }

        if (!empty($this->additional_query_string)) {
            $query_var_parts = explode('&', $this->additional_query_string);
            if (!empty($query_var_parts)) {
                foreach ($query_var_parts as $query_var_part) {
                    if (!empty($query_var_part)) {
                        $query_var_key_val = explode('=', $query_var_part);
                        if (!empty($query_var_key_val[0]) && $query_var_key_val[0] != $this->page_var_name) {
                            $query_var_array[$query_var_key_val[0]] = $query_var_key_val[1];
                        }
                    }
                }
            }
        }

        return $query_var_array;
    }

    public function generate_pagination() {

        //echo $this->base_url; exit;

        $pagination = '';
        if ($this->total_item > 0 && $this->per_page > 0 && $this->cur_page > 0 && $this->per_page < $this->total_item) {

            $pagination .= $this->pagin_holder_start;
            // set start end start

            $number_of_pagin = ceil($this->total_item / $this->per_page);
            //echo $this->pagin_to_show."---".$number_of_pagin; exit;

            $midPoint = ($this->pagin_to_show <= $number_of_pagin) ? ceil($this->pagin_to_show / 2) : ceil($number_of_pagin / 2);
            $midGap = ($this->pagin_to_show <= $number_of_pagin) ? $this->pagin_to_show - $midPoint : $number_of_pagin - $midPoint;

            if ($this->cur_page <= $midPoint) {
                $start = 1;
                $end = $midPoint + $midGap;
            } elseif ($this->cur_page >= ($number_of_pagin - $midGap)) {
                //echo "$current>=($number_of_pagin-$midGap)"; exit;
                $start = $this->cur_page - $midGap - ($this->cur_page - ($number_of_pagin - $midGap));
                $end = $number_of_pagin;
            } else {
                $start = $this->cur_page - $midGap;
                $end = $this->cur_page + $midGap;
            }

            if ($start < 1)
                $start = 1;
            if ($end > $number_of_pagin)
                $end = $number_of_pagin;

            //echo $this->cur_page."--".$midPoint."--".$number_of_pagin."--".$start."--".$end; exit;
            // set start end end show_first_last 
            $firstPageLink = "";
            $lastPageLink = "";

            $firstPageNo = 1;
            $firstPageUrl = esc_url(add_query_arg($this->get_additional_query_var_array(), esc_url(add_query_arg($this->page_var_name, 1, $this->base_url))));
            $firstPageLink = $this->before_pagin_link . '<a href="' . $firstPageUrl . '" page="1" id="bq-pagin-first" class="bq-pagin ' . $this->additional_pagin_classes . '">' . $this->first_link_text . '</a>' . $this->after_pagin_link;
            $lastPageNo = $number_of_pagin;
            $lastPageUrl = esc_url(add_query_arg($this->get_additional_query_var_array(), esc_url(add_query_arg($this->page_var_name, $number_of_pagin, $this->base_url))));
            $lastPageLink = $this->before_pagin_link . '<a href="' . $lastPageUrl . '" page="' . $lastPageNo . '" id="bq-pagin-last" class="bq-pagin ' . $this->additional_pagin_classes . '">' . $this->last_link_text . '</a>' . $this->after_pagin_link;

            $prevPageNo = $this->cur_page > 1 ? $this->cur_page - 1 : 0;
            $prevPageUrl = esc_url(add_query_arg($this->get_additional_query_var_array(), esc_url(add_query_arg($this->page_var_name, $prevPageNo, $this->base_url))));
            $prevPageLink = $this->before_pagin_link . '<a href="' . $prevPageUrl . '" page="' . $prevPageNo . '" id="bq-pagin-prev" class="bq-pagin ' . $this->additional_pagin_classes . '">' . $this->prev_link_text . '</a>' . $this->after_pagin_link;
            $nextPageNo = $this->cur_page < $number_of_pagin ? $this->cur_page + 1 : 0;
            $nextPageUrl = esc_url(add_query_arg($this->get_additional_query_var_array(), esc_url(add_query_arg($this->page_var_name, $nextPageNo, $this->base_url))));
            $nextPageLink = $this->before_pagin_link . '<a href="' . $nextPageUrl . '" page="' . $nextPageNo . '" id="bq-pagin-next" class="bq-pagin ' . $this->additional_pagin_classes . '">' . $this->next_link_text . '</a>' . $this->after_pagin_link;

            if ($this->show_first_last && $this->cur_page > 1) {
                $pagination .= $firstPageLink;
            }

            if ($this->show_next_prev && $this->cur_page > 1) {
                $pagination .= $prevPageLink;
            }

            for ($i = $start; $i <= $end; $i++) {
                $currentClass = $i == $this->cur_page ? $this->current_class : '';
                $pageUrl = esc_url(add_query_arg($this->get_additional_query_var_array(), esc_url(add_query_arg($this->page_var_name, $i, $this->base_url))));
                $beforePaginLink = substr($this->before_pagin_link, 0, strlen($this->before_pagin_link) - 1) . ' class="' . $currentClass . '" >';
                $pagination .= $beforePaginLink . '<a href="' . $pageUrl . '" page="' . $i . '" id="bq-pagin-' . $i . '" class="bq-pagin ' . $this->additional_pagin_classes . ' ' . $currentClass . '">' . $i . '</a>' . $this->after_pagin_link;
            }

            if ($this->show_next_prev && $this->cur_page < $number_of_pagin) {
                $pagination .= $nextPageLink;
            }

            if ($this->show_first_last && $this->cur_page < $number_of_pagin) {
                $pagination .= $lastPageLink;
            }

            $pagination .= $this->pagin_holder_end;
        }

        if ($this->print_pagin) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

}