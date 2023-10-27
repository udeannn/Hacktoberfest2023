<script>
// Javascript program to sort a
// linked list that is alternatively
// sorted in increasing and decreasing order

// head of list
var head; 

// Linked list Node 
class Node 
{
	constructor(val) 
	{
		this.data = val;
		this.next = null;
	}
}

function newNode(key) 
{
	return new Node(key);
}

/* This is the main function that 
sorts the linked list. */
function sort() 
{
	/* Create 2 dummy nodes and initialise 
	as heads of linked lists */
	var Ahead = new Node(0), 
		Dhead = new Node(0);

	// Split the list into lists
	splitList(Ahead, Dhead);

	Ahead = Ahead.next;
	Dhead = Dhead.next;

	// Reverse the descending list
	Dhead = reverseList(Dhead);

	// Merge the 2 linked lists
	head = mergeList(Ahead, Dhead);
}

// Function to reverse the linked list 
function reverseList(Dhead) 
{
	var current = Dhead;
	var prev = null;
	var next;
	while (current != null) 
	{
		next = current.next;
		current.next = prev;
		prev = current;
		current = next;
	}
	Dhead = prev;
	return Dhead;
}

// Function to print linked list 
function printList() 
{
	var temp = head;
	while (temp != null) 
	{
		document.write(temp.data + " ");
		temp = temp.next;
	}
	document.write();
}

// A utility function to merge
// two sorted linked lists
function mergeList(head1, head2) 
{
	// Base cases
	if (head1 == null)
		return head2;
	if (head2 == null)
		return head1;

	var temp = null;
	if (head1.data < head2.data)
	{
		temp = head1;
		head1.next = mergeList(head1.next, head2);
	} 
	else
	{
		temp = head2;
		head2.next = mergeList(head1, head2.next);
	}
	return temp;
}

// This function alternatively splits
// a linked list with head as head into two:
// For example, 10->20->30->15->40->7 is
// splitted into 10->30->40 and 20->15->7
// "Ahead" is reference to head of ascending 
// linked list
// "Dhead" is reference to head of descending 
// linked list
function splitList(Ahead, Dhead) 
{
	var ascn = Ahead;
	var dscn = Dhead;
	var curr = head;

	// Link alternate nodes
	while (curr != null) 
	{
		// Link alternate nodes in 
		// ascending order
		ascn.next = curr;
		ascn = ascn.next;
		curr = curr.next;

		if (curr != null) 
		{
			dscn.next = curr;
			dscn = dscn.next;
			curr = curr.next;
		}
	}
	ascn.next = null;
	dscn.next = null;
}

// Driver code 
head = newNode(10);
head.next = newNode(40);
head.next.next = newNode(53);
head.next.next.next = 
newNode(30);
head.next.next.next.next = 
newNode(67);
head.next.next.next.next.next = 
newNode(12);
head.next.next.next.next.next.next = 
newNode(89);
document.write("Given linked list<br/>");
printList();

sort();

document.write("<br/>Sorted linked list<br/>");
printList();
// This code contributed by aashish1995 
</script>
