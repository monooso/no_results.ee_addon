<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * "No Results" demo.
 *
 * @author      Stephen Lewis
 * @copyright   Copyright (c) 2012, Experience Internet
 */

$plugin_info = array(
  'pi_name'         => 'No Results',
  'pi_version'      => '1.0.0',
  'pi_author'       => 'Stephen Lewis',
  'pi_author_url'   => 'http://experienceinternet.co.uk/',
  'pi_description'  => 'Demonstrates the ExpressionEngine "no results" bug.',
  'pi_usage'        => No_results::usage()
);

class No_results
{
  public $return_data;
  private $EE;


  /**
   * Constructor.
   *
   * @access  public
   * @return  void
   */
  public function __construct()
  {
    $this->EE =& get_instance();
    $this->return_data = '';
  }


  /**
   * Demonstrates the test case. Attempts to return the contents of the 
   * 'no_results' tag.
   *
   * @access  public
   * @return  string
   */
  public function test_case()
  {
    return $this->EE->TMPL->no_results();
  }


  /**
   * Demonstrates the fix.
   *
   * @access  public
   * @return  void
   */
  public function the_fix()
  {
    
    /**
     * The basic idea is that we search for our custom no_results block using a 
     * regular expression. This way, we can call use a more appropriate name for 
     * our 'no_results' block: 'no_license_keys' for example.
     *
     * In this case, it's 'no_soup_for_you'.
     *
     * It's worth noting that this is a very basic proof of concept, and does 
     * not support nested, identical 'no_results' tag. Another good reason to 
     * use a custom name.
     */

    $tagdata  = $this->EE->TMPL->tagdata;
    $tag_name = 'no_soup_for_you';
    
    $pattern = '#' .LD .'if ' .$tag_name .RD .'(.*?)' .LD .'/if' .RD .'#s';

    if (is_string($tagdata) && is_string($tag_name)
      && preg_match($pattern, $tagdata, $matches)
    )
    {
      return $matches[1];
    }

    return '';
  }



  /* --------------------------------------------------------------
   * STATIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Usage instructions.
   *
   * @access  public
   * @return  string
   */
  public static function usage()
  {
    return 'See the accompanying blog post for details.';
  }


}


/* End of file    : pi.no_results.php */
/* File location  : * /system/expressionengine/third_party/no_results/pi.no_results.php */
