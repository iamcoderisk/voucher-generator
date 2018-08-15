<!DOCTYPE html>
<html>
<head>
	<title>Voucher Pool</title>
	<link rel="stylesheet" type="text/css" href="../web/css/app.css">
	<link rel="stylesheet" type="text/css" href="../web/css/fiiA/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<h1 class="text-center">Voucher Code Generator</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
				<?php if(!empty($errors)){
					foreach($errors as $error){
						echo $error."<br>";
					}
				}
				if(!empty($response)){
                   foreach($response as $key=>$value){
                      if($key=='success'){
                         echo '
                      <div class="alert alert-success">
                      '
                      .$value.'</div>
                    ';
                      }else if($key=='failed'){
                         echo '
                      <div class="alert alert-danger">
                      '
                      .$value.'</div>
                    ';
                      }
                   }
                  }
				?>
			<hr>
			<div class="col-md-5">
					<h2>Recipient</h2>
					<form class="form-group" method="post" action="">
						<div class="form-group">
							<input type="text" name="recipient_name" class="form-control" placeholder="Recipient Name">
						</div>
							<div class="form-group">
							<input type="text" name="recipient_email" class="form-control" placeholder="Recipient Email">
						</div>
			</div>

			<div class="col-md-5">
				<h2>Special Offer</h2>
						<div class="form-group">
							<input type="text" name="offer_name" class="form-control" placeholder="Offer Name">
						</div>
						<div class="form-group">
							<input type="text" name="discount" class="form-control" placeholder="Fixed Percentage Discount">
						</div>
						<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">Generate Voucher</button>
						</div>

			</div>
		</form>
		</div>
	</div>
	<hr>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<?php
				if(!empty($data)){
				echo'<table>
					<tr>
						<th>
							Voucher Code
						</th>
						<th>Recipient</th>
						<th>Offer Name</th>
						<th>Status</th>
						<th>Date Created</th>
						<th>Date of Usage</th>
						<th>Expiry Date</th>
						<th>Action</th>
					</tr>
					<tr>
						';

						 foreach($data as $info){
						 	echo "<tr>";
							echo'<td>
						'.$info->v_id.'</td>
						<td>'.$info->recipient_email.'</td>
						<td>'.$info->offer_name.'</td>
						';
						if($info->trial_times==0){ 
							echo"<td>not used</td>";
						 }else if($info->trial_times==1){
						 	echo "<td>already used</td>";
						}

							echo '
							<td>'.$info->created.'</td>';
							if($info->date_of_usage==null){
								echo '
							<td> NULL</td>';
						}else{
							echo '
							<td>'.$info->date_of_usage.'</td>';
						}
						if(date("Y-m-d")>$info->expiry_date){
							echo'<td>Expired!</td>';
							echo '<td>NULL</td>';
						}else{
							echo'<td>'.$info->expiry_date.'</td>';
							echo '<td><a href="?id='.$info->v_id.'&item='.$info->offer_name.'&email='.$info->recipient_email.'">Purchase Item</a></td>';
						}
						
						
						echo "</tr>";
					}
					
						echo'
					</tr>
				</table>';
			}else{
		
						
			}?>
			</div>
		</div>
	</div>
</body>
</html>