var curent = 0;
var limit = 0;

function getDivElements(choise) {

	var allElements = document.getElementById("actionField").childNodes;
	var divElements = [];
	for (var i = 0, j = 0; j < choise && i < allElements.length; i++) {

		if (allElements[i].nodeName == "DIV") {
			divElements[j] = allElements[i];
			divElements[j].style.visibility = 'visible';
			j++;
		}
	}
	return divElements;// not all DIV elemets
}

function initialize() {
	var left = 125;
	var allElements = document.getElementById("actionField").childNodes;
	for (var i = 0; i < allElements.length; i++) {
		if (allElements[i].nodeName == "DIV") {
			allElements[i].style.visibility = 'hidden';
			allElements[i].style.backgroundColor = 'darkorange';
			allElements[i].style.left = left + 'px';
			allElements[i].style.top = 150 + 'px';
			left += 25;
		}
	}

}

function stopAnimation() {
	var highestTimeoutId = setTimeout(";");
	for (var i = 0; i < highestTimeoutId; i++) {
		clearTimeout(i);
	}
}

function setContent(numbers, divElements) {
	var select = document.getElementById("arrLength");
	var choise = select.options[select.selectedIndex].value;
	var j = 0;
	for (var i = 0; i < choise; i++) {
		var num = '';

		while (numbers[j] != ',' && j < numbers.length) {
			num = num + numbers[j];
			j++;
		}// concatenate the number while no comma
		if (!isNaN(num) && num != '')// check for 12h2w in example
			divElements[i].textContent = num;
		else
			divElements[i].textContent = 0;

		j++;//skip comma 
	}
}

function blink(element, color, blinkNumber) {

	var t = 0;
	var clock = setInterval(function() {
		if (element.style.backgroundColor == color) {
			element.style.backgroundColor = "darkorange";
			t++;
		} else
			element.style.backgroundColor = color;

		if (t > blinkNumber) {
			clearInterval(clock);
		}
	}, 180);
}

function bubleSort(divElements) {
	if (curent > divElements.length - 2 - limit) {
		divElements[curent].style.background = "grey";
		curent = 0;
		limit++;
	}
	;
	if (limit > divElements.length - 2) {
		divElements[0].style.background = "grey";
		return;
	}// all elements are sorted

	if (Number(divElements[curent].textContent) > Number(divElements[curent + 1].textContent)) {
		blink(divElements[curent], "red", 2);
		blink(divElements[curent + 1], "red", 2);
		// след 2600 се вика swap и веднага след това отново sort() при което се вика blink още преди swap да е завършило
		setTimeout(function() {//дава достатъ1но време за да мига
			swap(divElements[curent], divElements[curent + 1]);
			var temp = divElements[curent];
			divElements[curent] = divElements[curent + 1];
			divElements[curent + 1] = temp;

			curent++;
			t = 0;
			setTimeout(function() {
				bubleSort(divElements);
			}, 1800);
		}, 1400);
	}

	else {
		blink(divElements[curent], "chartreuse", 1);
		blink(divElements[curent + 1], "chartreuse", 1);
		curent++;
		setTimeout(function() {
			bubleSort(divElements);
		}, 1800);
	}
}

/* for (var i = 0, txt = '' ; i < divElements.length; i++)
 txt = txt + divElements[i].textContent +  "<br>";
 document.getElementById("display").innerHTML = txt;*/

function swap(leftElm, rightElm) {

	var r = 12.5;
	//var newLeft;
	//var newTop;
	var t = 0;

	var centerLeft = {
		left : leftElm.offsetLeft,
		top : leftElm.offsetTop
	};
	var clock = setInterval(function() {
		move(rightElm, centerLeft, 1);
		move(leftElm, centerLeft, -1);//проверка, ако подадем 1000?
		t += 0.009;
		// console.log(t);
		if (t > 3.14159)
			clearInterval(clock);
	}, 1);
    
    	function move(element, center, multiplier) {
		var stepLeft = r * Math.cos(t);
		var stepDown = r * Math.sin(t);
		var newLeft = (center.left + r + multiplier * stepLeft);// + r + r*1 
		var newTop = (center.top - multiplier * stepDown);
		element.style.top = newTop + 'px';
		element.style.left = newLeft + 'px';
	}
}

function operate(element, interval = 10, limit = 23, callback) {
  var i = 0;
  var clock = setInterval(function () {
    callback(i);

    i++;
    if (i > limit) {
      clearInterval(clock);
    }
  }, interval);
}

var l = 0;// also in start()!
function insertionSort(divElements){
    console.log('beginning of sort');
    var interval = 8; 
    var limit = 24;
    if(l > divElements.length - 1) return;
    
    var curent = divElements[l];
    var j = l;
    
    offSetElements(divElements);
    console.log('back to sort')
    
    //declaration of other functions...
    function raise(element){
        operate( element, interval, limit, function (i) {
        element.style.top = element.offsetTop - 1 + 'px';
    });
    }
    
    function shiftRight(element){
        console.log('shift right begins')
        operate( element, interval, limit, function (i) {
        element.style.left = element.offsetLeft + 1 + 'px';
    });
    }
    
    function offSetElements(divElements){
        
    if( j > 0 && Number(divElements[j-1].textContent) > Number(curent.textContent) ) // (j == l)
        { var time = 983;//800 to call shift right + 183 to do shift right
            if( j == l) {raise(curent);console.log('raised');} //alredy here means the element is smaller
            curent.style.background = 'red';
            console.log('setting timeout to shift right for '+ divElements[j-1].textContent);
            setTimeout(function(){
            shiftRight(divElements[j-1]);
            divElements[j] = divElements[j-1];
            j--;
            },800);
            
            console.log('setting timeout to offset again');
            setTimeout(function(){console.log('calling offset');offSetElements(divElements);}
            ,time);// need do be 800 + x, x is time to shiftRight (aproximately 184 ms)
         
        }
        else {
            curent.style.background = 'forestgreen';
            console.log('in else j=' + j)
            if(j!= l) { // (j!=l) -> whether offset has been done; here putElement calls sort
                        // в единия случай j не е мръднало т.е j == l
                setTimeout(function(){putElement(curent, j); divElements[j] = curent;},270);
                }
            else  setTimeout(function(){insertionSort(divElements);}
            ,800);
            l++;
            
        }
        
        
    }
    
    
       function putElement(element, position){//position = j
        console.log('puElement, before' + divElements[position + 1].offsetLeft );
           
       var destinationX = divElements[position].offsetLeft - 25;// the old element is still there
        var destinationY = 150; //magic
           var step = 1;
 
        var distanceToX = element.offsetLeft - destinationX;//abs
        var distanceToY = destinationY - element.offsetTop;//abs to sure
           console.log(destinationX);
           console.log(destinationY);
           console.log(distanceToX);
           console.log(distanceToY);
        var coefficient = distanceToY/distanceToX;
           
        var clock = setInterval(function() {
		if (element.offsetTop > 148){
            clearInterval(clock);
            setTimeout(function(){insertionSort(divElements);},400);
        
        }
            move(element);
	    }, 30);  
           

           function move(element){
               var newTop = element.offsetTop + step;
              element.style.top = newTop + 'px';
               var newLeft = element.offsetLeft - step/coefficient;
		      element.style.left = newLeft + 'px';
           }
        
        }
    
    
    }       

 
function start() {
    var selectLength = document.getElementById("arrLength");
	var lengthChoise = selectLength.options[selectLength.selectedIndex].value;
    var selectAlgorithm = document.getElementById("algorithm");
	var algorithmChoise = selectAlgorithm.options[selectAlgorithm.selectedIndex].value;
    
    
	stopAnimation();
	var numbers = document.getElementById("numbers").value;
	curent = 0;
	limit = 0; l = 0;//i in insertion sort outer loop
	initialize();
	
    
    
	var divElements = getDivElements(lengthChoise);

	setContent(numbers, divElements);
    if(algorithmChoise == 'insertionsort')
	insertionSort(divElements);
     if(algorithmChoise == 'bublesort')
	bubleSort(divElements);
	saveData();


function saveData(){
	var arr='';
	if(numbers[0] == undefined ) arr = "an empty array"; 
	else
	arr = numbers;
	var action = algorithmChoise + ": " + arr;
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




