<?php
$query_find= mysqli_query($condb,"select * from staff_details where md5(staff_id) = '$get_staff'")or die(mysqli_error($condb));
							  $row_find = mysqli_fetch_array($query_find);
			 $staff_accoutid =$row_find['staff_id'];				  $staff_username =$row_find['usern_id']; $staff_sname =$row_find['sname']; $staff_oname =$row_find['oname'];$staff_mname =$row_find['mname']; $staff_phone =$row_find['phone']; $staff_pass =$row_find['password']; $staff_image =$row_find['image'];
$email = $row_find['email'];

if(isset($_POST['allotcos'])){
$salot_id = $_POST['s_idno'];
$salot_dept = $_POST['dept1'];
$salot_cos = $_POST['cos'];
$salot_session = $_POST['session'];
$salot_los = $_POST['los'];
$salot_sem = $_POST['sem'];
$date  = date('l jS F Y').date('h:i:s a');
$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ;
$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
$checkcourse =  mysqli_query($condb,"select assigned, dept, course  from course_allottb where course = '".safee($condb,$salot_cos)."'  AND assigned = '".safee($condb,$salot_id)."' AND dept = '".safee($condb,$salot_dept)."'");
$row4 =mysqli_fetch_array($checkcourse);
 $numrow4=mysqli_num_rows($checkcourse);
 
 $checkstaff =  mysqli_query($condb,"select assigned from course_allottb where course = '".safee($condb,$salot_cos)."'  AND assigned = '".safee($condb,$salot_id)."' AND dept = '".safee($condb,$salot_dept)."'");
$row5 =mysqli_fetch_array($checkstaff);
 $numrow5=mysqli_num_rows($checkstaff);

if(empty($_POST['sname']) and empty($_POST['staff_uid']) ){ 	message("You have not selected any staff !", "error");
		  redirect('allot_Courses.php'); }
 elseif($numrow4>0){
	 ob_start();
	 	message("This Lecturer Has Being Assigned To ".getdeptc($salot_dept)." Department  to lecturer $salot_cos !", "error");
		  redirect('allot_Courses.php?allot_id='.$get_staff);

//exit;
ob_flush();		 
 } elseif($numrow5>0) {
 message("This Lecturer is Already Assigned To A Course", "error");
		        redirect('allot_Courses.php?allot_id='.$get_staff);
 ob_start();

ob_flush();	

}else{
if($config['emailver'] == '1') {
$azzsql = "INSERT INTO course_allottb (assigned,dept,course,session,semester,level,a_lotdate,a_lotstatus,prog) values ('$salot_id', '$salot_dept', '$salot_cos', '$salot_session', '$salot_sem','$salot_los', '$date','1','".safee($condb,$class_ID)."')";
	$cazzRes = mysqli_query($condb,$azzsql) or die ("Couldn't allocate  Course to $sname $mname  $oname.");
$msg = nl2br("Dear $sname $mname  $oname,.\n
	This Message was Sent  From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Course Allocation Information:.\n
	".$SGdept1.": ".$salot_dept."\n
	Course: ".$salot_cos."\n
	Level: ".getlevel($salot_los,$class_ID)."\n
	Semester: ".$salot_sem."\n
	Date Allocated: ".$date."\n
	
	..................................................................\n
	For inquiry and complaint please email admin@smartdelta.com.ng \n
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="Course Allocation Information "; 
//define the headers we want passed. Note that they are separated with \r\n
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
 $headers      .= "From:Message From Admin\r\n $subject <$webaddress>\r\n".
 'X-Mailer: PHP/' . phpversion();  */
 //define the body of the message.
ob_start(); //Turn on output buffering
//@mail($email, $subject, $msg, $headers);
$mail_data = array('to' => $email, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
}else{
$azzsql = "INSERT INTO course_allottb (assigned,dept,course,session,semester,level,a_lotdate,a_lotstatus,prog) values ('$salot_id', '$salot_dept', '$salot_cos', '$salot_session', '$salot_sem','$salot_los', '$date','1','".safee($condb,$class_ID)."')";
	$cazzRes = mysqli_query($condb,$azzsql) or die ("Couldn't allocate  Course to $sname $mname  $oname.");
}

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Allocation to $sname $mname  $oname  To $salot_dept Department  to lecturer $salot_cos')")or die(mysqli_error($condb)); 
 ob_start();
 	message("Course Allotement To  <b> $sname $mname  $oname </b>  was successfully.", "success");
		  redirect('allot_Courses.php');
//$res="<font color='green'><strong>Course Allotement To  <b> $sname $mname  $oname </b>  was successfully.</strong></font><br>";
				//$resi=1;
			



}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Allot New Course to Staff / Lecturer <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?> </span>

  <div class="col-md-8 col-sm-8 col-xs-12 input-group has-feedback">
  
                            <input type="text" class="form-control" name='staff_uid' placeholder="Staff Username"  value="<?php echo $staff_username; ?>" readonly>
                               
                            <span class="input-group-btn">
                                              <a href="#myModal15" data-placement="right" data-toggle="modal" class="btn btn-primary" title="Click to Load Staff" id="s_userid" ><i class="fa fa-reply-all"></i> Find!</a>
                                          </span>
                                        <script type="text/javascript">
									 $(document).ready(function(){
									 $('#s_userid').tooltip('show');
									 $('#s_userid').tooltip('hide');
									 });
									</script>
								<input type="hidden" class="form-control " name='s_idno' id="s_idno" value="<?php echo $staff_accoutid;?>"   required="required">
                          </div>
 
                     
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname Name </label>
<input type="text" class="form-control " name='sname' id="acc_name" value="<?php echo $staff_sname;?>"   required="required" readonly>
                      </div>
                      
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name</label>
                            	  <input type="text" class="form-control " name='mname' id="mname" readonly value="<?php echo $staff_mname;?>"  >
                      </div>
                      
                     <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Name</label>
		<input type="text" class="form-control" name='oname' id="oname"  value="<?php echo $staff_oname;?>" readonly >
                      </div>
                      	    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
//$resultfac = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//while($rsfac = mysqli_fetch_array($resultfac))
//{  
//if($rsfac['fac_id']==@$cat){echo "<option selected value='$rsfac[fac_id]'>$rsfac[fac_name]</option>"."<BR>";}
//else{echo "<option value='$rsfac[fac_id]'>$rsfac[fac_name]</option>";}
//}

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
                            
                          
                          </select>
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Courses</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Course Code</option>
                          </select>
                      </div>
                      
  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session</label>
							   <select class="form-control"   name="session" id="session"  required="required">
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
              
					   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="los" id="los"  required="required">
<option>Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?> 
 </select>
                      </div>
 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Semester</label>
                            	  	 <select class="form-control" name="sem" id="sem"  required="required">
<option>Select Semester</option>
<option value="First">First</option>
<option value="Second">Second</option></select>
                      </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                    
                     
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sMan"]["aes"]["create"])){ ?> 
                        <button  name="allotcos"  id="allotcos"  class="btn btn-primary col-md-4" title="Click Here to Save Staff Course Allotment information" ><i class="fa fa-save"></i> Save </button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#allotcos').tooltip('show');
	                                            $('#allotcos').tooltip('hide');
	                                            });
	                                            </script><?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  