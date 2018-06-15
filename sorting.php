
<?php
session_start();
if($_SESSION['logged_in'] != 1 ){
    
  header('Location: index.html');
}

  if ( time() - $_SESSION['time_created'] > 60*30){
      
      session_unset();
        
       if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time(), '/');
       }

        session_destroy();
       header('Location: index.html');
    }

?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/stylet.css">
<title></title>
    </head>
    
    
    
<body>
    <div class="wrapper">
        
<div id ="menu">
            
<select id = "arrLength">
<option selected disabled value="2">length</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
        
<select id = "algorithm">
<option value="bublesort">buble sort</option>
<option value="insertionsort">insertion sort</option>
</select>
        
<input type="text" id="numbers" placeholder="enter numbers separated by comma"/>
    
        
<!--<button id="startButon" onclick = "start()">start</button>-->
<!--<button id="stopButon" onclick = "stopAnimation()">stop</button>-->
    <a id="S" onclick="start()"> start </a>
     <a id="S" onclick="stopAnimation()"> stop </a>
        
    </div> 

    
    <div class="actionField" id="actionField">
        
        <div id="moveAble1" class="moveAble">15</div>
        <div id="moveAble2" class="moveAble">45</div>
        <div id="moveAble3" class="moveAble">37</div>
        <div id="moveAble4" class="moveAble">36</div>
        <div id="moveAble5" class="moveAble">38</div>
        <div id="moveAble6" class="moveAble">6</div>
        <div id="moveAble7" class="moveAble">25</div>
        <div id="moveAble8" class="moveAble">24</div>
        <div id="moveAble9" class="moveAble">27</div>
        <div id="moveAble10" class="moveAble">19</div>
        
    </div>
    <p id="display"></p>
     <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.0.min.js">
</script>
    <script src="js/sorting.js" type="text/javascript">
</script>
    
</div>


</body>


</html>