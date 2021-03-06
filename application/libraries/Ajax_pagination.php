<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagination Class
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Pagination
 * @author      EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/libraries/pagination.html
 */
class Ajax_pagination {

    var $base_url        = ''; // The page we are linking to
    var $total_rows      = ''; // Total number of items (database results)
    var $per_page        = 10; // Max number of items you want shown per page
    var $num_links       =  2; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page        =  0; // The current page being viewed
    var $first_link      = 'Trang đầu';
    var $next_link       = '&#187;';
    var $prev_link       = '&#171;';
    var $last_link       = 'Trang cuối';
    var $uri_segment     = 3;
    var $full_tag_open   = '<div class="pagination">';
    var $full_tag_close  = '</div>';
    var $first_tag_open  = '';
    var $first_tag_close = '';
    var $last_tag_open   = '';
    var $last_tag_close  = '';
    var $cur_tag_open    = '<b>';
    var $cur_tag_close   = '</b>';
    var $next_tag_open   = '';
    var $next_tag_close  = '';
    var $prev_tag_open   = '';
    var $prev_tag_close  = '';
    var $num_tag_open    = '';
    var $num_tag_close   = '';
    var $target          = '';
    var $anchor_class    = '';
    var $show_count      = false;
    var $link_func       = 'getData';
    var $loading         = '.loading';

    protected $CI;


    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param   array   $params Initialization parameters
     * @return  void
     */
    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        

        $this->initialize($params);
        log_message('info', 'Pagination Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Initialize Preferences
     *
     * @param   array   $params Initialization parameters
     * @return  CI_Pagination
     */
    public function initialize(array $params = array())
    {
        

        foreach ($params as $key => $val)
        {
            if (property_exists($this, $key))
            {
                $this->$key = $val;
            }
        }

        if ($this->anchor_class != ''){
            $this->anchor_class = 'class="' . $this->anchor_class . '" ';
        }

        return $this;
    }

     function create_links(){
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0){
           return '';
        }

        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1){
            //$info = 'Showing : ' . $this->total_rows;
            return '';
        }

        // Determine the current page number.        
        $CI =& get_instance();    
        if ($CI->uri->segment($this->uri_segment) != 0){
            $this->cur_page = $CI->uri->segment($this->uri_segment);   
            // Prep the current page - no funny business!
            $this->cur_page = (int) $this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1){
            show_error('Your number of links must be a positive number.');
        }

        if ( ! is_numeric($this->cur_page)){
            $this->cur_page = 0;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $this->total_rows){
            $this->cur_page = ($num_pages - 1) * $this->per_page;
        }

        $uri_page_number = $this->cur_page;
        $this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') .'/';

        // And here we go...
        $output = '';

        // SHOWING LINKS
        if ($this->show_count){
            $curr_offset = $CI->uri->segment($this->uri_segment);
            $info = 'Showing ' . ( $curr_offset + 1 ) . ' to ' ;

            if( ( $curr_offset + $this->per_page ) < ( $this->total_rows -1 ) )
            $info .= $curr_offset + $this->per_page;
            else
            $info .= $this->total_rows;

            $info .= ' of ' . $this->total_rows . ' | ';
            $output .= $info;
        }

        // Render the "First" link
        if  ($this->cur_page > $this->num_links){
            $output .= $this->first_tag_open 
                    . $this->getAJAXlink( '' , $this->first_link)
                    . $this->first_tag_close;
        }

        // Render the "previous" link
        if  ($this->cur_page != 1){
            $i = $uri_page_number - $this->per_page;
            if ($i == 0) $i = '';
            $output .= $this->prev_tag_open 
                    . $this->getAJAXlink( $i, $this->prev_link )
                    . $this->prev_tag_close;
        }

        // Write the digit links
        for ($loop = $start -1; $loop <= $end; $loop++){
            $i = ($loop * $this->per_page) - $this->per_page;    
            if ($i >= 0){
                if ($this->cur_page == $loop){
                    $output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
                }else{
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open
                        . $this->getAJAXlink( $n, $loop )
                        . $this->num_tag_close;
                }
            }
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages){
            $output .= $this->next_tag_open 
                . $this->getAJAXlink( $this->cur_page * $this->per_page , $this->next_link )
                . $this->next_tag_close;
        }

        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages){
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open . $this->getAJAXlink( $i, $this->last_link ) . $this->last_tag_close;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if exists
        $output = $this->full_tag_open.$output.$this->full_tag_close;

        if($this->link_func == 'getData'){
            $output .= '<script>
                function getData(page){  
                    $.ajax({
                        method: "POST",
                        url: "'. $this->base_url.'"+page,
                        data: { page: page },
                        beforeSend: function(){
                            $("'.$this->loading.'").show();
                        },
                        success: function(data){
                            $("'. $this->loading.'").hide();
                            $("'. $this->target.'").html(data);
                        }
                    });
                }
                </script>';
        }
        
        return $output;
    }

    protected function getAJAXlink($count, $text) {
        $pageCount = $count?$count:0;
        return '<a href="javascript:void(0);"' . $this->anchor_class . ' onclick="'.$this->link_func.'('.$pageCount.')">'. $text .'</a>';
    }  

}
