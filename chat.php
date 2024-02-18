<?php 
   session_start();// Start the session to manage user's session data.

// Redirect the user to login page if they are not logged in
   if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
   }
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php 
                    include_once "php/config.php";
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");// Query the database to get user information.
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);// Fetch the user data.
                    }
                    ?>
                <a href= "users.php" class="back-icon" ><i class="bi bi-arrow-left"></i></a><!-- Provide a back button to go back to users.php -->
                    <img src="php/images/<?php echo $row['img'] ?>" alt=""><!-- Display user's profile image. -->
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname']?></span><!-- Display user's full name. -->
                        <p><?php echo $row['status'] ?></p><!-- Display user's status. -->
                    </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name = "outgoing_id" value="<?php echo $_SESSION['unique_id']?>" hidden> <!-- Store the current user's id in a hidden field. -->
                <input type="text" name = "incoming_id" value="<?php echo $user_id?>" hidden ><!-- Store the id of the user the current user is chatting with in a hidden field. -->
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."><!-- Provide input field for typing message. -->
                <button><i class="fab fa-telegram-plane"></i></button><!-- Button to send message. -->
            </form>
        </section>
    </div>
    
    <script src= "JavaScript/chat.js" ></script><!-- Include JavaScript file for chat functionality. -->
</body>
</html>
