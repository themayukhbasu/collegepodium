 <!DOCTYPE HTML>

<html>
<head>
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >

    <script src="/mvp/js/pace.min.js"></script>
    <script src="/mvp/js/jquery.js"></script>
    <script src="/mvp/js/offline.min.js"></script>
    <script type="/mvp/js/ohsnap.min.js"></script>
    <script>
            $('#default').on('click', function() { ohSnap('Yep it is true :)')});
    </script>
    <meta name="description" content="College Podium is an online platform intended to help college students share and collaborate">
    <link rel="stylesheet" href="/mvp/Style/pace.css">
    <link rel="stylesheet" href="/mvp/Style/offline.css">
    <link rel="stylesheet" href="/mvp/Style/common.css">
    <link rel="stylesheet" href="/mvp/Style/animations.css">
    <title>College Podium</title>
    <style>
        .intro{
            color: #015657 ;
            font-family: trench;
        }
        h1{
            font-size: 40px;
        }
        p{
            font-size: 25px;
            font-weight: bold;
        }

        /* ALERTS */
/* inspired by Twitter Bootstrap */

.alert {
 padding: 15px;
 margin-bottom: 20px;
 border: 1px solid #eed3d7 ;
 border-radius: 4px;
 position: absolute;
 bottom: 0px;
 right: 21px;
 /* Each alert has its own width */
 float: right;
 clear: right;
 background-color: white;
}

.alert-red {
 color: white;
 background-color: #DA4453 ;
}
.alert-green {
 color: white;
 background-color: #37BC9B ;
}
.alert-blue {
 color: white;
 background-color: #4A89DC ;
}
.alert-yellow {
 color: white;
 background-color: #F6BB42 ;
}
.alert-orange {
 color:white;
 background-color: #E9573F ;
}
    </style>
</head>

<body>
    <div id="ohsnap"></div>
    <center><h1 class="intro ">college podium</h1></center>
    <br/>
    <center><img class="hatch" alt="College Podium Logo Picture" src="mvp/assets/cp.png"></center>
    <br/>    

    
    <center><p id="default" class="intro pulse">College Podium will be here very soon ...</p></center>

    <br/><br/>
	
	<br/><br/>
	<br/><br/>
	<br/><br/>
	
	<form role="form" action="elink.php" method="POST">
    <center>   <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email!" value="">
        </div></center>
  <center><div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
        </div></center>
  </form>

    
    <!--
    <div id="wrapper">
        <h1>A Brief Description About College Podium - What it is? What it does? and How it does it?</h1>
        <p>
            College Podium is an online platform intended to help college students share and collaborate. College Podium gives students the freedom to share their knowledge in a proper structured 
        </p>
    </div>
    -->
</body>

</html>