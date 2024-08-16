<?php
//require_once("../includes/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="10"></meta> -->
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo isset($title) ? $title . ' | ALOHA NUI HOTEL' :  'ALOHA NUI HOTEL' ; ?></title>
<link rel="icon" type="image/png" href="https://i.ibb.co/ydJWLjZ/alohalogo.png">

<link href="<?php echo WEB_ROOT; ?>admin/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo WEB_ROOT; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>admin/css/jquery.dataTables.css">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome Icons -->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


<link href="<?php echo WEB_ROOT; ?>admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>


</head>
<script type="text/javascript">
//execute if all html elemen has been completely loaded
$(document).ready(function(){

//specify class name of a specific element. click event listener--
$('.cls_btn').click(function(){
//access the id of the specific element that has been click	
var id = $(this).attr('id');
//to debug every value of element,variable, object ect...
console.log($(this).attr('id'));

//execute a php file without reloading the page and manipulate the php responce data
$.ajax({

  type: "POST",
  //the php file that contain a mysql query
  url: "some.php",
  //submit parameter
  data: { id:id,name:'kevin' }
})
//.done means will execute if the php file has done all the processing(ex: query)
  // .done(function( msg ) {
  // 	//decode JSON from PHP file response
  // 	var result = JSON.parse(msg);

  // 	console.log(this);
    
  // 	//apply the value to each element
  //   $('#display #infoid').html(result[0].member_id);
  //   $('#display #infoname').html(result[0].fName+" "+result[0].lName);
  //   $('#display #Email').html(result[0].email);
  //   $('#display #Gender').html(result[0].gender);
  //   $('#display #bday').html(result[0].bday);
  //     });

});

});
</script>




</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.roomImg').click(function(){
			var id = $(this).data('id');
			// alert(id)
	 
		      $.ajax({    //create an ajax request to load_page.php
		        type:"POST",
		        url: "editpic.php",             
		        dataType: "text",   //expect html to be returned  
		        data:{ROOMID:id},               
		        success: function(data){                    
		           $('#myModal').modal('toggle').html(data); 
		            // alert(data);

		        } 
		    }); 
		}); 
});
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 1
        } ], 
       "order": [[ 1, 'desc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );


$(document).ready(function() {
    var t = $('#table').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ], 
       "order": [[ 7, 'desc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
    <link href="<?php echo WEB_ROOT; ?>admin/css/offcanvas.css" rel="stylesheet">
<?php
 

 admin_logged_in();
?>

<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Aloha Nui Hotel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo (currentpage() == 'index.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/index.php">Home</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_room') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_room/index.php">Rooms</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_comments') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_comments/index.php">Comments</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_accomodation') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_accomodation/index.php">Accommodation</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'booking') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/booking">Booking</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_reservation') ? 'active' : ''; ?>">
          <?php
            $query = "SELECT count(*) as 'Total' FROM `tblpayment` WHERE `STATUS`='Pending'";
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList();  
            foreach ($cur as $result) { 
          ?>
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_reservation/index.php">
            Reservation <?php echo isset($result->Total) ? '<span style="color:red">(' . $result->Total . ')</span>' : ''; ?> 
          </a>
          <?php 
            }
          ?>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_reports') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_reports/index.php">Reports</a>
        </li>
        <li class="nav-item <?php echo (currentpage() == 'mod_gallery') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_gallery/index.php">Room Gallery</a>
        </li>
        <?php if ($_SESSION['ADMIN_UROLE'] == "Administrator") { ?>
          <li class="nav-item <?php echo (currentpage() == 'mod_users') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_users/index.php">Users</a>
          </li>
          <li class="nav-item <?php echo (currentpage() == 'modaudit') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/modaudit/index.php">Audit</a>
          </li>
          <li class="nav-item <?php echo (currentpage() == 'mod_coupons') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin/mod_coupons/index.php">Coupons</a>
          </li>
        <?php } ?>
		<li class="nav-item <?php echo (currentpage() == 'logout.php') ? 'active' : ''; ?>">
    <?php
    $logoutHref = (currentpage() == 'index.php') ? 'admin/logout.php' : 'logout.php';
    ?>
    <a class="nav-link toggle-modal" href="<?php echo WEB_ROOT . 'admin/' . $logoutHref; ?>">Logout</a>
</li>
      </ul>
    </div>
  </div>
</nav>
<!-- End of Header -->
<!-- Logout Modal -->



<div class="container">

<?php //check_message(); ?>
<?php require_once $content;?>
	<!--/row-->
	
	<hr>
	     <footer>
        <p>&copy; Aloha Nui Hotel </p>

        <script>


		  function checkall(selector)
		  {
		    if(document.getElementById('chkall').checked==true)
		    {
		      var chkelement=document.getElementsByName(selector);
		      for(var i=0;i<chkelement.length;i++)
		      {
		        chkelement.item(i).checked=true;
		      }
		    }
		    else
		    {
		      var chkelement=document.getElementsByName(selector);
		      for(var i=0;i<chkelement.length;i++)
		      {
		        chkelement.item(i).checked=false;
		      }
		    }
		  }

		  function checkNumber(textBox)
			{
				while (textBox.value.length > 0 && isNaN(textBox.value)) {
					textBox.value = textBox.value.substring(0, textBox.value.length - 1)
				}
				textBox.value = trim(textBox.value);
			}
			//
			function checkText(textBox)
			{
				var alphaExp = /^[a-zA-Z]+$/;
				while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
					textBox.value = textBox.value.substring(0, textBox.value.length - 1)
				}
				textBox.value = trim(textBox.value);
			}
		  </script>			
      </footer>
</div>
<!--/.container-->



</body>
</html>
 <script type="text/javascript">
	$('.start').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.end').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>