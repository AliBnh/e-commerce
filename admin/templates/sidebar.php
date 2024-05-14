<?php
echo "
<head>
	<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap' rel='stylesheet'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' rel='stylesheet'>
	<link href='style.css' rel='stylesheet'>
</head>
<style>
body {
	margin: 0;
	padding: 0;
	font-family: 'Montserrat', sans-serif;
	background: #e3e9f7;
  }
  nav ul {
	margin: 0;
	padding: 0;
	height: 100%;
	width: 220px;
	position: fixed;
	top: 0;
	left: 0;
	background-color: #262626;
  }
  nav ul li {
	list-style: none;
  }
  nav ul li a {
	display: block;
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 16px;
	font-weight: 500;
	color: #fff;
	position: relative;
	padding: 10px 0 10px 30px;
	border-bottom: 1px solid #393939;
  }
  nav ul li a:before {
	content: '';
	position: absolute;
	top: 0px;
	right: 0px;
	width: 0%;
	height: 100%;
	background: white;
	border-radius: 40px 0px 0px 40px;
	z-index: -1;
	transition: all 300ms ease-in-out;
  }
  nav ul li a:hover {
	color: #2b2626;
  }
  nav ul li a:hover:before {
	width: 95%;
  }
  .wrapper {
	margin-left: 260px;
  }
  .section {
	display: grid;
	place-items: center;
	min-height: 100vh;
	text-align: center;
  }
  .box-area h2 {
	text-transform: uppercase;
	font-size: 50px;
  }
  .box-area p {
	line-height: 2;
  }
  .box-area {
	width: 90%;
  }
  .logo {
	height: 120px;
	overflow: hidden;
	margin-top: 20px;
	margin-left:-30px;
	margin-bottom: 40px;
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: center;

  }
  .logo img {
	width: 20%;
  }
  .logout {
	position: fixed;
	bottom: 0;
	left: 0;
	width: 220px;
	background-color: #262626;
	color: #fff;
	text-align: center;
	padding: 10px 0;
	text-transform: uppercase;
	font-size: 16px;
  }
  .logout:hover {
	background-color: white;
	color: #262626;
  }
  .logout:active {
	background-color: #262626;
  }


  
</style>  
	<nav>
		<ul>
			<li class='logo'>
				<img src='../../uploads/download.svg'>
				<h4 style='color:white;'>BrandHub</h4>
			</li>
			<li>
				<a href='../products/index.php'><i class='fa fa-home'></i>   home</a>
			</li>
			<li>
				<a href='../products/index.php'><i class='fa fa-product-hunt'></i>   Products</a>
			</li>
			<li>
				<a href='../categories/index.php'><i class='fa fa-list'></i>   Brands</a>
			</li>
			<li>
				<a href='../customers/index.php'><i class='fa fa-users'></i>   Customers</a>
			</li>
			<li>
				<a href='../orders/index.php'><i class='fa fa-shopping-cart'></i>   Orders</a>
			</li>
			<li>
				<a href='../customers/profile.php'> <i class='fa fa-cog '></i>   Settings</a>
  			</li>			

  	
		</ul>
		<a href='../logout.php' class='logout '>Logout</a>

	</nav>
	<div class='wrapper'>
		<div class='section'>
			<div class='box-area'>"
	;

	?>

