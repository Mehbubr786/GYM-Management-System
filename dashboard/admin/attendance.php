<?php
require '../../include/db_conn.php';
page_protect();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Gym | Payments</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    	.page-container .sidebar-menu #main-menu li#paymnt > a {
    	background-color: #2b303a;
    	color: #ffffff;
		}

    </style>

</head>
      <body class="page-body  page-fade" onload="collapseSidebar()">

    	<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			
					<!-- logo collapse icon -->
					<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
							
			
		
			</header>
    		<?php include('nav.php'); ?>
    	</div>

    		<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
							
					</div>
					
					
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">

							<li>Welcome <?php echo $_SESSION['full_name']; ?> 
							</li>								
						
							<li>
								<a href="logout.php">
									Log Out <i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
						
					</div>
					
				</div>

		<h2>Member</h2>
		 <a href='view-attendance.php'>
        <button class="btn btn-info">
            View Attendance Record
        </button>
    </a>


		<hr />
			<!-- <div class="col-md-12 bg-light text-right">
		<form action="search_payment.php" method="POST">
			<input type="text" name="search"  placeholder="Enter name ">
			<input type="submit"   class="btn btn-primary"value="Search"/>
		</form>
	</div> -->
		<table class="table table-bordered datatable" id="table-1" border=1>
			<thead class="thead-dark">
				<tr><th> SN </th>
					<th>Username</th>
					<th>contact</th>
					<th>Joining date</th>
					<th>Action</th>
				</tr>
			</thead>

				<tbody>

				<?php
				date_default_timezone_set('Asia/Kathmandu');
              //$current_date = date('Y-m-d h:i:s');
                 $current_date = date('Y-m-d h:i A');
                $exp_date_time = explode(' ', $current_date);
                 $todays_date =  $exp_date_time['0'];
                     $qry="SELECT * FROM users WHERE status = '1'";
                    $result=mysqli_query($con,$qry);
                   $i=1;
              $cnt = 1;
            while($row=mysqli_fetch_array($result)){ ?>
            
           <tbody> 
               
                <td><div class='text-center'><?php echo $cnt; ?></div></td>
                <td><div class='text-center'><?php echo $row['username']; ?></div></td>
                <td><div class='text-center'><?php echo $row['mobile']; ?></div></td>
                <td><div class='text-center'><?php echo $row['j_date']; ?></div></td>

                <!-- <span>count</span><br>CHECK IN</td> -->
                <input type="hidden" name="userid" value="<?php echo $row['id'];?>">

            <?php
                $qry = "SELECT * FROM attendance WHERE curr_date = '$todays_date' AND userid = '".$row['userid']."'";
                $res = $con->query($qry);
                $num_count  = mysqli_num_rows($res);
                $row_exist = mysqli_fetch_array($res);
                $curr_date = $row_exist['curr_date'];
                if($curr_date == $todays_date){
  
              ?>
                <td>
                <div class='text-center'><span class="label label-inverse"><?php echo $row_exist['curr_date'];?>  <?php echo $row_exist['curr_time'];?></span></div>
                <div class='text-center'><a href='delete-attendance.php?id=<?php echo $row['userid'];?>'><button class='btn btn-danger'>Check Out <i class='fas fa-clock'></i></button> </a></div>
                </td>

            <?php } else {
                
                ?>

                <td><div class='text-center'><a href='check-attendance.php?id=<?php echo $row['userid'];?>'><button class='btn btn-info'>Check In <i class='fas fa-map-marker-alt'></i></button> </a></div></td>
             
                <?php }
              ?>      
              </tbody>
           <?php $cnt++; } ?>
           



					
				</tbody>

		</table>


			<?php include('footer.php'); ?>
    	</div>

    </body>
</html>


