<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medha Sampoorna Siksha Admin-Panel</title>

<base href="<?PHP echo base_url();?>" >

    <link href="resources/pagenotfound/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="resources/pagenotfound/css/bootstrap-theme.css" rel="stylesheet">


<link href="resources/admin-resources/css/bootstrap.min.css" rel="stylesheet">
<link href="resources/admin-resources/css/datepicker3.css" rel="stylesheet">
<link href="resources/admin-resources/css/styles.css" rel="stylesheet">
<link  rel="shortcut icon" type="image/x-icon" href="resources/favicon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--Icons-->
<script src="resources/admin-resources/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Medha</span> Charitable Trust</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						<!--	<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>-->
							<li><a href="<?PHP echo base_url('admin/change-password')?>"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Change Password</a></li>
							<li><a href="<?PHP echo base_url('admin-logout'); ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<!--<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>-->
		
        <?PHP
			
			$pge = $this->uri->segment(2);

			
		?>
        
		<ul class="nav menu">

            <li  class="admin-logo"><img src="resources/admin-resources/images/medha-samp.png"> </li>
           
           <!-- <li class="active dashboard"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>-->
			<li class="<?PHP if($pge=='view-all-applications' || $pge=='change-password') echo 'active'; ?>"><a href="<?PHP echo base_url('admin/view-all-applications')?>"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> View Applications</a></li>
			<li><a data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Verify Marks</a></li>

			<li class="<?PHP if($pge=='schoolwise-toppers') echo 'active'; ?>"><a href="<?PHP echo base_url('admin/schoolwise-toppers');?>" ><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg>Toppers By School Wise</a></li>


			<li ><a href="<?PHP echo base_url('admin-logout')?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Logout</a></li>
		</ul>
        
        
        
      
		
        
	</div><!--/.sidebar-->