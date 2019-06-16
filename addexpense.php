<?php
ob_start();
session_start();
if(isset($_SESSION['userId']) && $_SESSION['userType'] == 'Administrator'){
require_once('include/header.php');
require_once('connect.php');


?>
<style>
.control-label{
	color:#000;
	font-weight:bold;
	cursor:pointer;
}
.form-control{
	color:#000;
	border:1px solid;
}
</style>      
      <!--main content start-->
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


<div class="col-md-6 col-md-offset-3">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">New Expense Information</div>
                </div>
                <div class="panel-body">
                  <div class="padd">
		<form action="" id="expense" method="post">
		    <br>
			<h4>Expense Title *</h4>
			<?php
			$result = $mysqli->query("select expense_title from expense_details");
    
    		echo "<html>";
    		echo "<input list='expense' name='id'> <datalist id='expense'>";

    		while ($row = $result->fetch_assoc()) {
    			unset($id, $title);
    			//$id = $row['emp_id'];
                $title = $row['expense_title']; 
                echo "<option value='" . $title."'>";
            }
    		echo "</datalist>";
    		echo "</html>";?>
			
			<h4>Amount *</h4>
			<input type="number" name="amount" placeholder="Expense Amount" required/>
			<br>
			<h4>Details Note *</h4>
			<textarea name="details" placeholder="Why expense this?" ></textarea>
			<br>
			<br>
			<button type="submit" class="btn btn-primary" name="submit" >Add Expense</button>
		</form>
	</div>
</div>
</div>
</div>
</section>
</section>

<?php
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d H:i:s');




//$by=$_SESSION['fullName'];
//echo $by;
if ( isset($_POST['submit']) ) {
		$id = trim($_POST['id']);
		//$exp_type = trim($_POST['exp_type']);
		$amount = trim($_POST['amount']);
		$details = trim($_POST['details']);
		$by=trim($_SESSION['fullName']);

		$query = $mysqli->query("INSERT INTO expense_details (expense_title,  date, amount, details, submitby) VALUES('$id','$date','$amount','$details', '$by')");
        echo $mysqli->error;

}
require_once('include/footer.php');	
}
else{
	header("Location:index.php");	
}
?>
