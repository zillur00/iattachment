<?php
session_start();
if(! isset($_SESSION["login"]))
{
	header("Location:login.php");
	exit();
}

date_default_timezone_set('Asia/Dhaka');
//require_once("header.php");
require_once("config/rmns_config.php");
require_once("function/general_fn.php");
require_once("function/database.php");
require_once("function/ia_general_fn.php");


isset($_GET["redirectfrom"])?$redirectfrom=$_GET["redirectfrom"]:$redirectfrom=null;
isset($_GET["insert-id"])?$insert_id=$_GET["insert-id"]:$insert_id=null;

$page_name=basename($_SERVER['SCRIPT_NAME']);
//var_dump($_SERVER);
echo $page_name;
die();

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
          <h1 class="h3 mb-4 text-gray-800">HR Dashboard</h1>
		   <div class="row">
                <div class="col-lg-10 col-md-offset-1">
				<br><br>
				<h3>Please pick the application from below</h3>
				<br>
                    
				<form>
				    
					<table class="table table-striped">
					<thead>
					<tr>
					<th scope="col">Tracking ID</th>
					<th scope="col">Submission Time</th>
					<th scope="col">Status</th>
					<th scope="col">Reason</th>
					<th scope="col">Remark</th>
					</tr>
					</thead>
					 <tbody>
					 <?php
					  $application_info=getApplicationInfo();
					  foreach($application_info as $application){
						  if($application["status_name"]=="REVIEW_PENDING" || $application["status_name"]=="SUBMITTED")
							  echo '<tr><td><a href="hr-review.php?tracking-id='.$application["tracking_id"].'">'.$application["tracking_id"].'</td><td>'.$application["submission_time"].'</td><td>'.$application["status_name"].'</td><td>'.$application["reason"].'</td><td>'.$application["remark"].'</td></tr>';
						  
					  }
					 ?>
					 </tbody>
					</table>
					
					  
				</form>
	            
                </div>
				</div>
            <!-- /.row -->
		  

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
  
  
  </script>
  
</body>

</html>
