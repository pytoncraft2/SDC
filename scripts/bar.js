b = 1;
i = document.getElementById("ouvrir");
j = document.getElementById("ouvrir2");
m = document.getElementById("txt-menu");
f = document.getElementById("ind");
        function ouvrir() {
    
        if (b==1) {

       
        i.style.borderBottom = "101vh solid #074704";
        i.style.borderRight = "100vw solid transparent";
        
        j.style.borderTop = "100vh solid #074704 ";
        j.style.borderLeft = "100vw solid transparent";
        m.style.opacity = "1";
        m.style.visibility = "visible"
        m.style.transition = "opacity 3s";
        f.style.opacity = "0";
        
        
        b++;
        }

        else {
		


i.style.borderBottom = "100vh solid transparent";
        i.style.borderLeft= "0 solid transparent";
        i.style.borderRight = "0px solid transparent";
        i.style.borderBottom = "0px solid transparent";
        
        m.style.visibility = "hidden";
        m.style.opacity = "0";
        m.style.transition = "opacity 0s";
        
        f.style.opacity = "1";
        j.style.borderTop = "0px solid transparent";
        j.style.borderLeft = "0px solid transparent";
        j.style.borderRight = "0px solid transparent";

        b-=1;

        }
        }


g = 1;

document.body.addEventListener("dblclick",function() {
   
ouvrir();

       
});

