<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Read Products</h1>
        </div>
     
        <!-- PHP code to read records will be here -->
         <?php
         // include database connection
         include 'config/database.php';
         
   // PAGINATION VARIABLES
   // page is the current page, if there's nothing set, default is page 1
   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   
   // set records or rows of data per page
   $records_per_page = 5;
   
   // calculate for the query LIMIT clause
   $from_record_num = ($records_per_page * $page) - $records_per_page;
   
         // delete message prompt will be here
         $action = isset($_GET['action']) ? $_GET['action'] : "";
         
         // if it was redirected from delete.php
         if($action=='deleted'){
         echo "<div class='alert alert-success'>Record was deleted.</div>";
         }
         
         // select all data
         $query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
         $stmt = $con->prepare($query);
         $stmt->execute();
         
         // this is how to get number of rows returned
         $num = $stmt->rowCount();
         
         // link to create record form
         echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
         
         //check if more than 0 record found
         if($num>0){
         
         // data from database will be here
         echo "<table class='table table-hover table-responsive table-bordered'>";//start table
         
         //creating our table heading
         echo "<tr>";
         echo "<th>ID</th>";
         echo "<th>Name</th>";
         echo "<th>Description</th>";
         echo "<th>Price</th>";
         echo "<th>Action</th>";
         echo "</tr>";
         
         // table body will be here
         // retrieve our table contents
         // fetch() is faster than fetchAll()
         // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         // extract row
         // this will make $row['firstname'] to
         // just $firstname only
         extract($row);
         
         // creating new table row per record
         echo "<tr>";
         echo "<td>{$id}</td>";
         echo "<td>{$name}</td>";
         echo "<td>{$description}</td>";
         echo "<td>&#36;{$price}</td>";
         echo "<td>";
         // read one record 
         echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
         
         // we will use this links on next part of this post
         echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
         
         // we will use this links on next part of this post
         echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
         echo "</td>";
         echo "</tr>";
         }
         // end table
         echo "</table>";
         }
         
         // if no records found
         else{
         echo "<div class='alert alert-danger'>No records found.</div>";
         }
         ?>
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->

<script src="js/bootstrap.js"></script>
 
<!-- confirm delete record will be here -->
 <script type='text/javascript'>
 // confirm record deletion
 function delete_user( id ){
 
 var answer = confirm('Are you sure?');
 if (answer){
 // if user clicked ok, 
 // pass the id to delete.php and execute the delete query
 window.location = 'delete.php?id=' + id;
 } 
 }
 </script>
</body>
</html>