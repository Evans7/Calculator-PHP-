
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">

div
{
    display: block;
    text-align: center;
    font-size:37px;
    margin-left: 60px;
    margin-top: 40px;
}
form
{
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    font-size:37px;
}
p{
   font-family: Arial, Helvetica, sans-serif;
   font-size: 37px;
}

  </style>
	<title>Calci</title>
</head>
<body style='text-align: center;display: inline-block;'>
	<div>
<form>
		<label for="num1">Operand 1:</label>
   <input type="text" name="num1" placeholder="Number 1">
   
	<label for="num2">Operand 2:</label>
   <input type="text" name="num2" placeholder="Number 2">
    
   <select name="operator">
   	<option>+</option>
   	<option>-</option>
   	<option>*</option>
   	<option>/</option>
   </select>
   <br>
 <br>
   <button type="submit" name="submit" value="submit" style="width: 100%">Calculate</button>
 
 </form>

<br><br>
<p style="text-align: :center !important;">Result :</p>
<p>
	<?php
if(isset($_GET['submit'])){
	$operand1=$_GET['num1'];
	$operand2=$_GET['num2'];
    $operator=$_GET['operator'];
    $result=0;
try{
switch($operator) {
   case '+': 
      $result=$operand1+$operand2;
      echo $result;
      break;
   case '-': 
   $result=$operand1-$operand2;
       echo $result;
      break;
   case '*':
   $result=$operand1*$operand2; 
       echo $result;  
         break;
   case '/': 
   $result=$operand1/$operand2;
      echo $result;
      break;
}

if(isset($_GET['submit']) && $_GET['num1']!=null && $_GET['num2']!=null) {
try{
$conn= mysqli_connect('localhost','evans','password12','assignment');
 
 if(!$conn){
   echo 'Connection error:' . mysqli_connect_error();
 }
 $sql = "INSERT INTO results (operand1, operator, operand2,result)
VALUES ('$operand1','$operator', '$operand2', '$result')";
}
catch(Exception $e){
	echo "Error:".$e->getMessage();

}
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}
}
catch(Exception $e)
{
	echo 'An error has occured:'.$e->getMessage();
}
}
?>
</p>
<br>
<form>
<button type="submit" name="view" value="view1" style="width: 100%">View History</button>
<p style="text-align: center;">
<?php 
if(array_key_exists('view', $_GET)) { 
            button1(); 
        } 
        
        function button1() { 

$conn= mysqli_connect('localhost','evans','password12','assignment');
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM results";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
  // output data of each row
  while($row = $results->fetch_assoc()) {
    echo  $row["operand1"]. " " . $row["operator"]. " " . $row["operand2"]." = ".$row["result"]."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
     } 
?>
</p>
</form>
<br>
<form>
	<button type="submit" name="clear" value="clear" style="width: 100%">Clear History</button>
	<p>
<?php 
if(array_key_exists('clear', $_GET)) { 
            button2(); 
        }        
        function button2() { 
$conn= mysqli_connect('localhost','evans','password12','assignment');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM results";
if ($conn->query($sql) === TRUE) {
  echo "History Cleared.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
        } 
?>
</p>
	</form>
</div>
	</body>
</html>