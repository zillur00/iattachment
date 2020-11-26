<?php
session_start();
if(! isset($_SESSION["login"]))
{
	header("location:login.php");
	exit();
}

date_default_timezone_set('Asia/Dhaka');
//require_once("header.php");
require_once("config/rmns_config.php");
require_once("function/general_fn.php");
require_once("function/database.php");
require_once("function/ia_general_fn.php");
isset($_REQUEST["tracking-id"])?$tracking_id=$_REQUEST["tracking-id"]:die("Invalid Request");
//$tracking_id="T20200406182540000015";


?>
<!DOCTYPE html>
<html>

<?php require_once("header.php");  ?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
	<?php require_once("sidebar.php");  ?>
    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
		<?php require_once("topbar.php");  ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
		

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">HR Review</h1>
		   <?php 
		   
		   
		   $application_info=getApplicationInfo($tracking_id,"HR_REVIEW"); $application=$application_info[0];
		   if($application["status_name"]=="SUBMITTED"){
		   updateStatus($tracking_id,"REVIEW_PENDING");
		   }
		   ?>
			<div class="row">
				
				<div class="col">
					
					<div class="row">
						<div class="col-sm-4"><strong>Subject/Degree:</strong></div>
						<div class="col-sm-8"><?php echo $application["coursename"]; ?></div>
				
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>University Name:</strong></div>
						<div class="col-sm-8"><?php echo $application["uniname"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Applicant Name:</strong></div>
						<div class="col-sm-8"><?php echo $application["applicant_name"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Email:</strong></div>
						<div class="col-sm-8"><?php echo $application["email"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Intended Plant:</strong></div>
						<div class="col-sm-8"><?php echo $application["plantname"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Contact No:</strong></div>
						<div class="col-sm-8"><?php echo $application["contactno"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Address:</strong></div>
						<div class="col-sm-8"><?php echo $application["address"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Total Participants:</strong></div>
						<div class="col-sm-8"><?php echo $application["noofparticipant"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Attachment:</strong></div>
						<div class="col-sm-8"><?php echo $application["file"]; ?></div>
					</div>
				</div>
				
				<div class="col">
					<div class="row">
						<div class="col-sm-4"><strong>Tracking ID:</strong></div>
						<div class="col-sm-8"><?php echo $application["tracking_id"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Submission Time:</strong></div>
						<div class="col-sm-8"><?php echo $application["submission_time"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Status:</strong></div>
						<div class="col-sm-8"><?php echo $application["status_name"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Reason:</strong></div>
						<div class="col-sm-8"><?php echo $application["reason"]; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-4"><strong>Remark:</strong></div>
						<div class="col-sm-8"><?php echo $application["remark"]; ?></div>
					</div>
				</div>
				
			</div>
		    
			
		  
		   <div class="row">
		   
                <div class="col">
				<br>
				
                    
				<form action="post-form.php" method="POST">
				    
				     
					 <div class="row">
						<div class="col">
							<div class="row">
								<div class="col">
									<button type="button"  class="btn btn-success"  id="recommend" name="recommend"  >Recommend</button>
								</div>
								<div class="col">
									<button type="button"  class="btn btn-danger"  id="reject" name="reject" data-toggle="modal" data-target="#reject-modal" >Reject</button>
								</div>
								</div>
							</div>
						<div class="col"></div>
					  </div>
					  <input type="hidden" id="tracking-id" name="tracking-id" value="<?php echo $tracking_id; ?>" />
					  <input type="hidden" id="status" value="<?php echo $application["status_name"]; ?>" />
				</form>
	            
                </div>
				</div>
				<div class="row">
					<div class="col">
						<div id="post-result"></div>
					</div>
				</div>
				
			<!-- Reject Modal -->
				<div class="modal" id="reject-modal" tabindex="-1" role="dialog">
					<div class="modal-dialog"  role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Please provide rejection reason.</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- <p>Please provide rejection reason.</p>-->
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-4">Reason</div>
									<div class="col-sm-8"><input type="text" id="modal-reject-reason" /></div>
								</div>
								<div class="row">
									<div class="col-sm-12"><hr></div>
								</div>
								<div class="row">
									<div class="col-sm-4">Remark</div>
									<div class="col-sm-8"><input type="text" id="modal-reject-remark" /></div>
								</div>
							</div>
							 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="modal-reject-submit">Submit</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
						</div>
					</div>
				</div>
			
		  

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php require_once("footer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require_once("logout-modal.php") ?>

  
  <!-- Bootstrap core JavaScript-->
  <?php require_once("core-script.php")?>
  
  <!-- Page level plugins -->
  
  <!-- Page level custom scripts -->
  <script >
  
  $(function(){
	  
	if($("#status").val()=="RECOMMENDED" || $("#status").val()=="APPROVED"){
      $("#recommend").attr("disabled","true");
	  $("#reject").attr("disabled","true");
	}
	
	
	

$("#recommend").click(function(){	

 
status="RECOMMENDED";
tracking_id=$("#tracking-id").val();
post_fields={"operation":"update_status_hr","tracking-id":tracking_id,"status":status}; 
$.post("post-form.php",post_fields,
function(postresult){
	// alert(postresult.status);
		
	  if(postresult.status){
		  window.location.href="hr-dashboard.php";
		  
	  }
	  else{
		  $("#post-result").html(postresult.message);
		  
	  }
	  
}); 
		
});

$("#modal-reject-submit").click(function(){	

 
status="REJECTED";
tracking_id=$("#tracking-id").val();

reason=$("#modal-reject-reason").val();
remark=$("#modal-reject-remark").val();
//return;
post_fields={"operation":"update_status_hr","tracking-id":tracking_id,"status":status,"reason":reason,"remark":remark}; 


$.post("post-form.php",post_fields,
function(postresult){
	// alert(postresult.status);
		
	  if(postresult.status){
		  window.location.href="hr-dashboard.php";
		  
	  }
	  else{
		  $("#post-result").html(postresult.message);
		  
	  }
	  
	}); 
		
});



}); 
  
  
  </script>
  
</body>

</html>
