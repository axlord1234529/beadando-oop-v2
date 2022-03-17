function displayMenu(){
    const nav_links = document.getElementsByClassName("nav-links");
    const burger = document.querySelector(".burger").addEventListener("click",()=>{
        for (let i = 0; i < nav_links.length; i++) {
            if(!nav_links[i].classList.contains("nav-active"))
            {
                nav_links[i].classList.add("nav-active");
            }
            else
            {
                nav_links[i].classList.remove("nav-active");
            }
            
        }
        
    });
}
function creatX(){
    
    
    const burger = document.querySelector(".burger").addEventListener("click",()=>{
        //let data_open = burger.getAttribute("data-open");
        const burger = document.querySelector(".burger");
    if(burger.getAttribute("data-open") == "false")
    { 
        burger.classList.add("X")
        burger.setAttribute("data-open","true"); 
    }else{
        burger.classList.remove("X");
        burger.setAttribute("data-open","false");
    }  
    });
}
displayMenu();
creatX();