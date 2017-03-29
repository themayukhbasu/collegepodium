<!-- ------------Navbar content-----------------------------
		---- This is the wrapper for navbar. When making a
		---- new page, do NOT modify the content inside
		---- The styles for this are inside this page (in style tags)
		---- The JS for toggling (and searching) is in header.js
		---  ----------------------------------------------------/!-->
		<div class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="row">
				<div class="col-sm-3 col-md-3" id="col-draw">		
					<div class="drawer">
						<button type="button" class="btn btn-default btn-lg" id="drawer">
						 <span id="btn-draw" class="glyphicon glyphicon glyphicon-align-justify" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<div class="col-sm-6 col-md-6" id="col-draw">
					<a id="head-link"href="index.php">college podium</a>
				</div>
				<div class="col-sm-3 col-md-3">
					<form class="navbar-form" role="search">			
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>

				</div>	
			</div>
		</div>
		
		<!-- ------------Content and Sidebar wrapper------------------
		---- This is the wrapper for sidebar and page content.
		---- The styles for this are in sidebar.css
		---  ----------------------------------------------------/!-->
		<div id="wrapper" class="toggled">

		<!-- ------------Sidebar wrapper------------------
		---- This is the wrapper for navbar. When making a
		---- new page, do NOT modify the content inside
		---- The styles for this are in sidebar.css
		---- The JS for the buttons is in common.js
		---- Add the class "thispage" to the <a> which the page represents
		---  ----------------------------------------------------/!-->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
				<li>
                    <a href="index.php">home</a>
                </li>
                <li>
                    <a href="upload_notes.php">upload notes</a>
                </li>
                <li>
                    <a href="static_upload.php?type=notice">post a notice</a>
                </li>
                <li>
                    <a href="static_upload.php?type=query">post a query</a>
                </li>
                <li>
                    <a href="static_upload.php?type=discuss">start a discussion</a>
                </li>
				<hr class="divider" />
                
				<li>
                    <a href="#">college</a>
                </li>
                <li>
                    <a href="#">university</a>
                </li>
                <li>
                    <a href="#">department</a>
                </li>
                <li>
                    <a href="index.php">all posts</a>
                </li>
				
				<hr class="divider" />
				
				<li>
                    <a href="notes.php">all notes</a>
                </li>
				
				<hr class="divider" />
				
				<li>
                    <a href="#" id="logout">logout</a>
                </li>
				<hr class="divider" />
				<li>
				<input type="hidden" value="<?php echo($_SESSION['csrftoken']); ?>" id="sidebar-token">
				<p class="footnote">Copyright © 2015 College Podium. All rights reserved.</p>
				</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		

        <!-- #page-content-wrapper 
		---- ENTER YOUR CONTENT HERE
		-------------------------/!-->

		</div>