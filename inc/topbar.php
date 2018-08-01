<div id="topbar">
		<div id="logo-container">
			<a href=""><img class="logo" src="images/nycda-header-logo.png" alt="" height="44" width="113"></a>
			<div>
				<span class="partone">Your Campus: &nbsp; </span><span class="parttwo">New York City</span>
				<div id="change">Click to Change</div>
			</div>
		</div>
		<ul id="outer-ul">
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a href='add-drop-view.php' class='courses'>ADD/DROP</a>";} ?></li> 
			<li>Student Services<i class="fa fa-caret-down"></i>
				<ul class="menu">
					<li><a href="">What We Do</a></li>
					<li>What You'll Get</li>
					<li>Student Coaching</li>
					<li>Student Stories</li>
					<li>Financing</li>
					<li>Holidays</li>
				</ul>
			</li>
			<li>Courses<i class="fa fa-caret-down"></i>
				<ul class="menu">
					<li>Web Development Courses</li>
					<li>UX Design Courses</li>
					<li>Youth</li>
					<li>View All Courses</li>
				</ul>
			</li>
			<li>Locations<i class="fa fa-caret-down"></i>
				<ul class="menu">
					<li>New York City</li>
					<li>Philadelphia</li>
					<li>Washington, D.C.</li>
				</ul>
			</li>
			<li>Events<i class="fa fa-caret-down"></i>
				<ul class="menu">
					<li>In Person</li>
					<li>Webinars</li>
				</ul>
			</li>
			<li><a href="index.php">Blog</a></li> <!-- will go back to my blog page -->
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a id='login' href='logout.php'>Student Logout</a>";} else 
			{ echo "<a id='login' href='login.php' >Student Login</a>";}?></li>
			
	<!--		<li><a id="login" href="">Student Login</a></li>--> 
		</ul>
		<!-- when viewport goes to 2 blog cards per "row", display the burger - will add a drop down for this to replace the navbar -->
		<div id="burger"> 
		  <div class="bar1"></div>
		  <div class="bar2"></div>
		  <div class="bar3"></div>
		</div>
	</div> 

	<div id="overlay">
		<ul>
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a href='add-drop-view.php' class='gold'>Add/Drop</a>";} ?></li> 
			<li><a href="">Courses</a></li>
			<li><a href="">Locations</a></li>
			<li><a href="">Events</a></li>
			<li><a href="">Webinars</a></li>
			<li><a href="index.php">Blog</a></li>
			<li><a href="" class="gold">Request Info</a></li>
		<!--	<li><a href="" class="gold">Student Login</a></li> -->
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a href='logout.php' class='gold'>Student Logout</a>";} else 
			{ echo "<a href='login.php' class='gold'>Student Login</a>";}?></li>
		</ul>
	</div>
