
 <?php if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}

				$serial=1;			?>
 <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          General Payment Report <strong><?php //echo getprog($class_ID); ?></strong>. 
                  </div>
              
                   <!-- <form action="Delete_sapp.php" method="post"> --!>
                    <form action="" method="post"> <div  id="print_content">
<style type="text/css" media="print"> @media print { a[href]:after {content: none !important;}} @page {size: auto;margin: 0;}
					 
					  .row1 {
	background-color: #EFEFEF;
		border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}

.row2 {
	background-color: #DEDEDE;
	border: 1px solid #98C1D1;
		height: 30px;
			font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; 
}
					  </style> 
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%" border="1">
                <!--    	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_app" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;  --!><div id="cccv" > 
								<a href="#" onclick="window.open('formSales.php?view=Reportmain','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
							&nbsp;&nbsp;&nbsp;
						
								<a href="#" onClick="return Clickheretoprint();" class="btn btn-info"  id="delete2" data-placement="right" title="Click to preview select record" ><i class="fa fa-print icon-large"></i> Preview</a> </div>	<div	id="ccc2"></div>
									<script type="text/javascript">
$(document).ready(function(){ $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
$('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');});
									</script>
										<?php $existsop = imgExists($rowp['Logo']);//include('modal_delete.php'); ?>
<center><img width="100" height="70" id="Picture 1" src="   <?php  if ($existsop > 0 ){ print $rowp['Logo']; }else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";} ?>  "  ></center>
<h1 style="color:black;font-size:35px;text-shadow: 1px 0px #0000FF;" > <center> <?php echo $schoolNe ; ?></center></h1>
<div class="panel-heading" style="color:blue;font-size:15px;padding: 9px 6px 9px 0px;" id="ccc3"><b> <center>
<?php 
  $cati =  isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
$depart = isset($_REQUEST['xdp']) ? $_REQUEST['xdp'] : '';
$gsec= isset($_REQUEST['xsec']) ? $_REQUEST['xsec'] : '';
$gdop=  isset($_REQUEST['xd1']) ? $_REQUEST['xd1'] : '';
$gdop2= isset($_REQUEST['xd2']) ? $_REQUEST['xd2'] : '';
$plevel= isset($_REQUEST['xlev']) ? $_REQUEST['xlev'] : '';
$origDate = $gdop; $origDate2 = $gdop2;
 $date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));

$date2 = str_replace('/', '-', $origDate2 );
$newDate2 = date("Y-m-d", strtotime($date2));

if($cati== "1"){ echo "<font size='5px'>General Payment Report  </font><br> From ".($newDate)."  To ".$newDate2." ";}
elseif($cati== "2"){ echo "<font size='5px'>General Payment Report </font><br> ".getdeptc($depart)." ".$SGdept1;}elseif($cati== "4"){ echo "<font size='5px'>General Payment Report </font><br> ".getdeptc($depart)."<br>".getlevel($plevel,$class_ID)." ".$gsec." Academic Session  ";}else{ echo "<font size='5px'>General Payment Report </font><br> ".$gsec."  Academic Session ";}
?>
 </center></b></div>
                      <thead >
                        <tr style="background-color: gray; color: white;font-family:Verdana, Geneva, sans-serif;font-size:12px;">
                         <th>S/N</th>
						 <th>Reference No</th>
						 <th>Mat No</th>
                          <th>Name</th>
                          <th><?php echo $SGdept1; ?></th>
                          <th>Programme</th>
                          <th>Level</th>
                          <th>Payment Type</th>
                          <th>Session</th>
                         <th>Payment Date</th>
                           <th>Transaction Status</th>
                           <th>Amount Paid</th>
                          
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php

if($cati== "1"){
$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and pay_date BETWEEN '".safee($condb,$newDate)."' and '".safee($condb,$newDate2)."' and pay_status ='1' order by pay_date DESC limit 0,1000 ")or die(mysqli_error($condb));
$resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and pay_date BETWEEN '".safee($condb,$newDate)."' and '".safee($condb,$newDate2)."' and pay_status ='1' order by pay_date DESC limit 0,1000 ");

  }elseif($cati== "2" ){ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC ")or die(mysqli_error($condb));
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."'  and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC ");
 }elseif($cati== "4"){
 $viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC ")or die(mysqli_error($condb));
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and department = '".safee($condb,$depart)."' and session ='".safee($condb,$gsec)."' and level = '".safee($condb,$plevel)."' and pay_status ='1' order by pay_date DESC ");
}else{ 
$viewutme_query = mysqli_query($condb,"select * from payment_tb where prog = '".safee($condb,$class_ID)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC ")or die(mysqli_error($condb)); 
 $resultQP = mysqli_query($condb,"select SUM(paid_amount) from payment_tb where prog = '".safee($condb,$class_ID)."' and session ='".safee($condb,$gsec)."' and pay_status ='1' order by pay_date DESC");
}
$countrow = mysqli_num_rows($viewutme_query);
if($countrow < 1){
?>
<tr class="row1" >
<td colspan="12" class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><font color="black"><strong>    No Payment Information Found.</strong> </font></td></tr>
<?php
}
while($row_utme = mysqli_fetch_array($viewutme_query)){
$id = $row_utme['pay_id']; $i =0; $feetype =$row_utme['fee_type']; 
//$new_a_id = $row_utme['form_id'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_utme['ft_cat']);}else{ $feet = getftype($row_utme['fee_type']);}
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$forderquery = mysqli_query($condb,"select pay_status,paid_amount from payment_tb where pay_status > 0 and paid_amount > 0 and pay_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
//$countpay = $row_utme['trans_id'];
$countpay = mysqli_num_rows($forderquery);
?>     
                        <tr class="<?php echo $classo; ?>">
                        
												<td width="30"> <?php echo $serial++;?> </td>
						  <td> <?php 
if($countpay > 0){echo "<font color='green'>$row_utme[trans_id]</font>";}else{echo "<font color='red'>$row_utme[trans_id]</font>";} ?></td>
<td><?php echo $row_utme['stud_reg']; ?></td>
                          <td><?php echo ucwords(getname($row_utme['stud_reg'])); ?></td>
                          <td><?php echo getdeptc($row_utme['department']); ?></td>
                      <td><?php echo getprog($row_utme['prog']); ?></td>
                      <td><?php echo getlevel($row_utme['level'],$class_ID); ?></td>
                          <td><?php echo $feet; ?></td>
                          <td><?php echo ($row_utme['session']); ?></td>
                          <td><?php echo $row_utme['pay_date']; ?></td>
                         <td><?php if($countpay > 0){ echo getpaystatus($row_utme['pay_status']);}else{echo getpaystatus("0");} ?></td>
						 <td><?php echo number_format($row_utme['paid_amount'],2); ?></td>					
						</tr><?php } ?>
                             <tr class="<?php echo $classo; ?>">
                        <td colspan="11"><strong>Total </strong></td>
                          <td width="15%" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358;<?php while($get_qp = mysqli_fetch_row($resultQP))
 { foreach ($get_qp as $sumqp) if($sumqp > 0){ echo " ".number_format($sumqp,2);}else{echo " 0.00";}}  ?></td>
                   </tr>
                      </tbody>
                      
                      
                      	</form>
                      	
                      	
                    </table></div>