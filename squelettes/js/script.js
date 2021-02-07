window.addEventListener("load", function(){
	getLeft = localStorage.getItem("left");
	getRight = localStorage.getItem("right");
	
	document.querySelector("#nav").style.left = getLeft;
	document.querySelector("#nav").style.right = getRight;
	
	nav = document.querySelector("#nav")

	nav.addEventListener("drag",commencer)
	nav.addEventListener("dragend",fin);
	
	var width = window.innerWidth
		|| document.documentElement.clientWidth
		|| document.body.clientWidth;
	
	var height = window.innerHeight
		|| document.documentElement.clientHeight
		|| document.body.clientHeight;
	
	function commencer(e) {
		nav.style.display = "none";
		if (e.clientX < width/2)
		{
			document.body.style.borderRight = '0px solid black';
			document.body.style.borderLeft = '16px solid #d50000';
		} 
		else 
		{
			document.body.style.borderLeft = '0px solid black';
			document.body.style.borderRight = '16px solid #d50000';
		}
	}
	
	function fin(e) {
		
		nav.style.display = "block"
		document.body.style.borderRight = '0px solid black'
		document.body.style.borderLeft = '0px solid #d50000';
		
		if (e.clientX < width/2)
		{
			localStorage.setItem('left','0');
			localStorage.setItem('right','auto');
			nav.style.left = 0;
			nav.style.right = 'auto';
		}
		else
		{
			localStorage.setItem('left','auto');
			localStorage.setItem('right','0');
			nav.style.right = 0;
			nav.style.left = 'auto';
		}
	}

	/*script emplacement site logo actif*/
	
	liste = [...document.querySelectorAll(".e1")];
	x = 0;
	
	for (titre in liste)
	{
		if (liste[x].href == window.location)
		{
			liste[x].style.backgroundColor = "#085004";
			liste[x].style.color = "white";
		}
		x++;
	}
});
