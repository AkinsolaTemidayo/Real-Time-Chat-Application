<?php 
   session_start();// Start the session to manage user's session data.
   if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
   }
?>

// Redirect the user to login page if they are not logged in.
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php 
                   include_once "php/config.php";
                   $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");// Query the database to get user information.
                   if(mysqli_num_rows($sql) > 0){
                      $row = mysqli_fetch_assoc($sql);// Fetch the user data.
                   }
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['img'] ?>" alt=""><!-- Display user's profile image. -->
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname']?></span><!-- Display user's full name. -->
                        <p><?php echo $row['status'] ?></p><!-- Display user's status. -->
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a><!-- Provide logout link. -->
            </header>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    <script src="JavaScript/users.js"></script><!-- Include JavaScript file for user interaction. -->
</body>
</html>
