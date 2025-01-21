<nav class="ts-sidebar"> <!--STUDENT SIDEBAR-->
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">Menu</li>
				<?PHP if(isset($_SESSION['id']))
				{ ?>
					<li><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
					<li><a href="my-profile.php"><i class="fa fa-user"></i>Profile</a></li>
					<li><a href="JCD/index.php"><i class="fa fa-file-o"></i>Food Menu</a></li>
					<li><a href="dining.php"><i class="fa fa-file-o"></i>Dining</a></li>
				<?php } else { ?>
				
				<li><a href="index.php"><i class="fa fa-users"></i>Login as Student</a></li>
				<li><a href="admin"><i class="fa fa-user"></i>Login as Admin</a></li>
				<?php } ?>

			</ul>
		</nav>