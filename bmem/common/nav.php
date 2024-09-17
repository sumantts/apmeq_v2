<nav class="pcoded-navbar ">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div" id="nav_bar">
				
				<ul class="nav pcoded-inner-navbar " >
					<li class="nav-item <?php if($p == 'dashboard'){ ?> active <?php } ?>">
					    <a href="?p=dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li> 

					<!-- Super Admin Menu -->
					<?php if($_SESSION["user_type_code"] == 'super'){?>					
					<li class="nav-item pcoded-menu-caption" id="setup">
						<label>SETUP </label>
					</li>
					<li class="nav-item pcoded-hasmenu <?php if($p == 'user-details' || $p == 'facility' || $p == 'asset' || $p == 'department'){ ?> active pcoded-trigger <?php } ?>">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Manage</span></a>
						<ul class="pcoded-submenu">									
							<li <?php if($p == 'department'){ ?> class="active" <?php } ?>><a href="?p=department&gr=setup">Department</a></li>							
							<li <?php if($p == 'user-details'){ ?> class="active" <?php } ?>><a href="?p=user-details&gr=setup">Users</a></li>									
							<li <?php if($p == 'facility'){ ?> class="active" <?php } ?>><a href="?p=facility&gr=setup">Facility</a></li>							
							<li <?php if($p == 'asset'){ ?> class="active" <?php } ?>><a href="?p=asset&gr=setup">Asset</a></li>											
						</ul>
					</li>
					
					<li class="nav-item <?php if($p == 'asset-dashboard' || $p == 'asset-facility-details' || $p == 'asset-data'){ ?> active <?php } ?>">
						<a href="?p=asset-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Asset dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'ticket-dashboard'){ ?> active <?php } ?>">
						<a href="?p=ticket-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Ticket dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'pms-dashboard'){ ?> active <?php } ?>">
						<a href="?p=pms-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">PMS dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'calibration-dashboard'){ ?> active <?php } ?>">
						<a href="?p=calibration-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Calibration Dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'qa-dashboard'){ ?> active <?php } ?>">
						<a href="?p=qa-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">QA Dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'rber-condemned'){ ?> active <?php } ?>">
						<a href="?p=rber-condemned&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">RBER/Condemned</span></a>
					</li>
					<li class="nav-item <?php if($p == 'reallocated-asset-details'){ ?> active <?php } ?>">
						<a href="?p=reallocated-asset-details&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Reallocated Asset Details</span></a>
					</li>
					<li class="nav-item <?php if($p == 'call-log'){ ?> active <?php } ?>">
						<a href="?p=call-log&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Call Log</span></a>
					</li>
					<?php } ?> 
					<!-- //Super Admin Menu -->

					<!-- Hospital admin Menu -->
					<?php if($_SESSION["user_type_code"] == 'h_admin'){?>					
					<li class="nav-item pcoded-menu-caption" id="setup">
						<label>SETUP </label>
					</li>
					<li class="nav-item pcoded-hasmenu <?php if($p == 'department' || $p == 'asset'){ ?> active pcoded-trigger <?php } ?>">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Manage Department/Asset</span></a>
						<ul class="pcoded-submenu">							
							<li <?php if($p == 'department'){ ?> class="active" <?php } ?>><a href="?p=department&gr=setup">Department</a></li>							
							<li <?php if($p == 'asset'){ ?> class="active" <?php } ?>><a href="?p=asset&gr=setup">Asset</a></li>												
						</ul>
					</li>
					
					<li class="nav-item <?php if($p == 'asset-dashboard' || $p == 'asset-facility-details' || $p == 'asset-data'){ ?> active <?php } ?>">
						<a href="?p=asset-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Asset dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'ticket-dashboard'){ ?> active <?php } ?>">
						<a href="?p=ticket-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Ticket dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'pms-dashboard'){ ?> active <?php } ?>">
						<a href="?p=pms-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">PMS dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'calibration-dashboard'){ ?> active <?php } ?>">
						<a href="?p=calibration-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Calibration Dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'qa-dashboard'){ ?> active <?php } ?>">
						<a href="?p=qa-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">QA Dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'rber-condemned'){ ?> active <?php } ?>">
						<a href="?p=rber-condemned&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">RBER/Condemned</span></a>
					</li>
					<li class="nav-item <?php if($p == 'reallocated-asset-details'){ ?> active <?php } ?>">
						<a href="?p=reallocated-asset-details&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Reallocated Asset Details</span></a>
					</li>
					<li class="nav-item <?php if($p == 'call-log'){ ?> active <?php } ?>">
						<a href="?p=call-log&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Call Log</span></a>
					</li>
					<?php } ?> 
					<!-- //Hospital admin Menu -->

					<!-- Department/Doctor -->
					<?php if($_SESSION["user_type_code"] == 'dep_doc'){?>					
					<li class="nav-item pcoded-menu-caption" id="setup">
						<label>SETUP </label>
					</li>
					<li class="nav-item <?php if($p == 'ticket-dashboard'){ ?> active <?php } ?>">
						<a href="?p=ticket-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Ticket dashboard</span></a>
					</li>
					<li class="nav-item <?php if($p == 'call-log'){ ?> active <?php } ?>">
						<a href="?p=call-log&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Call Log</span></a>
					</li>
					<?php } ?> 
					<!-- //Department/Doctor -->

					<!-- Calibration service provider -->
					<?php if($_SESSION["user_type_code"] == 'cal_sp'){?>
					<li class="nav-item <?php if($p == 'calibration-dashboard'){ ?> active <?php } ?>">
						<a href="?p=calibration-dashboard&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Calibration Dashboard</span></a>
					</li>
					<?php } ?> 
					<!-- //Calibration service provider -->
					 

				</ul>				
				
			</div>
		</div>
	</nav>