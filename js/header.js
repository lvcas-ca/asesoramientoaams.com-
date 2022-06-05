export function header(){
    const d = document;
    const w = window;
   
    const containerMenu = d.querySelector(".header");
    const hambur = d.querySelector(".hamburger");
    const nodoButton = d.querySelectorAll(".nodobutton");

    const ToggleAnimationButton = el =>{
        hambur.addEventListener("click", e=>{
           hambur.classList.toggle("is-active");
        });
    }

    ToggleAnimationButton();

    const ClickEnlaceCerrarMenu = el =>{
        if(el.target.matches(".menu-enlace")){
            containerMenu.classList.add("menu-cerrado");
        }
    }

    const MenuAbierto = e =>{
        containerMenu.classList.toggle("menu-abierto");
        
    }

    const RemoveMenuCerradoAbierto = e =>{
        containerMenu.classList.remove("menu-cerrado");
        containerMenu.classList.remove("menu-abierto");
    }



    
    d.addEventListener("click", (e)=>{
       if(e.target.matches(".nodobutton")){
        MenuAbierto();
       }
       if(screen.width <= 800){
        if(e.target.matches(".menu-enlace")){
            RemoveMenuCerradoAbierto();
            hambur.classList.toggle("is-active");
        }
       }
    });

    
    /*
    
    Efecto scroll menu
    const menu = d.querySelector(".menu-container");
    const topMenu = menu.offsetTop;

    const fixNav = e =>{
        if(w.scrollY >= topMenu && screen.width > 950){
            d.body.style.paddingTop = menu.offsetHeight + "px";
            d.body.classList.add("sticky");
        }else{
            d.body.style.paddingTop = 0;
            d.body.classList.remove("sticky");
        } 
  
       
    }
 
    w.addEventListener("scroll", fixNav);

    */
}