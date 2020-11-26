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
require_once("../config/rmns_config.php");
require_once("../function/general_fn.php");
require_once("../function/database.php");
require_once("../function/fc_general_fn.php");
require_once("../pages/header.html");

// global variables
$power_plants_t='power_plants';
$engines_t='engines';
$engine_fuel_consumption_daily_t='engine_fuel_consumption_daily';
// plant info



?>
<div id="page-wrapper">
<?php 
//var_dump(getFuelInfo());die();
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link href="../vendor/kartik-v-bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

 <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="../vendor/kartik-v-bootstrap-fileinput/js/fileinput.min.js"></script>

            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <h3 align="center" class="page-header">Industrial Attachment Application Form</h3>
					<!-- Alert box --> 

				<!-- <div class="alert alert-success" id="success-alert">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<P id="alert-text-p"></p>
				</div> -->
             
                </div> 
				
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6  col-md-offset-2">
                    
				<form action="post-form.php" METHOD=POST ENCTYPE="multipart/form-data">
				
					<div class="form-group">
					  <label for="coursename">Couse Name :</label>
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
						<label for="plantname-select">Chose Your Preferred Location:</label>
						<select class="form-control validation" id="plantname" name="plantname">
						<option value="">Location</option>
						<option value="gazipur-power-plant">Gazipur 52 MW</option>
						<option value="raozan-power-plant">Raozan 25 MW</option>
						<option value="gazipur105MW-power-plant">Gazipur 105 MW</option>
						</select>
					</div>
					
					
					<div class="form-group">
					  <label for="contactno">Contact No:</label>
					  <input type="text" class="form-control validation" id="contactno" name="contactno">
					</div>
					
					<div class="form-group">
					  <label for="address">Address:</label>
					  <textarea class="form-control validation" rows="5" id="address" name="address"></textarea>
					</div>
					
					<div class="form-group">
					  <label for="noofparticipant">No of Participient:</label>
					  <input type="number" class="form-control validation" id="noofparticipant" name="noofparticipant">
					</div>
					
					<div class="form-group">
					
					 <label for="endorsement">Written Application Endorsed by Institution(pdf):</label>
					 <input type="file" class="form-control-file" id="file" name="file" accept="*" multiple>
				     
					<!--   <input type="file" class="form-control-file border" name="file">-->
					</div>
					 
					 <button type="submit"  class="btn btn-primary"  id="submit-btn-1"  >Submit</button>
					 <input type="hidden" name="operation" value="insert_industrial"/> 
					</form>
				
				  
				
				
               
                </div>
				</div>
            <!-- /.row -->
            <div class="row">
				<div class="col-lg-12">
				
                 </br>  </br>  </br>  </br>
			   
			   <div id="postdiv"></div>
				
               
            </div>
			   </div>
            <!-- /.row -->
<script>


// posting data to submission form 

function checkFields()
{
 //	alert('Hello');
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
	return true;
	
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
);
});

return true;
});

	
	
	
	
$("#submit-btn").click(function(){
	
	
 
coursename=$("#coursename").val();
uniname=$("#uniname").val();

email=$("#email").val();

plantname=$("#plantname-select").val();

contactno=$("#contactno").val();
address=$("#address").val();
noofparticipant=$("#noofparticipant").val();
file=$("#file").val();

// call post_form.php file to insert data

post_fields={operation:"insert_industrial",coursename:coursename,uniname:uniname,email:email,plantname:plantname,contactno:contactno,address:address,noofparticipant:noofparticipant,file:file}; 




$.post("post_form.php",post_fields,
function(postresult){
	  //alert(post_fields.coursename);
      
	  $("#alert-text-p").html(postresult);
		/*$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
         $("#success-alert").slideUp(500);
		});*/
		
	//	$("#postdiv").html(postresult);
}); 
		
});
});  


        </script>
     
       
<?php  
require_once("../pages/footer.html");
?>

