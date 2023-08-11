
<a href="admin_dashboard.php" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
		<ul class="side-menu">
			<li><a href="admin_dashboard.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li>
				<a href="usermanagement.php"><i class='bx bxs-user-circle icon' ></i> User Management </a>
			</li>
			<li>
				<a href="manageproduct.php"><i class='bx bxs-doughnut-chart icon' ></i> Product</a>
			</li>
			<li>
				<a href="sales.php"><i class='bx bxs-chart icon' ></i> Sales </a>
			</li>
			<li><a href="salesreport.php"><i class='bx bx-table icon' ></i> Report </a></li>
			<li class="divider"></li>
			<li><a href="profile.php"><i class='bx bxs-cog icon' ></i> Profile </a></li>
			<li><a href="logout.php"><i class='bx bxs-log-out-circle icon' ></i> Logout </a></li>
		</ul>

	</section>
	<!-- SIDEBAR -->
    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <div class="date">
                        <?php
                            echo date('d-m-y , l');
                        ?>
                    </div>
                </div>
            </form>
            <span class="divider"></span>
            <div class="profile">
            <img src="assets\images\user.png" alt="User">
                
                <ul class="profile-link">
                    <li><a href="profile.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    <li><a href="logout.php"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
                </ul>
            </div>
        </nav>
		
    