<?php
    /**
    * Dashboard
    */
    if ( ! defined( 'ABSPATH' ) )
    exit;
    
    ?>
 <?php include 'header.php';?>  
 
<div id="exTab2" class="container">
    <ul class="nav nav-tabs">
        <li><a  href="#1" data-toggle="tab" style="visibility: hidden"></a></li>
        <li class="active"><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_dashboard">Dashboard</a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_subscribers">Subscribers</a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_contacts">Contacts</a></li>
        <li><a href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_settings">Tools / Settings</a></li>
    </ul>
    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <div class="row">
                <div class="col-md-6">
                    <h4>consectetur adipiscing</h4>
                    <p>Curabitur eu enim metus. Duis quis mauris eu tortor accumsan molestie. Nulla auctor consequat ipsum, vitae dapibus eros viverra non. In molestie molestie massa vel auctor. Proin eu pellentesque ipsum. Vestibulum tempus et magna quis aliquet. Etiam luctus diam et sodales molestie. Phasellus congue lectus quis neque dictum accumsan.</p>
                </div>
                <div class="col-md-6">
                    <h4>consectetur adipiscing</h4>
                    <p>Curabitur eu enim metus. Duis quis mauris eu tortor accumsan molestie. Nulla auctor consequat ipsum, vitae dapibus eros viverra non. In molestie molestie massa vel auctor. Proin eu pellentesque ipsum. Vestibulum tempus et magna quis aliquet. Etiam luctus diam et sodales molestie. Phasellus congue lectus quis neque dictum accumsan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

 <?php include 'footer.php';?> 