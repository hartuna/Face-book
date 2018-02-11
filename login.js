window.onload = function(){
	open();
	close();
}
function open(){
	var open = document.getElementById('openUsers');
	open.addEventListener('click', show, false);
}
function show(){
	var element = document.getElementById('users');
	element.style.display = 'inline-block';
	showElement(0.00);
}
function showElement(opacity){
	var element = document.getElementById('users');
	element.style.opacity = opacity;
	if(opacity < 1.00){
		opacity += 0.05;
		setTimeout(function(){showElement(opacity)}, 10);
	}
}
function close(){
	var open = document.getElementById('close');
	open.addEventListener('click', hide, false);
}
function hide(){
	var element = document.getElementById('users');
	hideElement(1.00);
}
function hideElement(opacity){
	var element = document.getElementById('users');
	element.style.opacity = opacity;
	if(opacity > 0.00){
		opacity -= 0.05;
		setTimeout(function(){hideElement(opacity)}, 10);
	}
	else{
		element.style.display = 'none';
	}
}
