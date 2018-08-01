<?php 

	session_start(); // have access to session vars, such as logged in status
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>NYCDA Blog Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <!--without this, page will not work - thank you Noble Desktop -->
	<!--<meta charset="utf-8">-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image" sizes="48x48">	
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="main.css">
<style>
	.courses {
		width: 150px;
		height: 40px;
		padding: 11px 20px;
		border: 1px solid #ffcb04;
		colof: #ffcb04;
		align-self: center;
		text-transform: uppercase;
		font-size: .7rem;
		font-weight: 700;
		letter-spacing: 1px;
		transition: .25s ease-out;
	}
	#topbar .courses:hover {
		background: #ffcb04;;
		color: #1a1919;
	}
</style>
	
	</head>

<body>
	<!--fixed element at bottom-right corner of viewport-->
	
	<a href="">
		<div id="chatcircle">
		  <div id="chatbox">
			<div id="smile"></div>
		  </div>
	  </div>
	</a> 
	
	<div id="topbar">
		<div id="logo-container">
			<a href=""><img class="logo" src="images/nycda-header-logo.png" alt="" height="44" width="113"></a>
			<div>
				<span class="partone">Your Campus: &nbsp; </span><span class="parttwo">New York City</span>
				<div id="change">Click to Change</div>
			</div>
		</div>
		
		<!-- Not using anchors in nav - will be adding drop-downs, so anchors inappropriate - anchor for blog page(i.e. this) and login stays -->			
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
			<li><a href="index.php">Blog</a></li>
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a id='login' href='logout.php'>Student Logout</a>";} else 
			{ echo "<a id='login' href='login.php' >Student Login</a>";}?></li>
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
			<li><?php if ($_SESSION["loggedIn"]) { echo "<a href='logout.php' class='gold'>Student Logout</a>";} else 
			{ echo "<a href='login.php' class='gold'>Student Login</a>";}?></li>
		
		</ul>
	</div>
	
	<header>
		<div id="headercontent">
			<div id="search-container">
				<input type="text" placeholder="Search the blog">
				<button><i class="fa fa-search"></i></button>
			</div>
			<div id="featured">
				<p>nycda blog featured post</p>
				<h2><a href="">From Doctor tO Developer: Alumni Spotlight on Logan Baker</a></h2>
				<h6>Written by on March 23, 2018</h6>
				<p>This interview was conducted by Erica Freedman, Content Marketing and Client Services Specialist at SwitchUp. After evaluating the costs of Veterinary school, Logan Baker dec...<a href="">Read More</a><i class="fa fa-caret-right"></i></p> 
			</div> <!-- featured -->
		</div> <!-- headercontent -->
	</header>
	<main>
		<section id="blogcontainer">
			<div>
				<div class="blog-card-header one" ></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">February 23, 2018</h6>
						<h6 class="author">by clayton wert</h6>
					</div>
					<h3><a href="">10 Networking Tips to Earn a Paid Position Post-Bootcamp</a></h3>
					<p>It’s no secret that graduating from any coding bootcamp is a challenge. It will be one of the hardest things that someone can do in their life....</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
		
			<div>
				<div class="blog-card-header two"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">February 14, 2018</h6>
						<h6 class="author">by manny perez</h6>
					</div>
					<h3><a href="">Setting Yourself Apart</a></h3>
					<p>One of the most common concerns I hear from students as they near the end of an Intensive Course at NYCDA is the fact they are jumping into a compl...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			
			<div>
				<div class="blog-card-header three"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">January 26, 2018</h6>
						<h6 class="author">by krystal kaplan</h6>
					</div>
					<h3><a href="">You graduated! Now what? 9 things for bootcamp grads to do, like, yesterday!</a></h3>
					<p>Throughout my experiences as a recruiter, teacher, career readiness program manager and success coach, I’ve seen graduates become overwhelmed post-...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header four"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">January 27, 2018</h6>
						<h6 class="author">by sam lubin</h6>
					</div>
					<h3><a href="">Who are you? Don't Lost Yourself at a Coding Bootcamp: Part Two</a></h3>
					<p>Continued from last week's blog post. It can be very difficult to see ourselves objectively. I’d wager that most, if not all people have a degre...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header five"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">January 10, 2018</h6>
						<h6 class="author">by samlubin</h6>
					</div>
					<h3><a href="">Who are you? Don't Lost Yourself at a Coding Bootcamp: PART TWO</a> </h3>
					<p>I’m a graduate of the New York Code + Design Academy (NYCDA) Web Development Intensive program and I have been employed here ever since. I have be...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header six"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">December 20, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">Announcing the NYCDA Scholarship in Salt Lake City</a></h3>
					<p>We've always been committed to supporting growing tech communities, and Salt Lake City is no exception. That's why we're offering two FULL schol...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header seven"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">December 15, 2017</h6>
						<h6 class="author">by manny perez</h6>
					</div>
					<h3><a href="">A Better Version of You</a></h3>
					<p>Over the last five years in the DC startup scene, I’ve been fortunate enough to work with some great teams that build great products, and for that ...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header eight"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">December 08, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">Announcing NYCDA's Web Development Fellowship Program</a></h3>
					<p>The New York Code + Design Academy and New York City’s Tech Talent Pipeline team up to offer FREE web development training to eligible New Yorkers....</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header nine"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">December 07, 2017</h6>
						<h6 class="author">by nicole arndt</h6>
					</div>
					<h3><a href="">How to Embrace the Fear of Risk to Achieve Your Goals</a></h3>
					<p>"Often the difference between a successful person and a failure is not that one has better abilities or ideas, but the courage that one has to bet ...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header ten"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">November 30, 2017</h6>
						<h6 class="author">by clayton wert</h6>
					</div>
					<h3><a href="">10,000 Hour Myth: Effectively Learn Any Skill (Like Coding) Quickly</a></h3>
					<p>If you’ve taken the time to learn any new skill, whether that’s playing chess, performing standup comedy, or learning the guitar, you’ve most likel...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header eleven"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">November 28, 2017</h6>
						<h6 class="author">by krystal kaplan</h6>
					</div>
					<h3><a href="">Self-Care for Techies</a></h3>
					<p>Self-care is a topic near and dear to my heart. I read books on how to tidy my sock drawer, preach about mental health care, buy veggies and fruit ...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twelve"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">November 22, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">Keeping Up With the Curriculum</a></h3>
					<p>Get the scoop on our new Software Engineering Intensive program and the process behind building it The tech industry is ever-evolving. So how do yo...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header thirteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">October 11, 2017</h6>
						<h6 class="author">by clayton wert</h6>
					</div>
					<h3><a href="">How to Be a Successful Bootcamp Grad</a></h3>
					<p>Chances are that if you’re reading this, you’re interested in joining a coding bootcamp. You may have already committed yourself to 12-weeks of in...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header fourteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">September 21, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">90s Night at LSC</a></h3>
					<p>We're celebrating #throwbackthursday with 90s Night at Liberty Science Center! Just seeing that pattern brings on feelings of nostalgia: winning s...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header fifteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">August 23, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">Scholarship Contest for Web Development 100 at Liberty Science Center</a></h3>
					<p>In celebration of our first class kicking off at Liberty Science Center, we're giving away a scholarship for Web Development 100! The course start...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header sixteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">August 15, 2017</h6>
						<h6 class="author">by mike miller</h6>
					</div>
					<h3><a href="">Announcing Income Share Agreements</a></h3>
					<p>Today is an exciting day here at NYCDA. It’s exciting because we get to announce our new financing option – the Income Share Agreement – for Philad...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header seventeen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 19, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">Turning Computers Into Brains: IBM's TrueNorth</a></h3>
					<p>To get computers to truly advance, innovation will come from an unlikely source of inspiration: the human brain. Replicating how efficiently th...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header eighteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 19, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">Modern Design Trend: 90s Throwback</a></h3>
					<p>Web design trends are fickle, but one thing will always be constant: nostalgia wins every time. The latest web design trend, brutalism, French ...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header nineteen"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 19, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">Introducing Summer Code Camp</a></h3>
					<p>Happy summer from NYCDA! If you're looking for a way to close out the rest of the season, but also want to develop some serious programming ski...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twenty"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 14, 2017</h6>
						<h6 class="author">by peter bolte</h6>
					</div>
					<h3><a href="">9 Classic Tech Commercials</a></h3>
					<p>Before things can be called retro throwbacks, they must have been original at one point. Here are some blasts from the past that showcase 9 of the ...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twenty-one"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 14, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">How Employers Feel About Bootcamp Graduates</a></h3>
					<p>Indeed has come out with a survey of tech recruiters and their hiring practices for bootcamp graduates. According to their survey of 1,000 peopl...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twenty-two"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 07, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">NYCDA Announces Partnership With Liberty Science Center</a></h3>
					<p>We’re excited to announce a partnership with Liberty Science Center in Jersey City, New Jersey! Starting August 2017, our signature Web Develop...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twenty-three"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 07, 2017</h6>
						<h6 class="author">by cory healy</h6>
					</div>
					<h3><a href="">Unicode: the Rosetta Stone of Tech</a></h3>
					<p>How do all languages, characters, and symbols of the world unite across our devices? Unicode! Unicode is like the Rosetta Stone of languages an...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
			<div>
				<div class="blog-card-header twenty-four"></div>
				<div class="blog-card-body">
					<div class="blog-date">
						<h6 class="date">July 05, 2017</h6>
						<h6 class="author">by peter bolte</h6>
					</div>
					<h3><a href="">It's a Mad, Mad, Mad, Mad World</a></h3>
					<p>Esolangs: Part II We promise, this is the last of esolangs! In one of our blogs a few weeks ago we introduced to you the concept of esoteric...</p>
					<a href="">Read More</a><i class="fa fa-caret-right"></i>
				</div>
			</div>
		</section>
	<div class="pagination">
		  <span class="uno">1</span>
		  <a href="#">2</a>
		  <a href="#">3</a>
		  <a href="#">4</a>
		  <a href="#">5</a>
		  <span class="ellip">...</span>
		  <a class="next" href="#">Next &rsaquo;</a>
		  <a class="last" href="#">Last &raquo;</a>
	</div>
	<footer>
		<div id="footer-content">
			<ul id="about-nycda">
				<li><a href="">About</a></li>
				<li><a href="">Team</a></li>
				<li><a href="">Corporate</a></li>
				<li><a href="">Careers</a></li>
				<li><a href="">Contact Us</a></li>
				<li><a href="">FAQ</a></li>
			</ul>
			<ul id="social">
				<li><a href=""><i class="fa faceb">&#xf09a;</i><span>Facebook</span></a></li>
				<li><a href=""><i class="fa bird">&#xf099;</i><span>Twitter</span></a></li>
				<li><a href=""><i class="fa insta">&#xf16d;</i><span>Instagram</span></a></li>
				<li><a href=""><i class="fa link">&#xf0e1;</i><span>Linkedin</span></a></li>
				<li><a href=""><i class="fa you">&#xf0da;</i><span>Youtube</span></a></li>
			</ul>
			<ul id="nycda-details">
				<p>The New York Code + Design Academy<br> 
				   90 John Street, Suite 404 <br>
				   New York, NY 10038 </p>
				<p><a href="">844-322-CODE (2633)</a> <br>
				   <a href="">info@nycda.com</a><br> 
				   © NYCDA 2018</p>
				<p><a href="">Privacy Policy</a> | <a href="">Terms of  Service</a></p>
			</ul>
			<div id="sign-up">
				<p>Sign up for our mailing list.</p>
				<input type="email" name="EMAIL" id="EMAIL" placeholder="Email Address" required="required">
				<button><a href="">Submit</a></button>
			</div>
		</div>
		
		<div id="footer-logo">
			<img src="images/triangle-logo.png" alt="" width="100px">
		</div>
	</footer>
</main>
<script>
		 let elburger = document.getElementById('burger');
		 let eloverlay = document.getElementById('overlay');
		 		 
		 elburger.addEventListener('click', function() {
			this.classList.toggle("change"); 
			eloverlay.classList.toggle("show");
			
		});
	</script> 
</body>
</html>