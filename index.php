<?php
	require_once 'header.php';
?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                         <!-- This span is for filling posts (from JQuery AJAX method) -->
							<div id="post-wrap" class="col-md-8 col-md-offset-0">
							</div>

							<div class="col-md-4">
								<div class="right-sidebar">
									<div class="post_content_free">						
											<a href="index.php" class="right-sidebar-elements">
												<span class="glph glyphicon glyphicon-time" aria-hidden="true"></span>most recent
											</a><br/>					               
							                <a href="index.php?sort=vote" class="right-sidebar-elements">
							                	<span class="glph glyphicon glyphicon-heart" aria-hidden="true"></span>most voted
							                </a><br/>						       
											<hr class="divider-slim" />				
							                <a href="index.php" class="right-sidebar-elements">
							                	<span class="glph glyphicon glyphicon-triangle-right" aria-hidden="true"></span>all posts
							                </a><br/>					               
							                <a href="index.php?type=notice" class="right-sidebar-elements sidebar-notice">
							                	<span class="glph glph-notice glyphicon glyphicon-triangle-right" aria-hidden="true"></span>notice
							                </a><br/>						       
							                <a href="index.php?type=query" class="right-sidebar-elements sidebar-query">
							                	<span class="glph glph-query glyphicon glyphicon-triangle-right" aria-hidden="true"></span>query
							                </a><br/>						                
							                <a href="index.php?type=discuss" class="right-sidebar-elements sidebar-discussion">
							                	<span class="glph glph-discussion glyphicon glyphicon-triangle-right" aria-hidden="true"></span>discussions
							                </a><br/>	

									</div>
								</div>
                    		</div>
						 <!-- ========================================================== -->
						<input type="hidden" name="csrftoken" id="token" value='<?php echo($_SESSION['csrftoken']); ?>'/>
						<a href="#" class="scrollToTop ">
							<span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> top
						</a>
						
						<footer>© Copyright 2016 College Podium. All rights reserved.</footer>
                    </div>
                    
                    	
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

		</div>
			  

	 </div>	

</body>
</html>
