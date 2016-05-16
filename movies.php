<?php include 'header.php'; $page='Min Filmsamling' ; include 'menu.php'; 

function getMovieInfo() {  
      //if GET title2 variable is not empty
      if (isset($_GET['title2'])) {
        $newtitle = htmlspecialchars($_GET['title2']);
         // echo $newtitle.'<br>';

          //read file content
        $filename ='movie.txt';
        $handle = fopen('movie.txt', 'r');
        $datain = fread($handle, filesize($filename));
        //śplit movies
        $movie_array = explode('__', $datain);
        fclose($handle);
        //split content of each movie. and adding to 2d array
        for($i=0; $i<count($movie_array)-1; $i++) {
            $movie_array[$i] = explode(';', $movie_array[$i]);
        }
          //loop though the array and when the names matches print content
        for($i=0; $i<count($movie_array)-1; $i++) { 
            if($newtitle==$movie_array[$i][0]){
                echo '<div id="container">
                <h1>'.$movie_array[$i][0].'</h1> 
                <p>'.$movie_array[$i][4].'</p>
                <img alt="movieImg" src="'.$movie_array[$i][3].'">
                <p>Betyg: '.$movie_array[$i][1].'</p>   
                <p>Länk till IMDB: <a href="'.$movie_array[$i][2].'" target="_blank">'.$movie_array[$i][2].'</a></p></div> ';
                  break;
                }
            }
        }
     //if GET title2 variable is empty
        if (!isset($_GET['title2'])) {
          //read file content
            $filename ='movie.txt';
            $handle = fopen('movie.txt', 'r');
            $datain = fread($handle, filesize($filename));
            fclose($handle);
            //śplit movies
            $movie_array = explode('__', $datain);
            //test to see if there is anything in the txt file.
            //foreach($movie_array as $movieitem){
            //    echo '<br>'.$movieitem.'<br><br>';
            //}
            //split content of each movie. and adding to 2d array
            for($i=0; $i<count($movie_array)-1; $i++) {
                $movie_array[$i] = explode(';', $movie_array[$i]);
            }
            //print_r($movie_array);
            for($i=0; $i<count($movie_array)-1; $i++) { 
                // echo $movie_array[$i][0]. "<br>"; 
                echo '<li>
                <form action="#" method="get">
                    <table>
                        <tr><th>Titel:</th> <th>Betyg:</th></tr>
                            <tr><td><button name="title2" value="'.$movie_array[$i][0].'">'.$movie_array[$i][0].'</button></td>
                            <td>'.$movie_array[$i][1].'</td>
                        </tr></table></form></li>'; 
            }
        }
} 
?>
<div id="wrapper">
    <h1>Min Filmsamling</h1>
    <section id="right">
        <ul id="list">
            <?php   getMovieInfo(); ?>
        </ul>
    </section>
</div>
<?php include 'footer.php'; ?>