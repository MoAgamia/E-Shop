<div id="header">
  <div id="left">
    <label><a href="Homepage.php">E-Shop</a> </label>
    </div>
    <div id="right">
      <div id="content">

          <?php
          if(isset($_SESSION['user']))
          {
            $res=mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
            $userRow=mysqli_fetch_array($res);
            echo '<img src="'.$userRow['imgage'].'" align="left" style="margin-top:-15px; margin-right:10px;" >';
          echo ' Hi ';
            echo $userRow['username'];
            echo '&nbsp;<a href="UserHistory.php">History</a>';
            echo '&nbsp;<a href="EditProfile.php">Edit Profile</a>';
            echo '&nbsp;<a href="Logout.php?logout">Sign Out</a>';
          }else {
            echo 'Guest';
            echo '&nbsp;<a href="Login.php">Login</a>';
          }  ?>
        </div>
    </div>
</div>
