<?php
    /**
    * Shortcodes
    */

    if ( ! defined( 'ABSPATH' ) ) exit;
    
	global $wpdb;

	if(isset($_REQUEST["save_settings"]))
	{
		$dbvh = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."vbizllc_contactus"); 
		$update_set = "";
		foreach($dbvh as $dbvh_row)
		{
			if(isset($_REQUEST[$dbvh_row->id."_shortcode"])) $set_stat = "ACTIVE";
			else $set_stat = "INACTIVE";
			$result = $wpdb->get_results( "UPDATE ".$wpdb->prefix."vbizllc_contactus SET status='".$set_stat."' WHERE id = '".$dbvh_row->id."'");
		}
	}

	$dbvh = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."vbizllc_contactus");      
	$counter_filter = count($dbvh) / 2;
	$counter = 0;
	$col1_data = "";
	$col2_data = "";
	foreach($dbvh as $dbvh_row)
	{
		if($dbvh_row->status == "ACTIVE") $btn_stat = " checked"; 
		else $btn_stat = ""; 
		
		if($counter <= $counter_filter)
		{
			$col1_data .= 
			'
	            					<div class="row">
						                <div class="col-md-1">
											<div class="form-check form-switch">
											  <input class="form-check-input" type="checkbox" role="switch" id="'.$dbvh_row->id.'_shortcode" name="'.$dbvh_row->id.'_shortcode"'.$btn_stat.'>
											</div>
						                </div>	            						
						                <div class="col-md-11">
											<div class="accordion" id="accordionExample">
												<div class="accordion-item">
												    <h2 class="accordion-header" id="heading'.$dbvh_row->id.'">
												      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$dbvh_row->id.'" aria-expanded="false" aria-controls="collapse'.$dbvh_row->id.'">
												        '.$dbvh_row->first_name." ".$dbvh_row->last_name.'
												      </button>
												    </h2>
												    <div id="collapse'.$dbvh_row->id.'" class="accordion-collapse collapse" aria-labelledby="heading'.$dbvh_row->id.'" data-bs-parent="#accordionExample">
												      <div class="accordion-body">
															<table class="table table-striped table-bordered">
																<tbody>
															    	<tr><th scope="row">Email</th><td>'.$dbvh_row->email.'</td></tr>
															    	<tr><th scope="row">Phone Number</th><td>'.$dbvh_row->subject.'</td></tr>
															    	<tr><th scope="row">Name of Business</th><td>'.$dbvh_row->comments.'</td></tr>
															    	<tr><th scope="row">Role</th><td>'.$dbvh_row->role.'</td></tr>
																</tbody>
															</table>    
												      </div>
												    </div>
												</div>
											</div> 
						                </div>
									</div> 
			';
		}
		else
		{
			$col2_data .= 
			'
	            						            					<div class="row">
						                <div class="col-md-1">
											<div class="form-check form-switch">
											  <input class="form-check-input" type="checkbox" role="switch" id="'.$dbvh_row->id.'_shortcode" name="'.$dbvh_row->id.'_shortcode"'.$btn_stat.'>
											</div>
						                </div>	            						
						                <div class="col-md-11">
											<div class="accordion" id="accordionExample">
												<div class="accordion-item">
												    <h2 class="accordion-header" id="heading'.$dbvh_row->id.'">
												      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$dbvh_row->id.'" aria-expanded="false" aria-controls="collapse'.$dbvh_row->id.'">
												        '.$dbvh_row->first_name." ".$dbvh_row->last_name.'
												      </button>
												    </h2>
												    <div id="collapse'.$dbvh_row->id.'" class="accordion-collapse collapse" aria-labelledby="heading'.$dbvh_row->id.'" data-bs-parent="#accordionExample">
												      <div class="accordion-body">
															<table class="table table-striped table-bordered">
																<tbody>
															    	<tr><th scope="row">Email</th><td>'.$dbvh_row->email.'</td></tr>
															    	<tr><th scope="row">Phone Number</th><td>'.$dbvh_row->subject.'</td></tr>
															    	<tr><th scope="row">Name of Business</th><td>'.$dbvh_row->comments.'</td></tr>
															    	<tr><th scope="row">Role</th><td>'.$dbvh_row->role.'</td></tr>
																</tbody>
															</table>    
												      </div>
												    </div>
												</div>
											</div> 
						                </div>
									</div> 
			';			
		}
		$counter++;
	}
 ?>
 <br clear="all" />
 <?php include 'header.php';?>  

<div id="exTab2" class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="#1" data-toggle="tab" style="visibility: hidden"></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_subscribers">Subscribers</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_contacts">Contacts</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php $url = admin_url(); ?>admin.php?page=vbizllc_settings">Tools / Settings</a></li>
    </ul>
    <div class="tab-content ">
    	<form action="" method="post">
        <div class="tab-pane active" id="1">
            <div class="row">
                <div class="col-md-12">
                	<br clear="all" /><br clear="all" />
                    <div class="form-group select-all">
                        <div class="form-check">
							<input type="checkbox" class="form-check-input" name="select-all" id="select-all" />
                            <!--<input class="form-check-input" type="checkbox" id="gridCheck">-->
                            <label class="form-check-label" for="gridCheck">
                            Select all/Disable Active Contacts
                            </label>
                        </div>
                    </div>
                    <br clear="all" />
				</div>
			</div>
            <div class="row">
                <div class="col-md-6"><?php echo $col1_data; ?></div>
                <div class="col-md-6"><?php echo $col2_data; ?></div>
			</div>                
            <div class="row">
                <div class="col-md-12">	
                    <br clear="all" /><button type="submit" name="save_settings" class="btn btn-primary" style="float: right;">UPDATE STATUS</button>
                    <!--<button type="submit" name="save_settings" data-bs-toggle="modal" data-bs-target="#br__email_modal" class="btn btn-primary" style="float: right;">test</button>-->
                </div>
            </div>
        </div>
   		</form>
    </div>
</div>


<form id="vbizllc__form">
    <div class="modal fade" id="br__email_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Subscriber</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
				<p>Contents here...</p>
		  </div>					
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="zmdi zmdi-close-circle"></i>&nbsp;&nbsp;Close</button>
            <button type="button" class="btn btn-primary btn-blue_" id="br__quote__send_email" quote__send_email><i class="zmdi zmdi-email"></i>&nbsp;&nbsp;Send</button>
          </div>
        </div>
      </div>
    </div>
</form>     


<script>
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});	
</script>
 <?php include 'footer.php';?> 