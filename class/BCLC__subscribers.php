<?php
/**
 * Form
 * *
 * @category   Wordpress
 * @since      Class available since Release 1.0.0
 */

if (!defined('ABSPATH')) exit;

class BCLC_subscriber
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
        if(isset($_REQUEST['BCLC_submit'])) 
        {
            $secret = '';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) 
            {
                  global $wpdb;
                  $dbvh = $wpdb->get_results("SELECT id FROM ".$wpdb->prefix."BCLC_subscriber WHERE email='".$_REQUEST['email']."' LIMIT 1"); 
                  $set = "first_name='".$_REQUEST["first_name"]."', last_name='".$_REQUEST["last_name"]."', email='".$_REQUEST["email"]."', phone_number='".$_REQUEST["phone_number"]."', business='".$_REQUEST["business"]."', role='".$_REQUEST["role"]."', job_title='".$_REQUEST["job_title"]."', have_company_website='".$_REQUEST["have_company_website"]."', website='".$_REQUEST["website"]."', business_city='".$_REQUEST["business_city"]."', business_state='".$_REQUEST["business_state"]."', product_services_offered='".$_REQUEST["product_services_offered"]."', average_product_price_sold='".$_REQUEST["average_product_price_sold"]."', product_services_type='".$_REQUEST["product_services_type"]."', website_needs='".$_REQUEST["website_needs"]."', status='INACTIVE', role_other='".$_REQUEST["role_other"]."', market_industry='".$_REQUEST["market_industry"]."'";

                  $res = true;
                  foreach($dbvh as $dbvh_row)
                  {
                      echo '<div class="alert alert-danger" role="alert">Email already exist!</div>';
                      $res = false;
                  }
                  if($res) $result = $wpdb->get_results( "INSERT INTO ".$wpdb->prefix."BCLC_subscriber SET ".$set);

                echo "Your registration has been successfully done!";
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
            <div class="alert alert-success" role="alert">We are so excited to receive your entry! Keeping our fingers crossed that you win.</div>';
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
                <label for="phone_number" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo @$_REQUEST['phone_number']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="business" class="form-label">Name of Business</label>
                  <input type="text" class="form-control" id="business" name="business" value="<?php echo @$_REQUEST['business']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="business" class="form-label">Role</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="Owner" onclick="javascript: document.getElementById('other_').style.display = 'none'; " required>
                    <label class="form-check-label" for="flexRadioDefault1">
                      Owner
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="Employee" onclick="javascript: document.getElementById('other_').style.display = 'none'; " required>
                    <label class="form-check-label" for="flexRadioDefault1">
                      Employee
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value="Other" onclick="javascript: document.getElementById('other_').style.display = 'block'; " required>
                    <label class="form-check-label" for="flexRadioDefault1">
                      Other
                    </label>
                  </div>
                  <div id="other_" style="display: none;"><input type="text" class="form-control" id="role_other" name="role_other" value="<?php echo @$_REQUEST['role_other']; ?>" style="border: solid;"></div>
              </div>
              <div class="mb-3">
                <label for="job_title" class="form-label">Job Title</label>
                  <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo @$_REQUEST['job_title']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="market_industry" class="form-label">What market industry are you in?</label>
                  <input type="text" class="form-control" id="market_industry" name="market_industry" value="<?php echo @$_REQUEST['market_industry']; ?>" style="border: solid;" required>
              </div>          
              <div class="mb-3">
                  <label for="have_company_website" class="form-label">Do you have a company website?</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="have_company_website" value="Yes" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                      Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="have_company_website" value="No" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                      No
                    </label>
                  </div>
              </div>
              <div class="mb-3">
                <label for="website" class="form-label">Website, if applicable</label>
                  <input type="text" class="form-control" id="website" name="website" value="<?php echo @$_REQUEST['website']; ?>" style="border: solid;">
              </div>
              <div class="mb-3">
                <label for="business_city" class="form-label">Which city is your business located?</label>
                  <input type="text" class="form-control" id="business_city" name="business_city" value="<?php echo @$_REQUEST['business_city']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="business_state" class="form-label">Which state is your business located?</label>
                  <input type="text" class="form-control" id="business_state" name="business_state" value="<?php echo @$_REQUEST['business_state']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="product_services_offered" class="form-label">What type of product services does your company offer?</label>
                  <input type="text" class="form-control" id="product_services_offered" name="product_services_offered" value="<?php echo @$_REQUEST['product_services_offered']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="average_product_price_sold" class="form-label">What is the average price per job/product sold in your business?</label>
                  <input type="text" class="form-control" id="average_product_price_sold" name="average_product_price_sold" value="<?php echo @$_REQUEST['average_product_price_sold']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="product_services_type" class="form-label">Do you sell your product/service locally, nationally or both?</label>
                  <input type="text" class="form-control" id="product_services_type" name="product_services_type" value="<?php echo @$_REQUEST['product_services_type']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <label for="website_needs" class="form-label">Tell us about your website needs. What are your pain points? What is your wish list?</label>
                  <input type="text" class="form-control" id="website_needs" name="website_needs" value="<?php echo @$_REQUEST['website_needs']; ?>" style="border: solid;" required>
              </div>
              <div class="mb-3">
                <div class="g-recaptcha" data-sitekey=""></div>
              </div>
              <br/>
              <div class="mb-3">
                <label for="inputPassword" class="form-label"></label>
                  <button type="submit" name="BCLC_submit" class="btn btn-primary btn-lg">Submit</button>
              </div>  
              </form>


            <?php
        }    
    }

}
new BCLC_subscriber();