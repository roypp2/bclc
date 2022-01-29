<?php
/**
 * Form
 * *
 * @category   Wordpress
 * @since      Class available since Release 1.0.0
 */

if (!defined('ABSPATH')) exit;

class BCLC_popup
{

    public function Tdheadersc()
    {

        wp_register_style('bootstrap.min', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap.min');
        wp_register_style('font-awesome', plugins_url('BCLC/assets/css/font-awesome.min.css'));
        wp_enqueue_style('font-awesome');

        wp_enqueue_script( 'class-vc-video_image_overlay', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery') ); 
        wp_enqueue_script( 'class-vc-video_image_overlay', plugins_url('assets/js/jquery.min.js', __FILE__), array('jquery') );            
    }

    public static $suffix = '';

    /**
     * URL (with trailing slash) to plugin folder.
     *
     * @var string
     * @since 1.0.0
     *
     */
    public static $url = '';
    public static $path = '';

    public function __construct()
    {
        $this->Tdheadersc();
        $this->load_popup_form();
    }

    public function load_popup_form()
    {
           ?>
            <script type="text/javascript">
            var addEvent = function(obj, evt, fn) {
              if (obj.addEventListener) {
                obj.addEventListener(evt, fn, false);
              }
              else if (obj.attachEvent) {
                obj.attachEvent("on" + evt, fn);
              }
            };

            addEvent(document, "mouseout", function(event) {
              event = event ? event : window.event;
              var from = event.relatedTarget || event.toElement;
              if ( (!from || from.nodeName == "HTML") && event.clientY <= 100 ) {
                showPopup('block');
              }
            });                        
            </script>

            <script>
            var counter = 0;
            function showPopup(act) {
              if(act == 'block' && counter == 0)
              {
                document.getElementById('myModal').style.display = act;
                counter++;
              }
            }
            function closePopup() {
              document.getElementById('myModal').style.display = 'none';
            }            
            </script>

            <input type="button" value="test" onclick="showPopup();">
            <div id="myModal" class="modal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">FREE Website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="javascript: closePopup();"></button>
                  </div>
                  <div class="modal-body">
                          <a href='https://BCLC.com/free-website-2/'><?php echo '<img src="'.plugins_url('BCLC/class/media/img/notify.png').'" border="0" width=100%" />'; ?></a>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="javascript: closePopup();">Close</button>
                    <button type="button" class="btn btn-primary" onclick="javascript: window.location='https://BCLC.com/free-website-2/'; ">Signup</button>
                  </div>
                </div>
              </div>
            </div>

            <?php
    }

}
new BCLC_popup();