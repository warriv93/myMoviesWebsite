<?php include 'header.php'; $page='tips'; include 'menu.php';

function getMovieTips(){
    //init SQLDATABASE connection variables
    $servername = "localhost";
    $username = "cs2013";
    $password = "abc123";
    $dbname = "cs2013";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //Creating the SQL query
    $sql = "SELECT title, grade, year FROM movies
            ORDER BY grade DESC
            LIMIT 10;
            ";
    //sending query to SQL Database and saves result in $result
    $result = $conn->query($sql);
    //if there is something in the result we will loop though every line
    if ($result->num_rows > 0) {
        // on each row print content as HTML to fit in nicely to my site.
        while($row = $result->fetch_assoc()) {
            echo    '<li>
                        <table>
                            <tr><th>Title:</th> <th>Grade:</th><th>Year:</th></tr>
                                <tr><td>'.$row["title"].'</td>
                                <td>'.$row["grade"].'</td>
                                <td>'.$row["year"].'</td>
                            </tr>
                        </table>
                    </li>';
        }
    } else {
        echo "0 results";
    }
    //close connection
    $conn->close();
}
?>
   <section id="tipsSection">
       <h1>Movie Tips</h1>
        <ul id="list">
            <?php getMovieTips(); ?>
        </ul>
    </section>
<?php include 'footer.php'; ?>
