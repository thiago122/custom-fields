<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name MY_Pagination.php
 * @version 1.0
 * @author Thiago Sobrinho
 *
 * Implementação simples para diminuir a escrita de código
 * na configuração da paginação do codeigniter
 */

class MY_Pagination extends CI_Pagination
{

    public function __construct(){
        parent::__construct();
        $this->baseConfig();
    }

    public function createLinks(){
        return $this->create_links();
    }

    public function setBaseUrl($baseUrl){
        $this->base_url = base_url($baseUrl);
        return $this;
    }

    public function setPerPage($perPage){
        $this->per_page = $perPage;
        return $this;
    }

    public function setTotal($total){
        $this->total_rows = $total;
        return $this;
    }

    public function setUriSegment($uriSegments){
        $this->uri_segment = $uriSegments;
        return $this;
    }

    public function setNumLinks($numLinks){
        $this->num_links = $numLinks;
        return $this;
    }

    public function baseConfig(){
        $this->reuse_query_string   = TRUE;
        $this->num_links            = 8;
        $this->first_link           = '&laquo; Primeiro';
        $this->first_tag_open       = '<li class="prev page">';
        $this->first_tag_close      = '</li>';
        $this->last_link            = 'Último &raquo;';
        $this->last_tag_open        = '<li class="next page">';
        $this->last_tag_close       = '</li>';
        $this->next_link            = 'Próximo &rarr;';
        $this->next_tag_open        = '<li class="next page">';
        $this->next_tag_close       = '</li>';
        $this->prev_link            = '&larr; Anterior';
        $this->prev_tag_open        = '<li class="prev page">';
        $this->prev_tag_close       = '</li>';
        $this->cur_tag_open         = '<li class="active"><a href="">';
        $this->cur_tag_close        = '</a></li>';
        $this->num_tag_open         = '<li class="page">';
        $this->num_tag_close        = '</li>';
        $this->uri_segment          = 3;
    }
}
