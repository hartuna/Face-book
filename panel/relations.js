window.onload = function(){
	var addFriend = document.getElementById('addFriend');
	addFriend.addEventListener('click', newFriend);
	var search = document.getElementById('searchFriend');
	search.addEventListener('keyup', searchFriend);
	error();
}
function newFriend(){
	var addFriend = document.getElementById('addFriend');
	var form = document.getElementById('addNewFriend');
	if(addFriend.textContent == 'Nowe zaproszenie'){
		form.style.display = 'inline-block';
		addFriend.textContent = 'Zamknij';
	}
	else{
		form.style.display = 'none';
		addFriend.textContent = 'Nowe zaproszenie';
	}
}
function searchFriend(){
	var person = document.getElementsByClassName('personAccept');
	var firstName = document.getElementsByClassName('firstNameAccept');
	var lastName = document.getElementsByClassName('lastNameAccept');
	var search = (document.getElementById('searchFriend').value).toLowerCase();
	if(search != ''){
		for(var i = 0; i < firstName.length; i++){
			var variantOne = (firstName[i].textContent + ' ' + lastName[i].textContent).toLowerCase();
			var variantTwo = (lastName[i].textContent + ' ' + firstName[i].textContent).toLowerCase();
			if(variantOne.indexOf(search) == -1 && variantTwo.indexOf(search) == -1){
				person[i].style.display = 'none';	
			}
			else{
				person[i].style.display = 'inline-block';
			}
		}	
	}
	else{
		for(var i = 0; i < firstName.length; i++){
			person[i].style.display = 'inline-block';	
		}
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