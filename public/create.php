<?php

if (isset($_POST['submit'])) {
    //what will happen if user clicks submit
   
    //load config file
    require "../config.php";
    
    try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_work = array( 
            "artistname" => $_POST['artistname'], 
            "worktitle" => $_POST['worktitle'],
            "workdate" => $_POST['workdate'],
            "worktype" => $_POST['worktype'], 
        );
        
        // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO works (artistname, worktitle, workdate, worktype) VALUES (:artistname, :worktitle, :workdate, :worktype)";        
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_work);
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}
    
}


?>



<?php include "templates/header.php"; ?>

<form method="post">

    <label for="artistname">Artist Name</label>
    <input type="text" name="artistname" id="artistname">

    <label for="worktitle">Work Title</label>
    <input type="text" name="worktitle" id="worktitle">

    <label for="workdate">Work Date</label>
    <input type="text" name="workdate" id="workdate">

    <label for="worktype">Work Type</label>
    <input type="text" name="worktype" id="worktype">

    <input type="submit" name="submit" id="submit">


</form>
      
    
<?php include "templates/footer.php"; ?>