<table class="table table-bordered table-hover">
<?php

require_once '../authentication/admin-class.php';
include_once '../../../database/dbconfig2.php';


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('../../public/admin/signin');
}


function get_total_row($pdoConnect)
{

}

$total_record = get_total_row($pdoConnect);

$page = 1;
if(isset($_POST['page']))
{
  $start = ($_POST['page']);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM location 
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  WHERE location_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY location_name ASC ';


$statement = $pdoConnect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();


if($total_data > 0)
{
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    $output .= '
      <h1><a href="controller/add-location-controller.php?Id='.$row['Id'].'">'.$row["location_name"].'</a></h1>
    ';
  }
}
else
{
  echo '<h2>No Data Found</h2>';
}

$output .= '
</table>
';

$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>

<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script>


</script>
</table>