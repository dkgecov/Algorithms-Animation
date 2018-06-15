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
<div id="menu">
    
<select id = "algorithm">
<option value="DFS">Depth First Search</option>
<option value="BFS">Breadth First Search</option>
</select>
    
    <select id = "startNode">
<option selected disabled value="1">starting node</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
</select>
    
<!--<button id="startButon" onclick="start()">start</button>
<button id="stopButon" onclick="clearT()">stop</button>-->
    <a id="S" onclick="start()"> start </a>
     <a id="S" onclick="clearT()"> stop </a>
</div>
    

    
<div class="actionField">
<div id="node1" class="node">1</div>
<div id="node2" class="node">2</div>
<div id="node3" class="node">3</div>
<div id="node4" class="node">4</div>
<div id="node5" class="node">5</div>
<div id="node6" class="node">6</div>
<div id="node7" class="node">7</div>
<div id="node8" class="node">8</div>
<div id="node9" class="node">9</div>
<div id="node10" class="node">10</div>
<div id="node11" class="node">11</div>
<div id="node12" class="node">12</div>
<div id="node13" class="node">13</div>

    <div id="edge1" class="verticalEdge"></div>
    <div id="edge2" class="verticalEdge"></div>
    <div id="edge3" class="verticalEdge"></div>
    <div id="edge4" class="verticalEdge"></div>
    <div id="edge5" class="verticalEdge"></div>
    
    <div  id="dEdge1" class="diagonalEdge"></div>
    <div  id="dEdge2" class="diagonalEdge"></div>
    <div  id="dEdge3" class="diagonalEdge"></div>
    <div  id="dEdge4" class="diagonalEdge"></div>
    
    <div id="horizontalEdge"></div>
    
    <div id="dEdgeL1" class="diagonalEdgeLong"></div>
    <div id="dEdgeL2" class="diagonalEdgeLong"></div>
    <div id="dEdgeL3" class="diagonalEdgeLong"></div>
    
    <div id="horizontalEdgeLong"></div>
    
    <div id="verticalEdgeLong"></div>
    
    <div id="edge58"></div>
    
    </div>
    
</div>
         <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.0.min.js">
</script>
<script src="js/traversing.js" type="text/javascript">
</script>



</body>


</html>
