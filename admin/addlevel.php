<script type="text/javascript">   
$(document).ready(function() {   
$('#level').change(function(){   
if($('#level').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>

<?php

if(isset($_POST['addlevel'])){
$level_name= $_POST['level_name'];
$ldesc = $_POST['ldesc'];
$los = $_POST['los'];
$progm = $_POST['progx'];

$query_level = mysqli_query($condb,"select * from level_db where level_name = '".safee($condb,$level_name)."' and prog = '".safee($condb,$progm)."'")or die(mysqli_error($condb));
$row_namel = mysqli_num_rows($query_level);
$query_level1 = mysqli_query($condb,"select * from level_db where level_order = '".safee($condb,$los)."' and prog = '".safee($condb,$progm)."' ")or die(mysqli_error($condb));
$row_namel1 = mysqli_num_rows($query_level1);
if ($row_namel>0){
message("The level name [$level_name] you entered already exist.", "error");
		        redirect('add_level.php');
}elseif($row_namel1 > 0){
			message("The level order  you Selected already exist.", "error");
		        redirect('add_level.php');
}else{
//if($level=="Others"){
mysqli_query($condb,"insert into level_db (level_name,level_desc,level_order,prog) values('".safee($condb,$level_name)."','".safee($condb,$ldesc)."','".safee($condb,$los)."','".safee($condb,$progm)."')")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','programme level Titled $level_name was Add')")or die(mysqli_error()); 
 ob_start();
	message("Programme Level Successfully Added!", "success");
		        redirect('add_level.php');

}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="bank" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Add New Level  </span>


 <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level  Name *</label>
                            	  <input type="text" class="form-control " name='level_name' id="level_name"  required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level description</label>
                            	  <input type="text" class="form-control " name='ldesc' id="ldesc"  >
                      </div>
                      
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level Order *</label>
                            	  	 <select class="form-control" name="los" id="los" required="required">
<option value="">Select Level Order</option>
<option value="100">1</option>
<option value="200">2</option>
<option value="300">3</option>
<option value="400">4</option>
<option value="500">5</option>
<option value="600">6</option>
<option value="700">7</option>
<option value="800">8</option>
<option value="900">9</option>
 </select>
                      </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Programme *</label>
                      <select class="form-control input-sm"   name="progx" id="progx"  >
 <option value="">Select</option> <?php
$resultcourse = mysqli_query($condb,"SELECT * FROM prog_tb where status = '1' ORDER BY Pro_name ASC");
while($rscourse = mysqli_fetch_array($resultcourse))
{
echo "<option value='$rscourse[pro_id]'>$rscourse[Pro_name]</option>";	
}
?>
</select> </div>
                      
                      
                      
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
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["alev"]["create"])){ ?>
                        <button  name="addlevel"  id="addlevel"  class="btn btn-primary col-md-4" title="Click Here to Add Level" ><i class="fa fa-plus"></i> Add Level</button><?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addlevel').tooltip('show');
	                                            $('#addlevel').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 