<?php include 'header.php'; $page='admin' ; include 'menu.php';?>
<div id="wrapper_admin">
    <div id="content">
<?php
    session_start();
//print loginForm
function loginForm(){
echo'
    <section id="login">
      <p id="title"><strong>Login</strong></p>
      <form action="#" method="POST">
         <input name="username" id="un" required="" placeholder="Username" type="text">
         <input name="password" id="pw" required="" placeholder="Password" type="password">

         <button type="submit" value="submit" id="signin" >
             <strong> Sign In</strong>
         </button>
      </form>
    </section>
     '; }

 //init SQLDATABASE connection variables
    $servername = "localhost";
    $username = "***";
    $password = "****";
    $dbname = "****";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//Creating the SQL query
//creates user table if not exist

    $sql = "CREATE TABLE IF NOT EXISTS users (
            id int(11) NOT NULL AUTO_INCREMENT,
            username varchar(100) NOT NULL,
            password varchar(128) NOT NULL,
            PRIMARY KEY (id)
            )";
    //sending query to SQL Database
     $conn->query($sql);


//insert admin user
$password = 'admin';
$hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (username, password)
            VALUES ("admin","'.$hash.'")
            WHERE NOT EXISTS ( SELECT * FROM users
                   WHERE username = admin
                   );';
    //sending query to SQL Database
     $conn->query($sql);


//logic for checking login credentials
if(isset($_POST['username']) && isset($_POST['password'])){
    $usernametemp =  htmlentities($_POST['username']);
    $passwordtemp  =   htmlentities($_POST['password']);
    //removes HTML tags and strips the content to max 13 chars
    $username = strip_tags(substr($usernametemp, 0, 13));
    $password = strip_tags(substr($passwordtemp, 0, 13));

    //prevent SQL injections
    $stmt = $conn->prepare('SELECT * FROM users WHERE username=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();

    //$sql='SELECT * FROM users WHERE username="'.$username.'";';
   // $result = $conn->query($result);
    // If result matched $username and $password, table row must be 1 row
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])){
                $_SESSION['admin'] = stripslashes(htmlspecialchars($_POST['username']));
            } else {
                echo '<br>The Username or Password you entered is incorrect.';
                break;
            }
        }
    }else{
        echo '<br>The Username or Password you entered is incorrect.';
    }
        //close stmt
      $stmt->close();
}
//LOGOUT
if(isset($_GET['logout'])){
	//Simple exit message
     // remove all session variables
    session_unset();
    //destory session
	session_destroy();
	header("Location: admin.php"); //Redirect the user
}

//close connection
    $conn->close();
?>
<?php
//checks if user != admin
if(!isset($_SESSION['admin'])){
	loginForm();
} else{
    //report errors
ini_set('display_errors', 1);
error_reporting(~0);

//check if something is posted from every inputfield_
if(isset($_POST['title']) && isset($_POST['betyg']) && isset($_POST['imdb']) && isset($_POST['handling']) && isset($_POST['bild'])){
   //save values of fields into variables
    $title = htmlentities($_POST['title']);
    $grade = htmlentities($_POST['betyg']);
    $imdb = htmlentities($_POST['imdb']);
    $handling = htmlentities($_POST['handling']);
    $bild = htmlentities($_POST['bild']);
    //print result
   // echo '   '.$title.'             '.$grade.'      '.$imdb.'                '.$handling.'              '.$bild;
//save input to file
$handle = fopen ('movie.txt', 'a');
fwrite($handle, $title.";".$grade.";".$imdb.";".$bild.";".$handling."__");
//close connection with file
fclose($handle);
        }
?>
    <section id="adminright">
        <h1>Welcome to the admin page: <?php echo''.$_SESSION['admin'].''; ?></h1>
        <p>You can add movies to the list in "Movies""</p>
        <form action="#" method="GET">
            <button href="" name="logout" value="logout">Logout</button>
        </form>
    </section>
       <section id="left">
             <form action="#" method="POST" id="saveMovies">
            <fieldset>
                <legend>Add a movie:</legend>
                <label for="title">Title:</label>
                <input type="text" value="" name="title" id="title">
                <br>
                <label for="grade">Grade:</label>
                <select name="betyg" id="grade">
                    <option value="0">Select grade</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <label for="imdb">Link to imdb:</label>
                <input type="text" value="" name="imdb" id="imdb">
                <br>
                <label for="bild">Link to pic:</label>
                <input type="text" value="" name="bild" id="bild">

                <label for="handling">Plot of movie:</label>
                <input type="text" value="" name="handling" id="handling">

                <input type="submit" value="Submit" id="save">
            </fieldset>
        </form>
        </section>
        <?php        }     ?>
    </div>
</div>
    <?php include 'footer.php'; ?>
