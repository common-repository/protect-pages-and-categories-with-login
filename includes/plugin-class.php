<?php

/**
 * This file is part of Protect pages and categories with login
 * define the plugin working class
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class sp4_PPCL {
    /**
     * Start up
     */
    private $allowed_content ;

    public function __construct()
       {
        $this->allowed_content = true ; // Init var for user role check
        add_filter( 'plugin_row_meta', array( $this, 'sp4ppcl_row_meta' ), 10, 2 );
        add_shortcode('sp4ppcl_protect_page_with_login', array( $this, 'sp4ppcl_protect_page_with_login_shortcode' ) ); // shortcode
        add_action( 'template_redirect', array( $this, 'sp4ppcl_protect_page_with_login_redirect_handler' ), 0 ); // redirect management
       }

    /**
     * HOOK functions
     */

    /* SHORTCODE PROCESSOR */
    public function sp4ppcl_protect_page_with_login_shortcode($metas) {
        /* Process marker and user role function */
        global $post ;

        $return_value = "" ;

        $system_roles = wp_roles()->get_names(); // get system roles

        // Clean up attr
        $atts = shortcode_atts(
                array( 'role' => '' ), $metas );

        if( !empty($atts["role"]) && is_user_logged_in() )
           {
            // Role check enbled for logged user

            $post_enabled_roles = explode(';',$atts["role"]) ;

            // Current user data
            $current_user = wp_get_current_user();
            $current_user_roles = $current_user->roles;

            foreach($post_enabled_roles as $enabled_role)
               {
                if( !empty( $enabled_role ) && in_array( $enabled_role, $current_user_roles ))
                   {
                    // Enabled content
                    $this->allowed_content = true ;
                    return $return_value ;
                   }
                else
                   {
                    // Disabled content
                    $this->allowed_content = false ;
                   }
               }
           }

        return $return_value ;
    }

    /* Not allowed page content replacer */
    public function sp4ppcl_protect_page_with_login_not_allowed_content($content)
       {
        // Content setting
        $return_html_code = '<div style="font-weight:bold;font-size:+3;margin: 25px auto;padding:25px;">'.__('NOT ALLOWED','protect-pages-and-categories-with-login').'</div>' ;
        return $return_html_code ;
       }

    /* Redirect handler */
     public function sp4ppcl_protect_page_with_login_redirect_handler() {
        /* This function check the login and user role actions */
        global $post ;

        /* Category short code processor */
        $categories = get_the_category();
        foreach( $categories as $category)
           {
            $description = $category->description;
            if( has_shortcode( $description, 'sp4ppcl_protect_page_with_login') )
               {
                // viewing a category page with shortcode
                if( !is_user_logged_in() ) {
                    auth_redirect();
                    exit ;
                }

                $regex_pattern = get_shortcode_regex();
                preg_match_all( '/'. $regex_pattern .'/s', $description, $regex_matches );

                if( array_key_exists( 2, $regex_matches ) && in_array( 'sp4ppcl_protect_page_with_login', $regex_matches[2] ))
                   {
                    if( array_key_exists( 0, $regex_matches ) )
                       {
                        foreach($regex_matches[0] as $shortcode )
                           {
                            if(preg_match('/^\[sp4ppcl_protect_page_with_login/',$shortcode) )
                               {
                                add_filter('category_description','do_shortcode',10,2) ;
                                do_shortcode($shortcode) ;
                                if(!$this->allowed_content)
                                   {
                                    wp_redirect(home_url());
                                    exit ;
                                   }
                               }
                           }
                       }
                   }
               }
           }

        /* Page short code processor */
        if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'sp4ppcl_protect_page_with_login') )
           {
            // viewing a page with shortcode
            if( !is_user_logged_in() ) {
                auth_redirect();
                exit ;
            }

            $regex_pattern = get_shortcode_regex();
            preg_match_all( '/'. $regex_pattern .'/s', $post->post_content, $regex_matches );

            if( array_key_exists( 2, $regex_matches ) && in_array( 'sp4ppcl_protect_page_with_login', $regex_matches[2] ))
               {
                if( array_key_exists( 0, $regex_matches ) )
                   {
                    foreach($regex_matches[0] as $shortcode )
                       {
                        if(preg_match('/^\[sp4ppcl_protect_page_with_login/',$shortcode) )
                           {
                            do_shortcode($shortcode) ;
                            if(!$this->allowed_content)
                               {
                                add_filter( 'the_content', array( $this, 'sp4ppcl_protect_page_with_login_not_allowed_content' ), 10, 2 );
                                return ;
                               }
                           }
                       }
                   }
               }
           }

    }

    /**
     * Show row meta on the plugin screen.
     *
     * @access  public
     * @param   mixed $links Plugin Row Meta
     * @param   mixed $file  Plugin Base file
     * @return  array
     */
    public function sp4ppcl_row_meta( $links, $file )
       {
        if ( $file == SP4_PPCL_BASENAME )
           {
            $row_meta = array(
                'home'    => '<a href="' . esc_url( 'https://wordpress.org/plugins/protect-pages-and-categories-with-login/' ) . '" target="_blank" title="' . esc_attr__( 'WP Plugin Homepage','protect-pages-and-categories-with-login' ) . '">'.__( 'Home','protect-pages-and-categories-with-login' ).'</a>',
                'faq'     => '<a href="' . esc_url( 'https://wordpress.org/plugins/protect-pages-and-categories-with-login/faq/' ) . '" target="_blank" title="' . esc_attr__( 'WP Plugin FAQ Page','protect-pages-and-categories-with-login' ) . '">'.__( 'FAQ','protect-pages-and-categories-with-login' ).'</a>',
                'support' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/protect-pages-and-categories-with-login' ) . '" target="_blank" title="' . esc_attr__( 'WP Plugin Support Page','protect-pages-and-categories-with-login' ) . '">'.__( 'Support','protect-pages-and-categories-with-login' ).'</a>',
                'rate'    => '<a href="' . esc_url( 'https://wordpress.org/support/view/plugin-reviews/protect-pages-and-categories-with-login' ) . '" target="_blank" title="' . esc_attr__( 'WP Plugin Review Page','protect-pages-and-categories-with-login' ) . '">'.__( 'Rate','protect-pages-and-categories-with-login' ).'</a>',
                'donate'  => '<a href="' . esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WBR5M7GLCMJ2G' ) . '" target="_blank" title="' . esc_attr__( 'Donate for this plugin','protect-pages-and-categories-with-login' ) . '">'.__( 'Donate','protect-pages-and-categories-with-login' ).'</a>',
            );

            return array_merge( $links, $row_meta );
           }

        return (array) $links;
       }
}
