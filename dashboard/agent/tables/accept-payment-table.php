<table class="table table-bordered table-hover">
<?php

require_once '../authentication/agent-class.php';
include_once __DIR__.'/../../../database/dbconfig2.php';

$user = new AGENT();
if(!$user->isUserLoggedIn())
{
 $user->redirect('../../../private/agent/');
}



function get_total_row($pdoConnect)
{
  $pdoQuery = "SELECT COUNT(*) as total_rows FROM property_reservation WHERE  agent_id = :agent_id AND status = :status";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(array(":agent_id" =>$_SESSION['agent_session'], ":status" => "accept"));
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
SELECT * FROM property_reservation WHERE agent_id = :agent_id AND status = :status
";
$output = '';
if($_POST['query'] != '')
{
  $query .= '
  AND user_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  AND status LIKE "%'.str_replace(' ', '%', $_POST['query']).'%"
  ';
}

$query .= 'ORDER BY id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdoConnect->prepare($query);
$statement->execute(array(":agent_id" =>$_SESSION['agent_session'],":status" => "accept"));
$total_data = $statement->rowCount();

$statement = $pdoConnect->prepare($filter_query);
$statement->execute(array(":agent_id" =>$_SESSION['agent_session'],":status" => "accept"));
$total_filter_data = $statement->rowCount();

if($total_data > 0)
{
$output = '
    <div class="row-count">
      Showing ' . ($start + 1) . ' to ' . min($start + $limit, $total_data) . ' of ' . $total_record . ' entries
    </div>
    <thead>
    <th>STATUS</th>
    <th>RESERVATION DATE</th>
    <th>PROPERTY NAME</th>
    <th>USER EMAIL</th>
    <th>USER CONTACT</th>
    <th>BOOKING DATE</th>
    <th>MESSAGE</th>
    <th>PAYMENT ACCEPT DATE</th>
    </thead>
';
  while($row=$statement->fetch(PDO::FETCH_ASSOC))
  {
    //user data
    $user_id = $row['user_id'];
    $pdoQuery = "SELECT * FROM users WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":id" => $user_id));
    $user_data = $pdoResult->fetch(PDO::FETCH_ASSOC);

    //property data
    $property_id = $row['property_id'];
    $pdoQuery = "SELECT * FROM property WHERE id = :id";
    $pdoResult1 = $pdoConnect->prepare($pdoQuery);
    $pdoExec1 = $pdoResult1->execute(array(":id" => $property_id));
    $property_data = $pdoResult1->fetch(PDO::FETCH_ASSOC);

    if($row["status"] == "accept"){
      $status = '<button type="button" class="btn btn-warning N">Accepted</button>';
    }



    $output .= '
    <tr>
      </td>
      <td>'.$status.'</td>
      <td>'.date("F d, Y", strtotime($row["created_at"])).'</td>
      <td><a href="#" onclick="setSessionValues('.$row['property_id'].')">'.$property_data["property_name"].'</a></td>
      <td>'.$user_data["email"].'</td>
      <td>+63'.$row["user_phone_number"].'</td>
      <td>'.date("F d, Y", strtotime($row["booking_start_date"])).' to '.date("F d, Y", strtotime($row["booking_end_date"])).'</td>
      <td>'.$row["message"].'</td>
      <td>'.date("F d, Y", strtotime($row["accept_date"])).'</td>
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
  <ul class="reservation_pagination">
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
<script src="../../src/js/form.js"></script><!-- Add these links to include Lightbox2 CSS and JS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>
<script>
          function setSessionValues(propertyId) {
            fetch('property-details.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'property_id=' + encodeURIComponent(propertyId),
                })
                .then(response => {
                    window.location.href = 'property-details';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        //Send Email
$('.send').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href')

	swal({
		title: "Sure?",
		text: "Do you want to send email to this user?. Once you send an email all the reservation from this property will be marked as waiting.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				document.location.href = href;
			}
		});
})
</script>

</table>