
<?php 

include 'db.php';
header('Content-type:text/csv');
header('Content-disposition:attachment;filename=Property.csv');
$output=fopen("php://output","w");
fputcsv($output,array('Id','User','Name','Location','price','type','image','time'));
$result=$conn->query("select * from properties");
while($row=$result->fetch_assoc()){
    fputcsv($output,$row);
}

?>
