//code.stephenmorley.org
function Queue(){var a=[],b=0;this.getLength=function(){return a.length-b};this.isEmpty=function(){return 0==a.length};this.enqueue=function(b){a.push(b)};this.dequeue=function(){if(0!=a.length){var c=a[b];2*++b>=a.length&&(a=a.slice(b),b=0);return c}};this.peek=function(){return 0<a.length?a[b]:void 0}};


var List = [];
var visited = new Array(16);
//var queue = new Queue();
//var tracking = new Queue();
    
     List[0] = [1, 6];
     List[1] = [0, 2, 10];
     List[2] = [1, 3, 4];
     List[3] = [2, 9];
     List[4] = [5, 6, 7, 2];
     List[5] = [8, 4, 12];
     List[6] = [4, 7, 0];
     List[7] = [4, 6];
     List[8] = [9, 5, 12];
     List[9] = [3, 8];
     List[10] = [1, 11];
     List[11] = [10];
     List[12] = [8, 5];   

function bfs (root, queue){
    queue.enqueue(root); visited[root] = true;
    
    iterate();
    
    function iterate(){
    if( queue.isEmpty() ) return;
    var x = queue.dequeue();console.log(x+1);
    document.getElementById("node" +(x+1)).style.background = 'green';
    for(var j=0; j < List[x].length;j++) 
    if(!visited[List[x][j]]){queue.enqueue(List[x][j]);console.log('pushed'+(List[x][j] + 1 )); visited[List[x][j]] = true;}
    setTimeout(function(){iterate();},1000);
    }
}



function dfs (root, tracking){
  visited[root] = true; tracking.enqueue(root+1);console.log(root+1);
   var l = List[root].length;
    for( var i = 0; i < l; i++ ){
        if( !visited[ List[root][i] ] ) {
        dfs(List[root][i], tracking);
        console.log('backtracking from ' + (root+1));
            tracking.enqueue((root + 1)*191);
        }
    }
   // console.log('backtracking to ' + (root+1));
}



function animate(previousNode, tracking){
       if(tracking.isEmpty()) return;
    var curentNode = tracking.dequeue();
    if(curentNode % 191 != 0) 
    {    if (previousNode % 191 == 0 && previousNode != null ) document.getElementById("node" + previousNode/191).style.background = 'green';
        document.getElementById("node" +curentNode).style.background = 'green';
    }
    else 
    {   if (previousNode % 191 == 0) document.getElementById("node" + previousNode/191).style.background = 'green';
        document.getElementById("node" + curentNode/191).style.background = '#01DF01';
        
    }

    console.log(curentNode);
    
    setTimeout(function(){    
    animate(curentNode, tracking);
    },1000);
    }


function clearT() {
	var highestTimeoutId = setTimeout(";");
	for (var i = 0; i < highestTimeoutId; i++) {
		clearTimeout(i);
	}
}


function initialize(){
    //queue = new Queue();
    //tracking = new Queue();
    for( var i = 1; i < 14 ; i++ )
    document.getElementById("node" + i).style.background = 'chocolate';
    for(var i=0; i < visited.length; i++) visited[i]=false;
}

function start(){
    clearT();
    initialize();
    var tracking = new Queue();
    
    
    var selectAlgorithm = document.getElementById("algorithm");
	var algorithmChoise = selectAlgorithm.options[selectAlgorithm.selectedIndex].value;
    
    var selectNode = document.getElementById("startNode");
    var nodeChoise = selectNode.options[selectNode.selectedIndex].value;
    
    if(algorithmChoise == 'DFS'){
    dfs(Number(nodeChoise-1), tracking);
    animate(null,tracking);}
    
     if(algorithmChoise == 'BFS'){
         bfs(nodeChoise-1, new Queue);
     }
	 saveData()
	 
	 function saveData(){
	var action = algorithmChoise + ": " + "Starting node " + nodeChoise;
	var arr = {action:action};
	var json = JSON.stringify(arr);
	$.ajax({
	type: "POST",
	url: "saveData.php",
	data: {data: json},
	success: function(data){
            console.log(data);
        }
});
}
}







/*
dfs(4);
animate();
*/






/*
function dfs (root){
    var stack =[];
    var realRoot = root-1;
    stack.push(realRoot); visited[realRoot] = true;
    
    iterate();
    
    function iterate(){
    if( stack.length == 0 ) return;
    var x = stack.pop();console.log(x+1);
    document.getElementById("node" +(x+1)).style.background = 'green';
    for(var j=0; j < List[x].length;j++) 
    if(!visited[List[x][j]]){stack.push(List[x][j]);console.log('pushed'+(List[x][j] + 1 )); visited[List[x][j]] = true;}
    setTimeout(function(){iterate();},1000);
    }
}
*/