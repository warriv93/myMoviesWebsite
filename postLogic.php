<?php
    $servername = "localhost";
    $username = "****";
    $password = "****";
    $dbname = "****";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//incase of post new comment
if(isset($_POST['name']) && isset($_POST['comment'])){
    $nametemp =  htmlentities($_POST['name']);
    $commenttemp  =  htmlentities($_POST['comment']);
    $name = strip_tags(substr($nametemp, 0, 13));
    $comment = strip_tags(substr($commenttemp, 0, 250));

     /*  //prevent SQL injections
    $stmt = $conn->prepare('INSERT INTO gb (name, message)
            VALUES (":1",":2");');
    $stmt->bindValue(":1", $name, SQLITE3_TEXT);
    $stmt->bindValue(":2", $comment, SQLITE3_TEXT);
    $stmt->execute();

    $result = $stmt->get_result();
    */
        //add new posts to database
    $sql = 'INSERT INTO gb (name, message) VALUES ("'.$name.'","'.$comment.'");';
    $result = $conn->query($sql);
    //return value
     echo''.$name.'__'.$comment.'';
}
//incase of updating list
   if(isset($_GET['action']) and $_GET['action'] == "getPosts"){
      //print existing posts
        $sql2 = "SELECT * FROM gb ORDER BY time DESC";
        $result = $conn->query($sql2);
        //if there is any match in db
        if ($result->num_rows > 0) {
          //create a array JSON obj
            $posts = new ArrayObject();
            while($row = $result->fetch_assoc()) {
                $m = new ArrayObject();
                $m['name'] = $row['name'];
                $m['message'] = $row['message'];
                $posts['posts'][] = $m;
            }
            echo json_encode($posts);
        }else {
            echo "0 results";
        }
   }
//close connection
    $conn->close();
?>
