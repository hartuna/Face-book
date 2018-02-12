window.onload = function(){
	open();
	close();
	error();
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
		opacity += 0.1;
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
		opacity -= 0.1;
		setTimeout(function(){hideElement(opacity)}, 10);
	}
	else{
		element.style.display = 'none';
	}
}
function error(){
	var element = document.getElementById('statement');
	if(element.textContent != ''){
		showError(-40);
	}
}
function showError(margin){
	var element = document.getElementById('error');
	margin += 4;
	element.style.marginTop = margin + 'px';
	if(margin == 0){
		setTimeout(function(){hideError(margin)}, 2000);
	}
	else{
		setTimeout(function(){showError(margin)}, 10);
	}
}
function hideError(margin){
	var element = document.getElementById('error');
	margin -= 4;
	element.style.marginTop = margin + 'px';
	if(margin > -40){
		setTimeout(function(){hideError(margin)}, 10);
	}
}
