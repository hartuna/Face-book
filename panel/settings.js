window.onload = function(){
	var red = document.getElementById('red');
	var green = document.getElementById('green');
	var blue = document.getElementById('blue');
	for (var i = 0; i < 7; i++){
		let index = i;
		red.children[index].addEventListener('click', function(){color(index, 'red')});
		green.children[index].addEventListener('click', function(){color(index, 'green')});
	    blue.children[index].addEventListener('click', function(){color(index, 'blue')});
	}
	var avatar = document.getElementById('chooseLogo');
	for (var i = 0; i < 8; i++){
		let index = i;
		avatar.children[index].addEventListener('click', function(){chooseLogo(index)});
	}
}
function color(number, color){
	var value = document.getElementsByClassName('value');
	if(color == 'red'){
		var red = document.getElementById('red');
		for(var i = 0; i < 7; i++){
			red.children[i].className = 'partSlideRed';
		}	
		red.children[number].className = 'partSlideRed activeSlide';
		chooseColor(parseInt(value[0].textContent), (number + 1) * 32, color);
	}
	else if(color == 'green'){
		var green = document.getElementById('green');
		for(var i = 0; i < 7; i++){
			green.children[i].className = 'partSlideGreen';
		}	
		green.children[number].className = 'partSlideGreen activeSlide';
		chooseColor(parseInt(value[1].textContent), (number + 1) * 32, color);
	}
	else if(color == 'blue'){
		var blue = document.getElementById('blue');
		for(var i = 0; i < 7; i++){
			blue.children[i].className = 'partSlideBlue';
		}	
		blue.children[number].className = 'partSlideBlue activeSlide';
		chooseColor(parseInt(value[2].textContent), (number + 1) * 32, color);
	}
}
function chooseColor(valueNow, valueNext, color){
	var value = document.getElementsByClassName('value');
	if(valueNow != valueNext){
		if(valueNow < valueNext){
			valueNow += 8;
		}	
		else{
			valueNow -= 8;
		}
		var avatar = document.getElementById('avatar');
		if(color == 'red'){
			value[0].textContent = valueNow;	
		}
		else if(color == 'green'){
			value[1].textContent = valueNow;	
		}
		else if(color == 'blue'){
			value[2].textContent = valueNow;	
		}
		var red = value[0].textContent;
		var green = value[1].textContent;
		var blue = value[2].textContent;
		avatar.style.backgroundColor = 'rgb(' + red + ', ' + green + ', ' + blue + ')';
		setTimeout(function(){chooseColor(valueNow, valueNext, color)}, 10);
	}
	else{
		var toSave = document.getElementById('color');
		toSave.value = value[0].textContent + ', ' + value[1].textContent + ', ' + value[2].textContent;
	}	
}
function chooseLogo(index){
	var active = document.getElementsByClassName('avatar activeAvatar');
	var next = document.getElementsByClassName('avatar');
	var showAvatar = document.getElementById('cos');
	var toSave = document.getElementById('avatarNumber');
	active[0].className = 'avatar';
	next[index].className = 'avatar activeAvatar';
	index++;
	showAvatar.src = '../image/avatar' + index + '.png';
	toSave.value = index;
}