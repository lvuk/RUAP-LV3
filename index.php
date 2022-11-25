<html>
<head>
 <Title>Registration Form</Title>
 <style type="text/css">
 body {
 background-color: #fff;
 border-top: solid 10px #000;
 color: #333;
 font-size: .85em;
 margin: 20;
 padding: 20;
 font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 }
 h1,
 h2,
 h3,
 {
 color: #000;
 margin-bottom: 0;
 padding-bottom: 0;
 }
 h1 {
 font-size: 2em;
 }
 h2 {
 font-size: 1.75em;
 }
 h3 {
 font-size: 1.2em;
 }
 table {
 margin-top: 0.75em;
 }
 th {
 font-size: 1.2em;
 text-align: left;
 border: none;
 padding-left: 0;
 }
 td {
 padding: 0.25em 2em 0.25em 0em;
 border: 0 none;
 }
 </style>
</head>
<body>
 <h1>Register here!</h1>
 <p>Fill in your name and email address, then click <strong>Submit</strong> to
register.</p>
 <form method="post" action="index.php" enctype="multipart/form-data">
 Name
 <input type="text" name="name" id="name" />
 </br> Email
 <input type="text" name="email" id="email" />
 </br>
 <input type="submit" name="submit" value="Submit" />
 </form>
 <?php
// DB connection info
// TODO: Update the values for $host, $user, $pwd, and $db //using the values you retrieved earlier from the Azure Portal. $host = "value of Data Source";
$host = "2fast4you.mysql.database.azure.com";
$user = "luka";
$pwd = "134679258Qwer";
$db = "lukadb";
// Connect to database.
$conn = mysqli_connect($host, $user, $pwd, $db);
if (mysqli_connect_errno())
{
echo "<h3>Failed to connect to MySQL:</h3> " . mysqli_connect_error();
}
 else
{
// echo '<h3>Connected successfully</h3>';
}
// Insert registration info
if (!empty($_POST))
{
$name = $_POST['name'];
$email = $_POST['email'];
$date = date("Y-m-d");
// Insert data
$sql_insert = "INSERT INTO registration_tbl (name, email, date)
VALUES ('$name','$email','$date')";
if ($conn->query($sql_insert) === TRUE)
{
echo "<h3>Your're registered!</h3>";
// // Retrieve data
$sql_select = "SELECT * FROM registration_tbl";
$registrants = $conn->query($sql_select);
if ($registrants->num_rows > 0)
{
echo "<h2>People who are registered:</h2>";
echo "<table>";
echo "<tr><th>Name</th>";
echo "<th>Email</th>";
echo "<th>Date</th></tr>";
while ($registrant = $registrants->fetch_assoc())
{
echo "<tr><td>" . $registrant['name'] . "</td>";
echo "<td>" . $registrant['email'] . "</td>";
echo "<td>" . $registrant['date'] . "</td></tr>";
}
echo "</table>";
}
 else
{
echo "<h3>No one is currently registered.</h3>";
}
}
 else
{echo "Insert Failed";
}
}
?>
</body>
</html>