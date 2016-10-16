<?php

class htmltemp {
    /**
     * (PHP 4, PHP 5)
     * @param string $email <p>
     * The email of the user to compare
     * </p>
     * @param string $uid <p>
     * The session id of the user
     * </p>
     * @return int <p>
     * If the user has not been logged in, the function returns <b>0</b>
     * else, it returns <b>1</b>
     * </p>
     * @link http://mangruf.com
     */
    function checkUser($user, $uid){
    if (!isset($_SESSION[$user]) || !isset($_SESSION[$uid])){
        return 0;
//        header('location: index.php');
    }
    return 1;
    }
    
    function dispError($out){
        
    if ($out != ''){
                    ?>
                    <div class="alert alert-danger" align="center">
                        <strong>Error:</strong> 
                        <?php
                        echo $out;
                        ?>
                    </div>
                    <?php
                    }
    }
        
    function dispSux($sux){
        
    if ($sux != ''){
                    ?>
                    <div class="alert alert-success" align="center">
                        <strong>Success:</strong> 
                        <?php
                        echo $sux;
                        ?>
                    </div>
                    <?php
                    }
    }
    
    function menu(){
        ?>
<ul id="menu" class="nav nav-pills right">
        <li><a href="modules.php">Home</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="#">Download</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="logout.php">Sign Out</a></li>
    </ul>

<!--<ul class="nav navbar-nav">
<li class="active"><a href="#">Home</a></li>
<li><a href="#">Archive</a></li>
<li><a href="#">About</a></li>
<li><a href="#">Contact</a></li>
</ul>-->
<?php
    }
    
    function customModal($msg, $tag){
        ?>
<div class="modal " id="custModal">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3><?php echo $tag; ?></h3>
  </div>
  <div class="modal-body">
    <div  id="modal">
        <?php
    echo $msg;
        ?>
    </div>
      
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
  </div>
</div>
<?php
    }
    
    function course(){
        ?>
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Select an action</h3>
  </div>
  <div class="modal-body">
    <div  id="modal">
        <a href="addcourse.php" class="btn" >Add Course</a>
        <a href="editcourse.php" class="btn" >Edit Course</a>
    </div>
      
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
  </div>
<?php
    }
    
    function login_mod($mangruf){
        if (isset($_POST['log'])){
    $email= mysql_real_escape_string($_POST['user']);
    $password = mysql_real_escape_string($_POST['pass']);
    
    if ($email == "" || $password == ""){
        $out = "All fields are required";
    }else{
$query = "SELECT * FROM users WHERE username = '".$email."' AND password = '".$password."' ";
$result = $mangruf->query($query) or die(mysql_error());
$row = $mangruf->rows($result);
if ($row == 0){
$out = "Username or Password Invalid";
}else{
    $ftch = $mangruf->fetch($result);
    extract($ftch);
    $_SESSION['user'] = $username;
    $_SESSION['uid'] = $userId;

        header('location: home.php');

}
    }
    if ($out != ''){
                    ?>
                    <div class="alert alert-danger" align="center">
                        <strong>Error:</strong> 
                        <?php
                        echo $out;
                        ?>
                    </div>
                    <?php
                    }
                    
}

    }


    function register(){
        ?>
<div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Register</h3>
  </div>
  <div class="modal-body">
    <div  id="modal">
        <form class="form-horizontal" method="post">
<fieldset>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for="user">Username</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">*</span>
      <input id="user" name="user" class="input-large" placeholder="username" required="" type="text">
    </div>
    
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for="pass">Password</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">*</span>
      <input id="pass" name="pass" class="input-large" placeholder="password" required="" type="password">
    </div>
    <p class="help-block">password should be at least 6 characters</p>
  </div>
</div>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for="conf">Verify Password</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">*</span>
      <input id="pass" name="conf" class="input-large" placeholder="Verify password" required="" type="password">
    </div>
  </div>
</div>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">*</span>
      <input id="email" name="email" class="input-large" placeholder="email" required="" type="text">
    </div>
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="reg"></label>
  <div class="controls">
      <button id="reg" name="reg" type="submit" class="btn btn-inverse">Register</button>
  </div>
</div>

</fieldset>
</form>

</div>
      
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
  </div>
<?php
    }
    
    function header(){
        ?>
<div>
        <div class="carousel slide wet-asphalt">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(images/slider/e1.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content centered">
                                    <h2 class="animation animated-item-1">WAEC</h2>
                                    <p class="animation animated-item-2">The West African Examinations Council (WAEC).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                <div class="item" style="background-image: url(images/slider/e2.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content center centered">
                                    <h2 class="boxed animation animated-item-1">NECO</h2>
                                    <p class="boxed animation animated-item-2">The National Examination Council (NECO).</p>
                                    <br>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                <div class="item" style="background-image: url(images/slider/e3.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content centered">
                                    <h2 class="animation animated-item-1">UTME</h2>
                                    <p class="animation animated-item-2">UNIFIED TERTIARY MARTICULATION EXAMINATION</p>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="centered">
                                    <div class="embed-container">
                                        <iframe src="//player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="icon-angle-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
        </div>
<?php
    }
            
    function footer(){
        ?>
<div class="footer-text">
	<div class="copy">
        <p>&copy; 2015 All rights Reserved | Design by <a href="#">ZENIL GROUP</a></p>
	</div>
	<div class="subcribe">
         <input type="text" class="textbox" value="Enter Your text " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your text';}">
         <input type="submit" value="Search Go!" >
    </div>
    <div class="clear"></div>
		</div>
<?php
    }
            function cat($mangruf){
        ?>
<ul class="nav nav-list">
    <li class="nav-header"><img src="img/hot.gif" /></li>
        <li class="active">
                <a href="#">Categories</a>
        </li>
        <?php
        $sql = "SELECT * FROM category";
	$run = $mangruf->query($sql);
	$row = $mangruf->rows($run);
	$ct = 0;
	while ($ct < $row){
		$ftch = $mangruf->fetch($run);
		extract($ftch);
        ?>  

        <li>
                <a id="cat" href="index.php?cat=<?php echo $name; ?>"><?php echo $name; ?></a>
        </li>                        
<?php
$ct++;
        }
?>

</ul>
<?php
    }
    
    function ads(){
        ?>

<?php
    }
    
     function foto($photo){
        ?>
<img src="<?php
          $default = "img/default.png";
    if ($photo == ''){
        echo $default;
    }
          echo $photo; ?>" width="100px" height="90px" />
<?php
    }
    
    function isSingular($val){
        if ($val > 1){
            return 's have';
        }  else {
            return ' has';
        }
    }
    
    function  displayBidVal($bid){
//        if ($bid == 0){
            ?>
<!--<p>No bids yet!!</p>-->
<?php
//        }  else
            {
            ?>
<h4 style="color: #ffcc00"><?php echo "{$bid}person{$this->isSingular($bid)} bidded "; ?></h4>
<?php
        }
    }
    
    function bid($itemid, $mangruf){
        ?>
<div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Bid</h3>
  </div>
  <div class="modal-body">
    <div  id="modal">
        <form class="form-horizontal" method="post">
<fieldset>

<!-- Select Basic -->
<div class="control-group">
    <?php
    $inc = 200;
          $sel = "SELECT * FROM bid WHERE itemid = $itemid order by id DESC";
          $run = $mangruf->query($sel);
          $rw = $mangruf->rows($run);
          if ($rw > 0){
              $ftch = $mangruf->fetch($run);
              extract($ftch);
              ?>
    <p><strong>Latest Bid Value @</strong><strike>N</strike> &nbsp;<?php echo "{$bidval}"; ?></p>
  <label class="control-label" for="Bid">Bid</label>
  <div class="controls">
      <select id="bidval" name="bidval" class="input-xlarge" required="">
      <option value="">----</option>
      <?php $bidval += $inc; ?>
      <option value="<?php echo "{$bidval}"; ?>"><strike>N</strike>&nbsp;<?php echo "{$bidval}"; ?></option>
      <?php $bidval += $inc; ?>
      <option value="<?php echo "{$bidval}"; ?>"><strike>N</strike>&nbsp;<?php echo "{$bidval}"; ?></option>
    </select>
  </div>
    <?php
          }  else {
              $sql = "SELECT * FROM items WHERE id = '".$itemid."' ";
    $sql_result = $mangruf->query($sql) or die ('request "Could not execute SQL query" '.$sql);
    $row = $mangruf->rows($sql_result);
    if ($row > 0) {
    $cnt = 0;
//	while ($cnt < $row){
            $fetch = $mangruf->fetch($sql_result);
            extract($fetch);
            $bidval = $price;
            
//            $cnt++;
//        }
    }
              ?>
    <p><strong>No biddaz yet !!</strong></p>
      <label class="control-label" for="Bid">Bid</label>
  <div class="controls">
      <select id="bidval" name="bidval" class="input-xlarge" required="">
      <option value="">----</option>
      <option value="<?php echo "{$bidval}"; ?>"><strike>N</strike>&nbsp;<?php echo "{$bidval}"; ?></option>
      <?php $bidval += $inc; ?>
      <option value="<?php echo "{$bidval}"; ?>"><strike>N</strike>&nbsp;<?php echo "{$bidval}"; ?></option>
      <?php $bidval += $inc; ?>
      <option value="<?php echo "{$bidval}"; ?>"><strike>N</strike>&nbsp;<?php echo "{$bidval}"; ?></option>
    </select>
  </div>
<?php
          }
          ?>

</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="bid"></label>
  <div class="controls">
      <button id="bid" type="submit" name="bid" class="btn btn-inverse">BID</button>
  </div>
</div>


</fieldset>
</form>

</div>
      
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
  </div>
<?php
    }
     
    function bid_mod($uid, $itemid, $date, $mangruf){
        $out = '';
        $success = '';
        $val = 0;
        if (isset($_POST['bid'])){
    $bidvalue = mysql_real_escape_string($_POST['bidval']);
    
    if ($bidvalue == ""){
        $out = "Please Select a Price";
    }else{
        $sel = "SELECT * FROM bid WHERE itemid = '".$itemid."' && bidval = '".$bidvalue."' ";
        $rs = $mangruf->query($sel);
        $rw = $mangruf->rows($rs);
        if ($rw > 0){
            $out = "This product has already been BIDDED @ that price";
        }else{
$query = "INSERT INTO bid VALUES('','".$uid."', '".$itemid."', '".$bidvalue."', '".$date."') ";
$res = $mangruf->query($query);
if ($res){
    $itm_sel = "SELECT * FROM items WHERE id = '".$itemid."' ";
    $rsi = $mangruf->query($itm_sel);
    $rwi = $mangruf->rows($rsi);
    if ($rwi > 0){
        $ftch = $mangruf->fetch($rsi);
        extract($ftch);
        $val = $bids;
    }
    $val += 1;
    $upd = "UPDATE items SET bids = '".$val."' WHERE id = '".$itemid."' ";
    if ($upd){
    $success = "You have successfully bidded for the product !!".$bidvalue;
    }  else {
        $out = "Network Error";
    }
}  else {
    $out = "Unable to bid, please Try Again !!";
}
    }
    }
    if ($out != ''){
                    ?>
                    <div class="alert alert-danger" align="center">
                        <strong>Error:</strong> 
                        <?php
                        echo $out;
                        ?>
                        <script>
//                            var al = "This product has already been BIDDED @ that price";
//                            alert(al);
                    </script>
                    </div>
                    <?php
//                        $this->customModal($out, 'Error');
                    }
                    
    if ($success != ''){
                    ?>
                    <div class="alert alert-success" align="center">
                        <strong>Success:</strong> 
                        <?php
                        echo $success;
                        ?>
                    </div>
                    <?php
                    }
}

    }
    
    function semester($sem){
        if ($sem == 1){
            return 'First Semester';
        }else if ($sem == 2){
            return 'Second Semester';
        }
    }
     function level($sem){
        if ($sem == 1){
            return 'ND 1';
        }else if ($sem == 2){
            return 'ND 2';
        }
    }
    
    function excelRows($inp){
        switch ($inp) {
            case $inp == 'resultId':
                return 'S/N'. "\t";
                break;
            case $inp == 'matric_result':
                return 'Matric'. "\t";
                break;
            case $inp == 'courseCode':
                return 'Code'. "\t";
                break;
            case $inp == 'courseUnit':
                return 'Unit'. "\t";
                break;
            case $inp == 'resultLevel':
                return 'Level'. "\t";
                break;
            case $inp == 'resultSemester':
                return 'Semester'. "\t";
                break;
            case $inp == 'resultSession':
                return ;
                break;
            case $inp == 'ca':
                return 'C.A'. "\t";
                break;
            case $inp == 'exam':
                return 'EXAM'. "\t";
                break;
            case $inp == 'score':
                return 'TOTAL'. "\t";
                break;
            case $inp == 'grade':
                return 'GRADE'. "\t";
                break;
            case $inp == 'date_result':
                return '';
                break;

            default:
                break;
        }
    }
    
}

?>
