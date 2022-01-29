<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (!class_exists( 'Basic_Registration' ) ) :

    class Basic_Registration
    {
        public $wpdb;   
        static protected $prefix = '';
        static protected $database = '';
        static protected $databaseHost = '';
        static protected $databaseUsername = ''; 
        static protected $databasePassword = ''; 
        static protected $database_obj = '';
        static protected $database_connected = false;
        static protected $url;
        static protected $current_user;
        static protected $path;
        static protected $tplPath;
        static protected $validTemplates = array( '');
        static protected $defaultTemplate = '';
        private static $instance;
        
        static public function init() 
        {
            $databaseHost_ = 'localhost';
            $databaseUsername_ = 'bathroo8_vbizllc'; 
            $databasePassword_ = 'zyqwjZ+T_A__'; 
            $database_ = 'bathroo8_vbizllc';
            self::$databaseHost = $databaseHost_;
            self::$databaseUsername = $databaseUsername_;
            self::$databasePassword = $databasePassword_;
            self::$database = $database_;
            self::$url     = '//';
            self::$path    = '';
            self::$tplPath = 'views';
            $process_filter = true;

            self::br__login();
        }



        

        public static function xlsBOF() 
        {
            echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
            return;
        }

        public static function xlsEOF() 
        {
            echo pack("ss", 0x0A, 0x00);
            return; 
        }

        public static function xlsWriteNumber($Row, $Col, $Value) 
        {
            $L = strlen($Value);
            echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
            echo $Value;
            return;
        }

        public static function xlsWriteLabel($Row, $Col, $Value) 
        {
            $L = strlen($Value);
            echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
            echo $Value;
            return;
        }        
        

        static public function br__login()
        {
            self::$database_obj = self::database();
            $res = self::$database_obj->query("SELECT * FROM wpkg_vbizllc_subscriber");
            if($res->num_rows > 0)
            {
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=orderlist.xls ");
                header("Content-Transfer-Encoding: binary ");

                self::xlsBOF();
                self::xlsWriteLabel(0,0,"SUBSCRIBERS");
                self::xlsWriteLabel(2,0,"FIRST NAME");
                self::xlsWriteLabel(2,1,"LAST NAME");
                self::xlsWriteLabel(2,2,"EMAIL");
                self::xlsWriteLabel(2,3,"PHONE NUMBER");
                self::xlsWriteLabel(2,4,"BUSINESS");
                self::xlsWriteLabel(2,5,"ROLE");
                self::xlsWriteLabel(2,6,"OTHER ROLE");
                self::xlsWriteLabel(2,7,"JOB TITLE");
                self::xlsWriteLabel(2,8,"COMPANY WEBSITE");
                self::xlsWriteLabel(2,9,"WEBSITE");
                self::xlsWriteLabel(2,10,"BUSINESS CITY");
                self::xlsWriteLabel(2,11,"BUSINESS STATE");
                self::xlsWriteLabel(2,12,"PRODUCT/SERVICES OFFERED");
                self::xlsWriteLabel(2,13,"AVERAGE PRODUCT SOLD");
                self::xlsWriteLabel(2,14,"PRODUCT SERVICES TYPE");
                self::xlsWriteLabel(2,15,"WEBSITE NEEDS");
                self::xlsWriteLabel(2,16,"MARKET INDUSTRY");
                $xlsRow = 3;

                        while ($r = $res->fetch_object())
                        {
                            self::xlsWriteNumber($xlsRow,0,$r->first_name);
                            self::xlsWriteNumber($xlsRow,1,$r->last_name);
                            self::xlsWriteNumber($xlsRow,2,$r->email);
                            self::xlsWriteNumber($xlsRow,3,$r->phone_number);
                            self::xlsWriteNumber($xlsRow,4,$r->business);
                            self::xlsWriteNumber($xlsRow,5,$r->role);
                            self::xlsWriteNumber($xlsRow,6,$r->role_other);
                            self::xlsWriteNumber($xlsRow,7,$r->job_title);
                            self::xlsWriteNumber($xlsRow,8,$r->have_company_website);
                            self::xlsWriteNumber($xlsRow,9,$r->website);
                            self::xlsWriteNumber($xlsRow,10,$r->business_city);
                            self::xlsWriteNumber($xlsRow,11,$r->business_state);
                            self::xlsWriteNumber($xlsRow,12,$r->product_services_offered);
                            self::xlsWriteNumber($xlsRow,13,$r->average_product_price_sold);
                            self::xlsWriteNumber($xlsRow,14,$r->product_services_type);
                            self::xlsWriteNumber($xlsRow,15,$r->website_needs);
                            self::xlsWriteNumber($xlsRow,16,$r->market_industry);
                            $xlsRow++;
                            $counter++;
                        }    

                self::xlsWriteNumber($xlsRow,0,"Total Showing: ".$counter);
                $xlsRow++;

                self::xlsEOF();
                exit();            
            }    
        }



        ################################################
        ############### helpers ########################
        ################################################        
        static public function externalDatabase() 
        {
            $mysql = new mysqli( self::$databaseHost, self::$databaseUsername, self::$databasePassword, self::$database );
                if ( ! $mysql ) die( "Could not connect to MySQL" );
                    return $mysql;
        }

        static public function database() 
        {
            if ( ! self::$instance ) self::$instance = self::externalDatabase();
                return self::$instance;
        }       
        
        public static function smartquote( $value, $valType = "" ) 
        {
            if(!self::$database_connected) 
            {
                self::$database_obj = self::database();
                self::$database_connected = true;
            }           

            if ( empty( $value ) && ! is_numeric( $value ) ) 
                return "NULL";
            elseif ( empty( $value ) && is_numeric( $value ) ) 
                return 0;
            else 
            {
                if ( get_magic_quotes_gpc() ) 
                {
                    $value = stripslashes( $value );
                }
                if ( ! is_numeric( $value ) ) 
                {
                    if ( ( empty( $valType ) ) || ( $valType == 'MYSQL_STRING' ) )  
                    {
                        $value = "'" . self::$database_obj->real_escape_string( trim( htmlspecialchars_decode( $value, ENT_QUOTES ) ) ) . "'";
                    }
                } 
                else 
                {
                    if ( $valType == 'MYSQL_STRING' ) 
                    {
                        $value = "'" . self::$database_obj->real_escape_string( trim( htmlspecialchars_decode( $value, ENT_QUOTES ) ) ) . "'";
                    }
                }

                return $value;
            }
        }
        
        static public function renderTpl( $data, $templateFile ) 
        {
            if ( ! in_array( $templateFile, self::$validTemplates ) ) 
                $templateFile = self::$defaultTemplate;
            if ( is_array( $data ) ) 
                extract( $data );

            ob_start();
            require self::$tplPath . '/' . $templateFile . '.php';
            return ob_get_clean();
        }

        public static function passBack( $response, $responseMsg, $redirect = null ) 
        {
            header( "HTTP/1.1 200 OK" );
            header( 'Content-Type: application/json; charset=utf-8' );
            header( 'Cache-Control: no-cache, must-revalidate' );
            header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );

            $return = json_encode(
                array(
                    'response'         => $response,
                    'response_message' => $responseMsg,
                    'redirect'         => $redirect
                )
            );
            echo $return;
            die();
        }   
        ################################################
        ################################################
        ################################################
    }
    
    Basic_Registration::init();

endif; ?>









<?php
/*
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=orderlist.xls ");
header("Content-Transfer-Encoding: binary ");




function xlsBOF() 
{
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}

function xlsEOF() 
{
    echo pack("ss", 0x0A, 0x00);
    return; 
}

function xlsWriteNumber($Row, $Col, $Value) 
{
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

function xlsWriteLabel($Row, $Col, $Value) 
{
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

xlsBOF();
xlsWriteLabel(0,0,"NURSES");
    xlsWriteLabel(2,0,"First Name");
    xlsWriteLabel(2,1,"Middle Name");
    xlsWriteLabel(2,2,"Last Name");
    xlsWriteLabel(2,3,"Email"); 
    $xlsRow = 3;


    xlsWriteNumber($xlsRow,0,1);
    xlsWriteNumber($xlsRow,1,2);
    xlsWriteNumber($xlsRow,2,3);
    xlsWriteNumber($xlsRow,3,4);
    $xlsRow++;
    $counter++;


xlsWriteNumber($xlsRow,0,"Total Showing: ".$counter);
$xlsRow++;

xlsEOF();
exit();
*/
?>