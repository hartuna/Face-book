window.onload = function(){
	var addFriend = document.getElementById('addFriend');
	addFriend.addEventListener('click', newFriend);
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