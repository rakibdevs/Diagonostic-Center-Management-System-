<?php
ob_start();
session_start();
if(isset($_SESSION['userId'])){
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
                            $active = explode("_",$_GET['active']);
							
							foreach($active as $name){
								echo ucfirst($name);
								echo " ";
							}
                        ?>
                        </li>						  	
					</ol>
				</div>

<div class="col-md-6 col-md-offset-3">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">New Head Information</div>
                </div>
                <div class="panel-body">
                  <div class="padd">
	<form action="add_expense.php" id="add_expense" method="post">
	    <h4>Head Title *</h4>
	    <input type="text" name="title" placeholder="Expense Title" required/>
	    <br>
	    <br>
	    <button type="submit" class="btn btn-primary" name="submit" >Add Head</button>
	</form>
</div>

<?php
    if ( isset($_POST['submit']) ) {
		$title = trim($_POST['title']);

		$query = $mysqli->query("INSERT INTO employee_title(title) VALUES('$title')");

    }

?>
</div>
</div>
</div>
</section>

<?php
require_once('include/footer.php');	
}else{
	header("Location:index.php");	
}
?>
