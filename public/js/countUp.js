<!DOCTYPE html>
<html lang="en-US">
<!--
=====================================================================================
 Site created to keep track of a bogus golf league in upstate NY
 Create by Chris Makenzie
=====================================================================================
-->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    
    <!-- Title -->
	<title>The Wilton Tour</title>
    
    <!-- Favicon -->
    <link rel="shortcut&#x20;icon" href="images/favicon.png" type="image/png" />
    <link rel="icon" href="images/favicon.png" type="image/png" />
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png" type="image/png" />
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png" type="image/png" />
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png" type="image/png" />
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png" type="image/png" />
    
    <!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 
    
    <meta name='robots' content='noindex,follow' />

	<!-- Stylesheets -->
    <link rel='stylesheet' id='wt-css'  href='style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wt-grid' href='grid.css' type='text/css' media='all' />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

	<!-- Javascripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="js/SmoothScroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="js/countUp.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
</head>

<body>  
<script>
	function statusChangeCallback(response) {
    	console.log('statusChangeCallback');
    	console.log(response);
    	if (response.status === 'connected') {
      		// Logged into your app and Facebook.
      		document.getElementById('login').innerHTML = '<a href="#" id="logout-link">Log Out</a>';
    	} else if (response.status === 'not_authorized') {
      		// The person is logged into Facebook, but not your app.
      		document.getElementById('login').innerHTML = '<a href="#" id="login-link">Log In</a>';
    	} else {
      		// The person is not logged into Facebook, so we're not sure if
      		// they are logged into this app or not.
      		document.getElementById('login').innerHTML = '<a href="#" id="login-link">Log In</a>';
    	}
  	}
  
  	function checkLoginState() {
    	FB.getLoginStatus(function(response) {
      		statusChangeCallback(response);
    	});
  	}

  	window.fbAsyncInit = function() {
  		FB.init({
    		appId      : '565988296850156',
    		cookie     : true,  // enable cookies to allow the server to access 
                        		// the session
    		xfbml      : true,  // parse social plugins on this page
    		version    : 'v2.0' // use version 2.0
  		});

  		FB.getLoginStatus(function(response) {
    		statusChangeCallback(response);
  		});

  	};

  	// Load the SDK asynchronously
  	(function(d, s, id) {
    	var js, fjs = d.getElementsByTagName(s)[0];
    	if (d.getElementById(id)) return;
    		js = d.createElement(s); js.id = id;
    		js.src = "//connect.facebook.net/en_US/sdk.js";
    		fjs.parentNode.insertBefore(js, fjs);
  	}(document, 'script', 'facebook-jssdk'));

  	$('body').on('click','#login-link', function(e){
		FB.login(function(response) {
			if (response.authResponse) {
				document.location.reload();
			}
		}, {scope: 'email'});
		e.preventDefault();
 	});
	
  	$('body').on('click','#logout-link', function(e){
		e.preventDefault();
    	FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    	});
 	});
</script>
  
	<header id="header-section" class="header header-hide">
    	<div class="grid-container">
        	<div class="grid-30 tablet-grid-80 mobile-grid-80">
            	<div class="logo">
                	<a href="http://www.thewiltontour.com" title="The Wilton Tour" rel="home">
                    	<img src="images/logo.png" alt="The Wilton Tour">
                    </a>
                </div>
            </div>
            <nav id="navigation" class="grid-70 hide-on-tablet hide-on-mobile">
            	<ul id="main-menu" class="menu">
                	<li class="home-link menu-item">
                    	<a href="#hero" class="">Home</a>
                    </li>
                    <li class="menu-item">
                    	<a href="#section-standings" class="">Standings</a>
                    </li>
                    <li class="menu-item">
                    	<a href="#section-matches" class="">Matches</a>
                    </li>
                    <li class="menu-item">
                    	<a href="#section-achievements" class="">Achievements</a>
                   	</li>
                    <li class="menu-item">
                    	<a href="#section-golfers" class="">Golfers</a>
                    </li>
                    <li class="menu-item">
                    	<a href="#section-courses" class="">Courses</a>
                    </li> 
                    <li class="menu-item">
                    	<a href="#section-rules" class="">Rules</a>
                    </li>
                    <li class="menu-item" id="login">
                    	<a href="#" id="logout-link">Log Out</a>
                    </li>
                </ul> 
            </nav>
        </div>
    </header>		
		
	
	<section id="hero" data-type="background" data-speed="10">
    	<div class="overlay">
        	<div class="grid-container">
            	<div class="hero-holder grid-100 mobile-grid-100 tablet-grid-100" style="opacity:1;">
                    <article>
                    	<div class="hdh"><span>Bad Golf with Stupid Achievements</span></div>
                        <h1>Super Driver<span> Invitational</span></h1>
                        <div class="hdb"><a id="to-standings" href="#section-standings">Standings</a></div>
                    </article>
                </div>
            </div>
        </div>
	</section>
	
    <div id="main-content">
    <a id="to-main-content"></a>
    
    	<section id="standings">
        	<a class="wt-offset-anchor" id="section-standings"></a>
        	<div class="grid-container">
            	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                	<header class="section-header">
                    	<h2 class="section-title">
                        	<span>THE STANDINGS</span>
                        </h2>
                        <p class="leader">
                        	<span>Super Driver Invitational</span> standings based on 2016 rules and achievements. It's not about who is better... but who sucks the least.
                        </p>
                    </header>
                </div>
            </div>
            
            <div class="grid-container section-content">
            	<div class="grid-100 mobile-grid-100 tablet-grid-100">
<div id="status">
</div>
                	<div class="standings-wrap">
					<div class="standings-box grid-33 tablet-grid-33 mobile-grid-100">
	                                    <div class="standings-holder">
	                                        <figure class="standings-photo">
	                                            <img src="images/players/ndim.jpg" alt="standings image" style="display:block;" />
	                                                <div class="score-total"><span>2 WP</span></div>
	                                                <figcaption class="standings-description">
	                                                    <h3 class="standings-name">Nik DiMambro</h3>
	                                                    <div class="standings-points">
	                                                        <span>Match: 1</span>
	                                                        <span>Achievement: 1</span>
	                                                    </div>
	                                                </figcaption>
	                                            </figure>
	                                        </div>
	                                    </div><div class="standings-box grid-33 tablet-grid-33 mobile-grid-100">
	                                    <div class="standings-holder">
	                                        <figure class="standings-photo">
	                                            <img src="images/players/cmak.jpg" alt="standings image" style="display:block;" />
	                                                <div class="score-total"><span>2 WP</span></div>
	                                                <figcaption class="standings-description">
	                                                    <h3 class="standings-name">Chris Makenzie</h3>
	                                                    <div class="standings-points">
	                                                        <span>Match: 2</span>
	                                                        <span>Achievement: 0</span>
	                                                    </div>
	                                                </figcaption>
	                                            </figure>
	                                        </div>
	                                    </div><div class="standings-box grid-33 tablet-grid-33 mobile-grid-100">
	                                    <div class="standings-holder">
	                                        <figure class="standings-photo">
	                                            <img src="images/players/tmcl.jpg" alt="standings image" style="display:block;" />
	                                                <div class="score-total"><span>0 WP</span></div>
	                                                <figcaption class="standings-description">
	                                                    <h3 class="standings-name">Terry McClellan</h3>
	                                                    <div class="standings-points">
	                                                        <span>Match: 0</span>
	                                                        <span>Achievement: 0</span>
	                                                    </div>
	                                                </figcaption>
	                                            </figure>
	                                        </div>
	                                    </div>                
                    </div>
                </div>
            </div>
            <div class="wt-scroll-up-waypoint" data-section="section-standings"></div>
        </section>
    
    <section id="golf1" data-type="background" data-speed="10" class="parallax">
    	<div class="overlay">
        	<div class="grid-container">
            	<div class="hero-holder grid-100 mobile-grid-100 tablet-grid-100" style="opacity:1;">
                    <article>
                        <h3>Last Outting</h3>
                        <p class="leader">Holy hell, <span>Chris Makenzie</span> managed to win the last game at <span>Saratoga Lake Golf Club</span> in Saratoga Springs. Here's what else went down.</p><div class="grid-100 tablet-grid-100 mobile-grid-100"><div class="facts-wrap"><div class="facts one-fourth"><span>3</span>Players played</div><div class="facts one-fourth"><span>4489</span>Yards Walked</div><div class="facts one-fourth"><span>166</span>Swings Taken</div><div class="facts one-fourth column-last"><span>3</span>Par or Better</div></div></div>                    </article>
                </div>
            </div>
        </div>
	</section>
    
    <section id="matches">
        	<a class="wt-offset-anchor" id="section-matches"></a>
        	<div class="grid-container">
            	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                	<header class="section-header">
                    	<h2 class="section-title">
                        	<span>THE MATCHES</span>
                        </h2>
                        <p class="leader">
                        	Not every match is <span>Super Driver Invitational</span> quality, but they're still here to prove we suck.
                        </p>
                    </header>
                </div>
            </div>
            
            <div class="grid-container section-content">
            	<div class="grid-100 mobile-grid-100 tablet-grid-100">
                	<div class="standings-wrap">
    				<div class="match grid-33 tablet-grid-33 mobile-grid-100">	
										<div class="match-holder">
											<div class="match-description">
												<h3>Saratoga Lake <span>4/27/16</span></h3><div class="grid-100 tablet-grid-100 mobile-grid-100 match-stats">
											<div class="one-fourth">
												<span>Tee</span>
												<img src="images/white-tee.png" />
											</div>
											<div class="one-fourth">
												<span>Par</span>
												36
											</div>
											<div class="one-fourth">
												<span>Yds</span>
												2841
											</div>
											<div class="one-fourth column-last">
												<span>Slp</span>
												
											</div>
										</div><div class="grid-100 tablet-grid-100 mobile-grid-100 match-scores"><div class="match-player first-place">
											<span>1</span>Chris Makenzie
											<div class="match-player-score">51</div>
										 </div><div class="match-player ">
											<span>2</span>Nik DiMambro
											<div class="match-player-score">56</div>
										 </div><div class="match-player ">
											<span>3</span>Terry McClellan
											<div class="match-player-score">59</div>
										 </div></div></div></div></div><div class="match grid-33 tablet-grid-33 mobile-grid-100">	
										<div class="match-holder">
											<div class="match-description">
												<h3>Brookhaven <span>4/19/16</span></h3><div class="grid-100 tablet-grid-100 mobile-grid-100 match-stats">
											<div class="one-fourth">
												<span>Tee</span>
												<img src="images/white-tee.png" />
											</div>
											<div class="one-fourth">
												<span>Par</span>
												36
											</div>
											<div class="one-fourth">
												<span>Yds</span>
												3258
											</div>
											<div class="one-fourth column-last">
												<span>Slp</span>
												123
											</div>
										</div><div class="grid-100 tablet-grid-100 mobile-grid-100 match-scores"><div class="match-player first-place">
											<span>1</span>Nik DiMambro
											<div class="match-player-score">57</div>
										 </div><div class="match-player ">
											<span>2</span>Chris Makenzie
											<div class="match-player-score">60</div>
										 </div><div class="match-player ">
											<span>3</span>Terry McClellan
											<div class="match-player-score">64</div>
										 </div></div></div></div></div>    				</div>
    			</div>
        	</div>
            <div class="wt-scroll-up-waypoint" data-section="section-matches"></div>
    	</section>
        
        <div class="breaker">
        	<div class="grid-container">
            	<div class="grid-100 tablet-grid-100 mobile-grid-100">
                	<div><span>Winning games is not the only way to score in </span> Super Driver Invitational.</div>
                </div>
            </div>
        </div>        
        
    	<section id="achievements">
        	<a class="wt-offset-anchor" id="section-achievements"></a>
        	<div class="grid-container">
            	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                	<header class="section-header">
                    	<h2 class="section-title">
                        	<span>THE ACHIEVEMENTS</span>
                        </h2>
                        <p class="leader">
                        	When the game of golf is not enough... add achievements!
                        </p>
                    </header>
                </div>
            </div>
            
            <div class="grid-container section-content">
            	<div class="grid-100 mobile-grid-100 tablet-grid-100">
                	<div class="standings-wrap">
                    	<div class="achievement-holder one-half ">
											<img src="images/achievements/record-books.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>That's one for the record books!</h4>
												<span>Sinking a hole in one. If you manage this you've earned yourself a season win.</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/all-your-ducks.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>All your ducks in a row</h4>
												<span>Obtaining a par or better on a par 3, par 4 and par 5 hole in the same month.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/in-the-hole.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>It's in the hole!</h4>
												<span>Sink a chip-in from off the green while yelling something like "GET IN THE HOLE" (you can not use a putter).</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/rockin-robin.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Rockin Robin, tweet tweet</h4>
												<span>Get a birdie or better.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/rockin-robin-2.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Did the robin tweet again?</h4>
												<span>Get a second birdie in the same month.</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/rack-em-up.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Rack em up, knock em down</h4>
												<span>Get back to back pars or better.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/no-man-has-gone.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Where no man has gone before</h4>
												<span>Get a bogey or better after taking a penalty stroke (not from water hazard).</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/dont-need-mulligan.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>I don't need no stinkin mulligan</h4>
												<span>Get a score of 45 or lower without using your mulligan.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/super-driver.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>I just got an SDI</h4>
												<span>Par the hole while teeing off with the super driver.</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/balls-touching.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Our balls are touching...</h4>
												<span>Hit another person's ball on the green from hitting off the green yourself.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/rage-quit.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Rage Quit</h4>
												<span>Get a fellow golfer to quit in the middle of a round.</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/woodie.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>I got a woodie</h4>
												<span>Make par or better after hitting a tree.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/dirty-balls.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Dirty balls</h4>
												<span>Make par after hitting out of a bunker</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/splash.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>How did my ball get wet?</h4>
												<span>Hit a ball in a water hazard and get a bogey or better. The ball does not need to be lost, skipping over water counts.</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/stroke-it.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>This is How You Stroke It</h4>
												<span>After scoring higher than a double bogey, score par or lower on the next hole.</span>
											</div>
										</div><div class="achievement-holder one-half column-last">
											<img src="images/achievements/stroke-it.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>Straight as an Arrow</h4>
												<span>Hit a ball off the tee and have it end up within two club lengths away from a "closest to line" line</span>
											</div>
										</div><div class="achievement-holder one-half ">
											<img src="images/achievements/in-the-hole.jpg" alt="achievement icon" />
											<div class="achievement-description">
												<h4>The Lance Armstrong</h4>
												<span>Play 18 consecutive holes with the same ball. Two of those holes must have water obstacles.</span>
											</div>
										</div>                    </div>
                </div>
            </div>
            <div class="wt-scroll-up-waypoint" data-section="section-achievements"></div>
       	</section>
        
        
        <section id="golfers" data-type="background" data-speed="10" class="parallax">
        	<a class="wt-offset-anchor" id="section-golfers"></a>
    		<div class="overlay">
        		<div class="grid-container">
            		<div class="hero-holder grid-100 mobile-grid-100 tablet-grid-100" style="opacity:1;">
                    	<article>
                        	<h3>The Golfers</h3>
                        	<p class="leader">Get to know all the baddies playing in or with <span>Super Driver Invitational.</span></p>

                        <div class="grid-100 tablet-grid-100 mobile-grid-100">
                          <div class="players-wrap">
                            <div class="standings-wrap"><div class="golfer-box grid-25 tablet-grid-25 mobile-grid-50">
                                                    <div class="golfer-holder">
                                                        <figure class="golfer-photo">
                                                            <img src="images/players/tmcl.jpg" alt="golfer image" />
                                                            <figcaption class="golfer-description">
                                                                <h4>Terry McClellan</h4>
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                                </div><div class="golfer-box grid-25 tablet-grid-25 mobile-grid-50">
                                                    <div class="golfer-holder">
                                                        <figure class="golfer-photo">
                                                            <img src="images/players/cmak.jpg" alt="golfer image" />
                                                            <figcaption class="golfer-description">
                                                                <h4>Chris Makenzie</h4>
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                                </div><div class="golfer-box grid-25 tablet-grid-25 mobile-grid-50">
                                                    <div class="golfer-holder">
                                                        <figure class="golfer-photo">
                                                            <img src="images/players/ndim.jpg" alt="golfer image" />
                                                            <figcaption class="golfer-description">
                                                                <h4>Nik DiMambro</h4>
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                                </div></div>                          </div>
                        </div>
                   		</article>
              		</div>
          		</div>
       		</div>
            <div class="wt-scroll-up-waypoint" data-section="section-golfers"></div>
    	</section>
            
    <section id="courses">
        	<a class="wt-offset-anchor" id="section-courses"></a>
        	<div class="grid-container">
            	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                	<header class="section-header">
                    	<h2 class="section-title">
                        	<span>THE COURSES</span>
                        </h2>
                        <p class="leader">
                        	These cheap courses are where the pros of <span>Super Driver Invitational</span> play.
                        </p>
                    </header>
                </div>
            </div>
            
            <div class="grid-container section-content">
            	<div class="grid-100 mobile-grid-100 tablet-grid-100">
                	<div class="standings-wrap">
                    
                   		<div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="images/courses/banners/BrookhavenGC.jpg" alt="course image" />
														<figcaption class="course-description">
															<h4>Porter Corners, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Saratoga Springs, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="images/courses/banners/PioneerHillsGC.jpg" alt="course image" />
														<figcaption class="course-description">
															<h4>Ballston Spa, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Clifton Park, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="images/courses/banners/QueensburyCC.jpg" alt="course image" />
														<figcaption class="course-description">
															<h4>Lake George, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Galway, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Saratoga Springs, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="images/courses/banners/BattenkillCC.jpg" alt="course image" />
														<figcaption class="course-description">
															<h4>Greenwich, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Hudson Falls, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Clifton Park, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="images/courses/banners/BendoftheriverGC.jpg" alt="course image" />
														<figcaption class="course-description">
															<h4>Hadley, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Queensbury, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Hartford, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Warrensburg, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Mechanicville, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Mechanicville, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div><div class="course-box grid-50 tablet-grid-50 mobile-grid-100">
												<div class="course-holder">
													<figure class="course-photo">
														<img src="" alt="course image" />
														<figcaption class="course-description">
															<h4>Greenwich, NY</h4>
														</figcaption>
													</figure>
												</div>
											</div>                    
                    </div>
                </div>
            </div>
            <div class="wt-scroll-up-waypoint" data-section="section-courses"></div>
      	</section>
        
        
        <div class="breaker">
        	<div class="grid-container">
            	<div class="grid-100 tablet-grid-100 mobile-grid-100">
						<span>Most Played Course: </span>Brookhaven Golf Course                </div>
            </div>
        </div>
        
        <section id="rules">
        	<a class="wt-offset-anchor" id="section-rules"></a>
        	<div class="grid-container">
            	<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                	<header class="section-header">
                    	<h2 class="section-title">
                        	<span>THE RULES</span>
                        </h2>
                        <p class="leader">
                        	When you don't like the rules, make your own.
                        </p>
                    </header>
                </div>
            </div>
            
            <div class="grid-container section-content">
            	<div class="grid-100 mobile-grid-100 tablet-grid-100">
                	<div class="standings-wrap">
                    	<div class="rule grid-70 prefix-15 tablet-grid-70 mobile-grid-100">
                            <h4><span>1-1</span>General</h4>
                            <p>The Game of Golf consists of playing a ball with a club from the teein ground... ah hell, just go read the USGA rulebook. All rules are the same unless otherwise noted below.</p>
                        </div>
                    	<div class="rule grid-70 prefix-15 tablet-grid-70 mobile-grid-100">
                            <h4><span>2-1</span>No Stroke and Distance; Ball Out of Bounds</h4>
                            <p>If some wind manages to take your ball out of bounds, drop a ball as nearly as possible at the spot from which the ball went out of bounds.</p>
                            <p>You may also choose, at your discretion, to play a provisional at the spot from which the original ball was played with no stroke penalty.</p>
                        </div>
                    	<div class="rule grid-70 prefix-15 tablet-grid-70 mobile-grid-100">
                            <h4><span>2-2</span>No One is Perfect; Mulligans for Everyone</h4>
                            <p>For every nine holes of golf played, each player is permitted one mulligan. Said mulligan does not carry over if playing more than nine holes... use it or lose it.</p>
                        </div>
                    	<div class="rule grid-70 prefix-15 tablet-grid-70 mobile-grid-100">
                            <h4><span>3-1</span>Super Driver Penalty</h4>
                            <p>If a player outright wins a hole, he or she must use the Super Driver to tee off of the next hole. Failure to do so will result in verbal abuse and a forced re-hit.</p>
                        </div>
                    	<div class="rule grid-70 prefix-15 tablet-grid-70 mobile-grid-100">
                            <h4><span>4-1</span>Stupid USGA Rules Eliminated</h4>
                            <p>Any USGA rule that prohibits fun or wastes time will not be followed in Super Driver Invitational. Ex: Playing out of turn... if you're ready, hit the damn ball</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wt-scroll-up-waypoint" data-section="section-rules"></div>
       	</section>
    </div>
    
		</body>
</html>