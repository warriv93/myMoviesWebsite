<?php include 'header.php'; $page='tips'; include 'menu.php';
//init SQLDATABASE connection variables

function loadCommentList(){
    $servername = "localhost";
    $username = "****";
    $password = "****";
    $dbname = "*****";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//Creating the SQL query
//creates gb table if not exist to hold comments
    $sql = "CREATE TABLE IF NOT EXISTS gb (
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            message text NOT NULL,
            time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9;";
    //sending query to SQL Database
     $conn->query($sql);
 //close connection
    $conn->close();
}

?>
  <div id="wrapperguest">
    <h1>Guest Book</h1>
    <section id="guestform">
        <h1>New Post</h1>
        <FORM id="guestpostForm" METHOD="POST" ACTION="">
            <label for="postName">Please enter your name:</label> <br>
            <INPUT id="postName" placeholder="Name" required="" type="text" NAME="name" size="30"></INPUT> <br>

            <label for="postComment">Make any comments you'd like below:</label>
            <TEXTAREA id="postComment" placeholder="Your comment..." required="" NAME="comment" ROWS=6 COLS=60></TEXTAREA>
            <button id="newpost" type="submit" VALUE="submit">Submit new Post</button>
        </FORM>
    </section>
    <section id="guestfeed">
        <h1>Posts</h1>
        <ul id="postList"></ul>
    </section>
</div>
<script type="text/javascript" src="js/getPosts.js"></script>
<?php include 'footer.php'; ?>
