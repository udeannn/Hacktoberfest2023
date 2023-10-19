var input = document.getElementById("user-input");
var addButton = document.getElementById("add");
var ul = document.getElementById("list");

const validateInput = () => {
	if (input.value.length > 0) {
		return true;
	}
	return false;
}

const handleCreateElement = () => {
	let value = input.value;
	let taskElement = document.createElement('span');
	let deleteButton = document.createElement("button");
	let li = document.createElement("li");

	li.classList.add("list-item");
	taskElement.classList.add("task-desc");
	taskElement.appendChild(document.createTextNode(value));

	deleteButton.appendChild(document.createTextNode("Delete"));
	
	li.appendChild(taskElement);
	li.appendChild(deleteButton);

	ul.appendChild(li);

	input.value = '';
}

const validateNumberOfItems = () => {
	if (ul.children.length > 9) {
		alert("You have reach maximum number of items.");
	} else {
		handleCreateElement();
	}
}

const handleAdd = () => {
	if (validateInput()) {
		validateNumberOfItems();
	}
}

const handleComplete = (event) => {
	target = event.target;

	target.classList.toggle('done');
}

const handleDelete = (event) => {
	target = event.target;

	target.parentElement.remove();
}

const handleULClick = (event) => {
	tag = event.target.tagName;

	if (tag === 'SPAN') {

		handleComplete(event);

	} else if (tag === 'BUTTON') {

		handleDelete(event);

	}
}

addButton.addEventListener("click", handleAdd);

// Use event delegation to listen to child events
ul.addEventListener("click", handleULClick);