<?php
/**
 * Form
 * *
 * @category   Wordpress
 * @since      Class available since Release 1.0.0
 */

if (!defined('ABSPATH')) exit;

class BCLC_contactus
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
        $this->load_subscriber_form();
    }

    public function load_subscriber_form()
    {
        $res = false;
        if(isset($_REQUEST['BCLC_submit_contact'])) 
        {
            $secret = '6LefTA8dAAAAAMIhBahK2oQ80iRTPWdP2nRUzuhp';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) 
            {
                  global $wpdb;
                  $set = "first_name='".$_REQUEST["first_name"]."', last_name='".$_REQUEST["last_name"]."', email='".$_REQUEST["email"]."', subject='".$_REQUEST["subject"]."', comments='".$_REQUEST["comments"]."', status='INACTIVE'";

                  $res = true;
                  $result = $wpdb->get_results( "INSERT INTO ".$wpdb->prefix."BCLC_contactus SET ".$set);
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">Recaptcha Error!</div>';
                $res = false;              
            }
        }        

        if($res)
        {
            echo '
            <p align=center><img src="'.plugins_url('BCLC/class/media/img/success.png').'" /></p>
            <div class="alert alert-success" role="alert">Form has been successfully submitted!</div>';
        }
        else
        {
           ?>

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <form method="post" action="">
              <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo @$_REQUEST['first_name']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo @$_REQUEST['last_name']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo @$_REQUEST['email']; ?>" style="border: solid;" required>
              </div>              
              <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" value="<?php echo @$_REQUEST['subject']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="website_needs" class="form-label">Comments (optional)</label>
                  <input type="text" class="form-control" id="comments" name="comments" value="<?php echo @$_REQUEST['comments']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="6LefTA8dAAAAAK2zwvGcCwyY5eKWsJa6M_xAjeUz"></div>
              </div>
              <br/>
              <div class="mb-3">
                <label for="inputPassword" class="form-label"></label>
                  <button type="submit" name="BCLC_submit_contact" class="btn btn-primary btn-lg">Submit</button>
              </div>  
              </form>


            <?php
        }    
    }

}
new BCLC_contactus();