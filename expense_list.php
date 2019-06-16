<?php
ob_start();
session_start();
if(isset($_SESSION['userId']) && $_SESSION['userType'] == 'Administrator'){
	require_once('include/header.php');
	require_once('connect.php');
?>
<script>
$(document).ready(function() {
	$('#myTable').DataTable();
} );
</script>
 <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
					<ol class="breadcrumb">
						<li><i class="fa fa-angle-double-right"></i><a href="index.php">&nbsp; Home</a></li>
						<li style="color:#1a1a1a;">
                        <?php
                          if(isset($_GET['active'])){ 
                            $active = explode("_",$_GET['active']);
                            
                            foreach($active as $name){
                              echo ucfirst($name);
                              echo " ";
                            }
                          }
                        ?>
                        </li>   						  	
					</ol>
				</div>

<div class="table-responsive">
    <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Title</th>
                
                <th>Amount</th>
                <th>Details</th>
                 <th>By</th>
                <th>Action</th>             
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Title</th>
              
                <th>Amount</th>
                <th>Details</th>
                <th>By</th>
                <th>Action</th>

            </tr>
        </tfoot>

        <?php
        $query = $mysqli->query("select * from expense_details order by Id desc");
        if($query->num_rows > 0){
        	$sn=1;
        	while($rows = $query->fetch_array()){?>

        		<tr>
        			<td><?php echo $sn; ?></td>
                	<td><?php echo $rows['date']; ?></td>
                	<td>
                        <?php
                            
                            echo $rows['expense_title'];
                        ?>
                    </td>
                   
                	<td><?php echo $rows['amount']; ?></td>
                	<td><?php echo $rows['details']; ?></td>
                    <td><?php echo $rows['submitby']; ?></td>
                	<td>
                		<?php $id = $rows['Id'];?>
                		
                	<a rel="tooltip"  title="Delete" id="<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete?')" href="delete_expense.php?active=delete_expense && id=<?php echo $id;?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash" ></i></a>

         			<a  rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" href="edit_expense.php?active=edit_expense && id=<?php echo $id;?>" class="btn btn-success"><i class="fa fa-pencil" "></i></a>
          
         			</td>
            	</tr>


            <?php

            	$sn++;
        	}
        }?>
        </table>
        </section>
        <?php
require_once('include/footer.php');	
}else{
	header("Location:index.php");	
}
?>

