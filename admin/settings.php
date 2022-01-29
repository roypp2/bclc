<?php
    /**
    * Dashboard
    */
    if ( ! defined( 'ABSPATH' ) )
    exit;
    

    global $wpdb;

    $dbvh = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."vbizllc_subscriber"); 
    foreach($dbvh as $dbvh_row)
    {
    }



?>



<?php include 'header.php';?>  
 
<div id="exTab2" class="container">
    <ul class="nav nav-tabs">
        <li><a  href="#1" data-toggle="tab" style="visibility: hidden"></a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_dashboard">Dashboard</a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_subscribers">Subscribers</a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_contacts">Contacts</a></li>
        <li class="active"><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_settings">Tools / Settings</a></li>
    </ul>
    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <div class="row">
                <div class="col-md-6">
                    <h4>Free Website Popup</h4>
                    <p>Shortcode: <strong>[VBIZLLC_POPUP]</strong><br clear="all" /><br clear="all" />
                        <button type="button" class="btn btn-primary btn-lg" onclick="javascript: window.location='https://vbizllc.com/wp-content/plugins/vbizllc/admin/settings.export.php'; ">Export to Excel</button>
                    </p>
                </div>
                <div class="col-md-6">
                    <h4>Free Website Form</h4>
                    <p>Shortcode: <strong>[VBIZLLC_SUBSCRIBERS]</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

 <?php include 'footer.php';?> 