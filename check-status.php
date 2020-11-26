<?php
/*
if(! isset($_SESSION["login"]))
{
	header("location:login.php");
	exit();
}
*/
date_default_timezone_set('Asia/Dhaka');
//require_once("header.php");
require_once("config/rmns_config.php");
require_once("function/general_fn.php");
require_once("function/database.php");
require_once("function/ia_general_fn.php");

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
          <h1 class="h3 mb-4 text-gray-800">Check Application Status</h1>
		   <div class="row">
                <div class="col-md-6">
				<h4>Give your 21 digits Tracking ID below</h4>
				<br>
                    
				<form>
				
					<div class="form-group">
					  <input type="text" class="form-control validation" id="trackingid" name="trackingid">
					</div>
					 <button type="button"  class="btn btn-primary"  id="submit-btn"  >Submit</button>
					  
				</form>
	            
                </div>
				</div>
            <!-- /.row -->
              <div class="row">
				<div class="col-lg-10 col-md-offset-1">
				
                 </br>
			   
			   <div id="postdiv"></div>
				
               
            </div>
			   </div>
            <!-- /.row -->
			 <div class="row">
				<div class="col-md-6 col-md-offset-1" id="progress-content">
					<!--<div class="progress" style="height: 25px;" id="progress" >
						<div class="progress-bar bg-success" id="progressbar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>-->
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

	$("#submit-btn").click(function(){	
	
	s=true;
	$('.validation').each(function() {
	console.log($(this).val());
	if($(this).val().length==0)
	{
		s=false;
		alert($(this).attr('name') + ' can not be blank');
		$(this).focus();
		event.preventDefault();
		return false;	   
	}
	
	//$(this).
	//alert ('hello');
	});
	
	if(s==false)
	return false;
		
	
	trackingid=$("#trackingid").val();
	post_fields={operation:"check_status",trackingid:trackingid}; 
	
	$.post("post-form.php",post_fields,
	function(postresult){
		//alert(post_fields.coursename);
		
		// $("#alert-text-p").html(postresult);
			/*$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
			});*/
			
		$("#postdiv").html(postresult);
	});
	
	post_fields={operation:"make_progress_bar",trackingid:trackingid}; 
	$.post("post-form.php",post_fields,
	function(postresult){
			
		$("#progress-content").html(postresult);
		//$("#progress-content").html('<p>testing</p>');
	}); 
			
	});
});
  
  </script>
  
</body>

</html>
