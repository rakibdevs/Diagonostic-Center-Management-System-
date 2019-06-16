
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
                <th>Expense time</th>
                <th>Expense Title</th>
                <th>Details</th>
                <th>By</th>
                <th>Amount</th>              
            </tr>
        </thead>
        

        <?php
        date_default_timezone_set('Asia/Dhaka');
        $today_date = date('Y-m-d');
        
        $query = $mysqli->query("select * from expense_details order by Id desc");
        if($query->num_rows > 0){
            $sn=1;
            $amount=0;
            while($rows = $query->fetch_array()){

                $expense_date = date('Y-m-d',strtotime($rows['date']));

                if ($today_date==$expense_date) {?>

                    <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $rows['date']; ?></td>
                        <td>
                            <?php
                    
                                echo $rows['expense_title'];?>
                        </td>
                        <td><?php echo $rows['details']; ?></td>
                        <td><?php echo $rows['submitby']; ?></td>
                        <td><?php echo $rows['amount']; ?></td>
                    </tr>
                    
             <?php $amount=$amount+$rows['amount'];   }?>

            <?php
                $sn++;
            }
        }?>
        <tfoot>
            <tr>
                <th>Total</th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th><span style="color:#ea6d12;"><?php echo $amount ?></span></th>               
            </tr>
        </tfoot>
    </table>
    </div>
</section>
</section>

<?php
require_once('include/footer.php'); 
}
else
    header("Location:index.php");   

?>

