async function getToolsAPI(){try{const e="/api/tools",t=await fetch(e);listTools(await t.json())}catch(e){console.log(e)}}async function getCategoriesAPI(){try{const e="/api/category",t=await fetch(e);listCategories(await t.json())}catch(e){console.log(e)}}function listTools(e){const t=document.querySelector("#toolsContainer");e.forEach((e=>{const{name:o,image:n,description:c,url:s,category_id:a}=e,i=document.createElement("div");i.classList.add("card"),i.setAttribute("data-category-id",a);const r=document.createElement("h3");r.textContent=o;const d=document.createElement("IMG");d.loading="lazy",d.src=`/images/${n}`,d.alt="Imagen de la página";const l=document.createElement("p");l.textContent=c;const u=document.createElement("a");u.href=s,u.textContent="Explorar",u.target="_blank",u.classList.add("button"),i.appendChild(r),i.appendChild(d),i.appendChild(l),i.appendChild(u),t.appendChild(i)}))}function listCategories(e){const t=document.querySelector("#categories-container");t.innerHTML="";const o=createCategoryButton("Todas",0);t.appendChild(o),e.forEach((e=>{const{id:o,name:n}=e,c=createCategoryButton(n,o);t.appendChild(c)})),o.classList.add("active"),filterTools(0)}function createCategoryButton(e,t){const o=document.createElement("BUTTON");return o.classList.add("tab-button"),o.setAttribute("data-category-id",t),o.textContent=e,o.addEventListener("click",(function(){document.querySelectorAll(".tab-button").forEach((e=>e.classList.remove("active"))),o.classList.add("active"),filterTools(t)})),o}function filterTools(e){document.querySelectorAll("#toolsContainer .card").forEach((t=>{const o=t.getAttribute("data-category-id");t.style.display=0==e||o==e?"flex":"none"}))}function disabledDrop(){const e=document.querySelector(".header"),t=document.querySelector(".nav .dropdown"),o=document.querySelector(".nav .no-drop");e.classList.contains("inicio")?t.style.display="none":o.style.display="none"}function disableBlur(){const e=document.querySelector(".tools-grid");document.querySelector(".header").classList.contains("inicio")?e.classList.add("blur"):e.classList.remove("blur")}function mobileMenu(){document.querySelector(".menu").addEventListener("click",showMenu)}function showMenu(){const e=document.querySelector(".nav");e.classList.toggle("show-menu"),window.addEventListener("resize",(()=>{window.innerWidth,e.classList.remove("show-menu")}))}function dropDown(){document.querySelector(".dropdown").addEventListener("click",showCategories)}function showCategories(){const e=document.querySelector(".categories"),t=document.querySelector(".icon-tabler-chevron-down");e.classList.toggle("show-list"),t.classList.toggle("rotate"),window.addEventListener("resize",(()=>{window.innerWidth,e.classList.remove("show-list")}))}document.addEventListener("DOMContentLoaded",(function(){getToolsAPI(),getCategoriesAPI(),mobileMenu(),dropDown(),disabledDrop(),disableBlur()}));