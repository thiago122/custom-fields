<?php

    function orderQueryString($field_sort = null){

        $ci = & get_instance();

        $field_sort     = strtolower($field_sort);
        $order_by       = strtolower($ci->input->get('order_by'));
        $order          = strtolower($ci->input->get('order'));

        $order_text = (($order_by == $field_sort) &&  ( $order == 'asc' ))? 'desc' : 'asc';

        $query_string = '?order_by='. $field_sort .'&order='.$order_text;

        foreach($_GET as $key => $value){
          if( $key != 'order_by' && $key != 'order' ){
            $query_string .= '&'.$key . "=" . $value;
          }

        }

        return $query_string;

    }

    function orderQueryStringBtn($field_sort = null){

        $ci = & get_instance();

        $field_sort     = strtolower($field_sort);
        $order_by       = strtolower($ci->input->get('order_by'));
        $order          = strtolower($ci->input->get('order'));

        $order_text = (($order_by == $field_sort) &&  ( $order == 'asc' ))? 'desc' : 'asc';


        if( ($order_by == $field_sort) &&  ( $order == 'asc' ) ){
            echo '<i class="fa fa-fw fa-sort-asc"></i>';
        }else{
            echo '<i class="fa fa-fw fa-sort-desc"></i>';
        }

    }
