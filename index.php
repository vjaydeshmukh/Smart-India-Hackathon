<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container-fixed">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="5" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="6" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/s1.jpg" class="img" alt="First slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/s2.jpg" class="img" alt="Second slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/s3.jpg" class="img" alt="Third slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/s4.jpg" class="img" alt="Third slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/s5.jpg" class="img" alt="Third slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/s6.jpg" class="img" alt="Third slide" >
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <h2>Monthly Top Sellers</h2>
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
		       			 	$limit = 19; 
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY name ASC LIMIT 0, $limit");
						    $stmt->execute();

						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						?>
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
	<img src="<?php echo $image;?>" width='100%' height='230px' class='thumbnail'>
		       									<h5>
<a href="product.php?product=<?php echo $row['slug'];?>">
	<?php echo $row['name'];?></a></h5>
											<h5 class="starLine">
												<i class="far fa-star star"></i>
												<i class="far fa-star star"></i>
												<i class="far fa-star star"></i>
												<i class="far fa-star star"></i>
												<i class="far fa-star star"></i>
											</h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>
		       										<a href="view_details.php?product=<?php echo $row['id']?>" class="btn btn-success">
		       										View Details
		       									</a>
<span class="pull-right"><i class="fas fa-tags text-success"></i> .<?php echo number_format($row['price'], 2)?></span></b>
		       								</div>
		       								<div>
		       									<!-- <a href="book.php?product=<?php ?>" class="btn btn-success btn-sm">
		       										View Details
		       									</a> -->

		       								</div>
	       								</div>
	       							</div>
	       						<?php
	       						if($inc == 3)
	       						 echo "</div>";
						    }

						    if($inc == 1)
						     echo "<div class='col-sm-4'></div>
						 		<div class='col-sm-4'></div>
						 	</div>"; 

							if($inc == 2)
							 echo "<div class='col-sm-4'></div>
							</div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
		       		<?php 
						$conn=mysqli_connect('localhost','root','','ecomm'); 
						$sql = "SELECT COUNT(id) FROM products";  
						$rs_result = mysqli_query($conn, $sql);  
						$row = mysqli_fetch_row($rs_result);  
						$total_records = $row[0];  

						$total_pages = ceil($total_records / $limit);  
						$pagLink = "<div class='pagination'>";  
						for ($i=1; $i<=$total_pages; $i++) {  
						             $pagLink .= "<a href='index.php?page=".$i." class='link''>".$i."</a>";  
						};  
						echo $pagLink . "</div>";  
					?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>