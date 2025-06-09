<table class="table table-bordered table-hover">
<?php

require_once '../authentication/admin-class.php';
include_once __DIR__.'/../../../database/dbconfig2.php';

$user = new ADMIN();
if(!$user->isUserLoggedIn())
{
 $user->redirect('../../../private/admin/');
}


function get_total_row($pdoConnect)
{
  $pdoQuery = "SELECT COUNT(*) as total_rows FROM package";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute();
  $row = $pdoResult->fetch(PDO::FETCH_ASSOC);
  return $row['total_rows'];
}

$total_record = get_total_row($pdoConnect);
$limit = '20';
$page = 1;
if(isset($_POST['page']))
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM package
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  WHERE package LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY id DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdoConnect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $pdoConnect->prepare($filter_query);
$statement->execute();
$total_filter_data = $statement->rowCount();

if($total_data > 0)
{
$output = '
  <div class="row-count">
    Showing ' . ($start + 1) . ' to ' . min($start + $limit, $total_data) . ' of ' . $total_record . ' entries
  </div>
    <thead>
    <th>PACKAGE</th>
    <th>PRICE (PHP)</th>
    <th>CREDITS</th>
    <th>DATE</th>
    <th>ACTION</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {

    $output .= '
    <tr>
      <td>'.$row["package"].'</td>
      <td>'.$row["price"].'</td>
      <td>'.$row["number_of_post"].'</td>
      <td>'.date("F j, Y h:i A", strtotime($row['created_at'])).'</td>
      <td><button type="button" class="btn btn-primary V"><a href="edit-package?id=' . $row["id"] . '" class="edit"><i class="bx bxs-edit"></i></a></button></td>
    </tr>
    ';
  }
}
else
{
  echo '<h1>No Data Found</h1>';
}

$output .= '
</table>
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 5)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  $page_array[] = '...';
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only"></span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id > $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script src="../../src/js/form.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>


</table>