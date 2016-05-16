<ul class="menu">
   <li <?php echo ($page == 'welcome') ? 'class="current"' : '';?>> 
        <a href="index.php">Welcome</a>
    </li>
    <li <?php echo ($page == 'Guestbook') ? 'class="current"' : '';?>> 
        <a href="guestbook.php">Guestbook</a> 
    </li>
    <li <?php echo ($page == 'Min Filmsamling') ? 'class="current"' : '';?>> 
        <a href="movies.php">Movies</a> 
    </li>
     <li <?php echo ($page == 'tips') ? 'class="current"' : '';?>> 
        <a href="tips.php">Movie Tips</a>
    </li>      
     <li <?php echo ($page == 'admin') ? 'class="current"' : '';?>> 
               <a href="admin.php">
               <?php if(!isset($_SESSION['admin'])){
                        echo 'Login';
                    }else{
                        echo 'Admin';
                    } ?> 
               </a>
    </li>
</ul>


