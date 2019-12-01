<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Read Product</h1>
        </div>
         
        <!-- PHP read one record will be here -->
 	<?php
 	// get passed parameter value, in this case, the record ID
 	// isset() is a PHP function used to verify if a value is there or not
 	$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 	
 	//include database connection
 	include 'config/database.php';
 	
 	// read current record's data
 	try {
 	// prepare select query
 	$query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
 	$stmt = $con->prepare( $query );
 	
 	// this is the first question mark
 	$stmt->bindParam(1, $id);
 	
 	// execute our query
 	$stmt->execute();
 	
 	// store retrieved row to a variable
 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
 	
 	// values to fill up our form
 	$name = $row['name'];
 	$description = $row['description'];
 	$price = $row['price'];
 	}
 	
 	// show error
 	catch(PDOException $exception){
 	die('ERROR: ' . $exception->getMessage());
 	}
 	?>
        <!-- HTML read one record table will be here -->
 	<!--we have our html table here where the record will be displayed-->
 	<table class='table table-hover table-responsive table-bordered'>
 	<tr>
 	<td>Name</td>
 	<td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
 	</tr>
 	<tr>
 	<td>Description</td>
 	<td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
 	</tr>
 	<tr>
 	<td>Price</td>
 	<td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
 	</tr>
 	<tr>
 	<td></td>
 	<td>
 	<a href='index.php' class='btn btn-danger'>Back to read products</a>
 	</td>
 	</tr>
 	</table>
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="js/bootstrap.js"></script>
 
</body>
</html>