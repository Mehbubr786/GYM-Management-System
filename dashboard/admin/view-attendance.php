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
            View Attendance record
        </button>
    </a>


    <hr />
     <!--  <div class="col-md-12 bg-light text-right">
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
          <th>Attendance count</th>
          
        </tr>
      </thead>

        <tbody>

        <?php


              
                     $qry="SELECT * FROM users WHERE status = '1'";
                    $result=mysqli_query($con,$qry);
                   
              $cnt = 1;
            while($row=mysqli_fetch_array($result)){ ?>
            
           <tbody> 
               
                <td><div class='text-center'><?php echo $cnt; ?></div></td>
                <td><div class='text-center'><?php echo $row['username']; ?></div></td>
                <td><div class='text-center'><?php echo $row['mobile']; ?></div></td>
                
                <td><div class='text-center'><?php if($row['attendance_count'] == 1) { echo $row['attendance_count']. ' Day';} else if($row['attendance_count'] == '0') { echo'None';} else { echo $row['attendance_count']. ' Days'; } ?>  </div></td>
              </tbody>
           <?php $cnt++; } ?>
        
           



          
        </tbody>

    </table>


      <?php include('footer.php'); ?>
      </div>

    </body>
</html>


