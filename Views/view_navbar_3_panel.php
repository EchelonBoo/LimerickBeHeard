<?php

 $pageTitle =   $data['pageTitle'];  
 $pageHeading = $data['pageHeading'];
 $menuNav   =   $data['menuNav'];    
 $stringLHS =   $data['stringLHS'];  
 $stringMID =    $data['stringMID']; 
 $stringRHS =    $data['stringRHS']; 
 $panelHeadLHS=$data['panelHeadLHS'];
 $panelHeadMID=$data['panelHeadMID'];
 $panelHeadRHS=$data['panelHeadRHS'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pageTitle;?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>


<style type="text/css">
    body{
        padding-top: 70px;
        background-color: lightblue;
    }
</style>
</head>

<body>

<section>

<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><?php echo $pageHeading?></a>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
		<?php //foreach($menuNav as $menuItem){echo "<li>$menuItem</li>";} //populate the navbar menu items?>
                  <?php echo $menuNav; ?>
            </ul>
        </div>
    </div>
</nav>



<div class="container" >


<div class="row">

    <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $panelHeadLHS; ?></div>
              <div class="panel-body">
                    <?php echo $stringLHS; ?>
              </div>
            </div>
    </div>

    <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $panelHeadMID; ?></div>
              <div class="panel-body">
                    <?php echo $stringMID; ?>
              </div>
            </div>
    </div>

    <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $panelHeadRHS; ?></div>
              <div class="panel-body">
                    <?php echo $stringRHS; ?>
              </div>
            </div>
    </div>
</div>



</div>  


</section>
