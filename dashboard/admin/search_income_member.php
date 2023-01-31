<?php
// if (isset($_POST['search'])) {
	// code...

if(!isset($_POST['search']))
{

	header('location:income.php');

}
$uname = $_POST['search']; 
require '../../include/db_conn.php';
page_protect();
// $month=$_GET['mm'];
// $year=$_GET['yy'];
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Gym | Income </title>
     <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <style>
    	.page-container .sidebar-menu #main-menu li#overviewhassubopen > a {
    	background-color: #2b303a;
    	color: #ffffff;
		}

    </style>

</head>
    <body class="page-body  page-fade" onload="collapseSidebar();showMember();">

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

		<h3>Income </h3>
	

		<hr / >
<div class="col-md-12 bg-light text-right">
		<form action="search_income_member.php" method="POST">
			<input type="text" name="search"  placeholder="Enter name ">
			<input type="submit"   class="btn btn-primary"value="Search"/>
		</form>
	</div>



<?php

$query="select u.userid, u.username, u.gender, u.mobile,
u.email, e.join_date, a.state, a.city,
e.expire,p.planName, p.amount, p.validity from users u 
INNER JOIN address a on u.userid=a.id 
INNER JOIN enrolls_to e on u.userid= e.uid
INNER JOIN plan p on p.pid=e.pid
WHERE e.renewal='yes'  ORDER BY u.userid desc";


  
$sql ="SELECT SUM(p.amount) as amount ,username from plan p INNER JOIN enrolls_to e ON e.pid = p.pid INNER JOIN users u ON u.userid=e.uid GROUP BY u.userid  ORDER BY u.userid desc";
$result=mysqli_query($con,$sql);

$res=mysqli_query($con,$query);
echo "<tbody>";

$sno    = 1;
$totalamount=0;
echo("<table border='1'>");
if (mysqli_affected_rows($con) != 0) {

	echo "<thead >
				<tr>
					<th>Sl.No</th>
					<th>Member ID</th>
					
					<th>Contact</th>
					<th>Gender</th>
					<th>State</th>
					<th>Join_Date</th>
					<th>Expire_Date</th>
					<th>Plan_Name</th>
					<th> Name </th>

					<th>Amount</th>
					
					<th>Validity</th>
					<th> Payment History </th>
				</tr>
	</thead>";

    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
      

                echo "<tr><td>".$sno."</td>";
                
                echo "<td>" . $row['userid'] . "</td>";
                
             
                echo "<td>" . $row['mobile'] . "</td>";


                echo "<td>" . $row['gender'] . "</td>";

                echo "<td>" . $row['state'] . "</td>";

                echo "<td>" . $row['join_date'] . "</td>";

                echo "<td>" . $row['expire'] . "</td>";

                echo "<td>" . $row['planName'] . "</td>";
                while($rows=mysqli_fetch_array($result)){
                   echo "<td>" . $rows['username'] . "</td>";
                echo "<td>" . $rows['amount'] . "</td>";
                

                break;
            }

                echo "<td>" . $row['validity'] . " Month</td>";
                echo "<td><form action='read_member.php' method='post'><input type='hidden' name='name' value='" . $row['userid'] . "'/><input type='submit' class='a1-btn a1-blue' id='button1' value='View History ' class='btn btn-info'/></form> </td> ";
                
                $totalamount=intval($totalamount)+intval($rows['amount']);
                $sno++;
            
        
    }

 	$sql1 ="SELECT SUM(p.amount) as total from plan p INNER JOIN enrolls_to e ON e.pid = p.pid INNER JOIN users u ON u.userid=e.uid";
	$result1=mysqli_query($con,$sql1);
	while($rows=mysqli_fetch_array($result1)){

    echo "<tr><td colspan=11 align='center'><h3>Total Income on is ".$rows['total']."</h3></td></tr>";

}
}
else{
		echo "<h2>No Data found On\"</h2";
}
echo "</tbody> </table>";

	include('footer.php'); 
?>
