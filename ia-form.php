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
          <h2 class="h3 mb-4 text-gray-800">Application Form</h2>
		  			<form action="post-form.php" METHOD=POST ENCTYPE="multipart/form-data">

		 <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    
				
				
					<div class="form-group">
					  <label for="coursename">Degree/Subject :</label>
					  <input type="text" class="form-control validation" id="coursename" name="coursename">
					</div>
					<div class="form-group">
					  <label for="uniname">Institute/University Name: :</label>
					  <input type="text" class="form-control validation" id="uniname" name="uniname">
					</div>
				
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input type="email" class="form-control validation" placeholder="email@example.com" id="email" name="email">
					  
					</div>
					<div class="form-group">
					  <label for="address">Address:</label>
					  <textarea class="form-control validation" rows="2" id="address" name="address"></textarea>
					</div>
					
					<div class="form-group">
					
					 <label for="endorsement">Written Application Endorsed by Institution(pdf):</label>
					 <input type="file" class="form-control-file" id="file" name="file" accept="*" multiple>
				     
					<!--   <input type="file" class="form-control-file border" name="file">-->
					</div>
							   
					
					
					
					
					 
					 
				
				  
				
				
               
                </div>
				 <div class="col-md-6">
				 <div class="form-group">
					  <label for="coursename">Applicant Name :</label>
					  <input type="text" class="form-control validation" id="applicantname" name="applicantname">
					</div>
				 <div class="form-group">
					  <label for="noofparticipant">No of Participient:</label>
					  <input type="number" class="form-control validation" id="noofparticipant" name="noofparticipant">
					</div>
					<div class="form-group">
						<label for="plantname-select">Chose Your Preferred Location:</label>
						<select class="form-control validation" id="plantname" name="plantname">
						<option value="">Location</option>
						<option value="mymensingh-power-station">Mymensingh 210 MW</option>
						<option value="gazipur-power-plant">Gazipur 52 MW</option>
						<option value="raozan-power-plant">Raozan 25 MW</option>
						<option value="gazipur105MW-power-plant">Gazipur 105 MW</option>
						</select>
					</div>
				 <div class="form-group">
					  <label for="contactno">Contact No:</label>
					  <input type="text" class="form-control validation" id="contactno" name="contactno">
					</div>
					
					
					
					
					
					
					
					
					
				 
				 </div>
				 
				
				</div>
            <!-- /.row -->
			<div class="row">
			    <div class="col">
				</div>
				<div class="col">
				  <button type="submit"  class="btn btn-primary"  id="submit-btn-1"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					 <input type="hidden" name="operation" value="insert_industrial"/> 
				</div>
				<div class="col">
				</div>
			</div>
			
			
            </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <br>
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
   function checkFields()
{
 alert('Hello');
	status=false;
	$('.validation').each(function() {
   console.log($(this).val());
   if($(this).val().length==0)
   {
	  // alert($(this).attr('name') + ' can not be blank');
       status=false;	  
	  $(this).focus();
	//  return false;
//	  event.preventDefault();
	  return false;
	  // alert("inside if"); 
	   
   }
   
   alert("inside loop");
 
});
	
	//event.preve
	return false;
	
}
$(function(){

$("#submit-btn-1").click(function(){	


$('.validation').each(function() {
   console.log($(this).val());
   if($(this).val().length==0)
   {
	   alert($(this).attr('name') + ' can not be blank');
	   $(this).focus();
	   event.preventDefault();
	   return false;
	   
   }

});

return true;
});

	
	
	
	

});  
  
  </script>
  
</body>

</html>
