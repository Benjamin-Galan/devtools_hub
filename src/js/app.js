// Espera a que el contenido del documento esté completamente cargado antes de ejecutar las funciones
document.addEventListener('DOMContentLoaded', function () {
    getToolsAPI(); // Llama a la API para obtener herramientas
    getCategoriesAPI(); // Llama a la API para obtener categorías
    mobileMenu(); // Inicializa el menú móvil
    dropDown(); // Inicializa el menú desplegable
    disabledDrop(); // Deshabilita el menú desplegable
    disableBlur(); // Deshabilita el efecto de desenfoque
});

// Función asíncrona para obtener herramientas desde la API
async function getToolsAPI() {
    try {
        const URL = '/api/tools'; //`${location.origin}/api/tools`; 
        const result = await fetch(URL); 
        const tools = await result.json(); 
        //Listar herramientas
        listTools(tools); 
    } catch (error) {
        console.log(error); 
    }
}

// Función asíncrona para obtener categorías desde la API
async function getCategoriesAPI() {
    try {
        const URL = '/api/category'; 
        const result = await fetch(URL); 
        const categories = await result.json();
        //Listar categorías
        listCategories(categories); 
    } catch (error) {
        console.log(error); 
    }
}

// Función para listar herramientas en el contenedor HTML
function listTools(tools) {
    const toolsContainer = document.querySelector('#toolsContainer');

    tools.forEach(tool => {
         //Obtener los datos de la herramienta
        const { name, image, description, url, category_id } = tool;

        //Contenedor para la herramienta
        const toolContainer = document.createElement('div'); 
        toolContainer.classList.add('card'); 
        toolContainer.setAttribute('data-category-id', category_id); 

        // Crea y añade el nombre de la herramienta
        const toolName = document.createElement('h3');
        toolName.textContent = name;

        // Crea y añade la imagen de la herramienta
        const toolImg = document.createElement('IMG');
        toolImg.loading = 'lazy'; 
        toolImg.src = `build/images/${image}`;
        toolImg.alt = 'Imagen de la página';

        // Crea y añade la descripción de la herramienta
        const toolDescription = document.createElement('p');
        toolDescription.textContent = description;

        // Crea y añade el enlace a la herramienta
        const toolLink = document.createElement('a');
        toolLink.href = url; 
        toolLink.textContent = 'Explorar'; 
        toolLink.target = '_blank'; 
        toolLink.classList.add('button');

        // Añade los elementos al contenedor de la herramienta
        toolContainer.appendChild(toolName);
        toolContainer.appendChild(toolImg);
        toolContainer.appendChild(toolDescription);
        toolContainer.appendChild(toolLink);

        // Añade la tarjeta de herramienta al contenedor de herramientas
        toolsContainer.appendChild(toolContainer);
    });
}

// Función para listar categorías en el contenedor HTML
function listCategories(categories) {
    const categoriesContainer = document.querySelector('#categories-container');
    // Limpiar el contenido existente
    categoriesContainer.innerHTML = ''; 

    // Botón para mostrar todas las categorías
    const allButton = createCategoryButton('Todas', 0);
    categoriesContainer.appendChild(allButton);

    // Botón para cada categoría y lo añade al contenedor
    categories.forEach(category => {
        const { id, name } = category;
        const button = createCategoryButton(name, id);
        categoriesContainer.appendChild(button);
    });

    // Establecer el botón "Todas" como activo por defecto
    allButton.classList.add('active');

    // Filtrar las herramientas para mostrar todas
    filterTools(0); 
}

// Función para crear un botón de categoría
function createCategoryButton(name, id) {
    const button = document.createElement('BUTTON'); 
    button.classList.add('tab-button'); 
    
    // Almacena el ID y nombre de la categoría
    button.setAttribute('data-category-id', id); 
    button.textContent = name;

    //Evento para filtrar herramientas al hacer clic
    button.addEventListener('click', function() {
        const allButtons = document.querySelectorAll('.tab-button');
        
        //Remover la clase active y asignarla en función del click 
        allButtons.forEach(btn => btn.classList.remove('active')); 
        button.classList.add('active');

        // Filtra herramientas por el ID de la categoría
        filterTools(id); 
    });

    return button;
}

// Función para filtrar las herramientas mostradas según la categoría seleccionada
function filterTools(categoryId) {
    const cards = document.querySelectorAll('#toolsContainer .card');
    cards.forEach(card => {
        // Obtener el ID de la categoría de cada card
        const cardCategoryId = card.getAttribute('data-category-id'); 
        // Muestra la card si coincide con la categoría seleccionada o si se selecciona "Todas"
        if (categoryId == 0 || cardCategoryId == categoryId) {
            card.style.display = 'flex'; // Muestra la tarjeta
        } else {
            card.style.display = 'none'; // Oculta la tarjeta
        }
    });
}

//Desactiva el drop menu si se encuentra en la pantalla inicial
function disabledDrop() {
    const header = document.querySelector('.header')
    const dropdown = document.querySelector('.nav .dropdown')
    const nodropdown = document.querySelector('.nav .no-drop')

    if (header.classList.contains('inicio')) {
        dropdown.style.display = 'none'
    } else {
        nodropdown.style.display = 'none'
    }
}

//Desactiva el blur que se encuentra en la pantalla inicial
function disableBlur() {
    const tools = document.querySelector('.tools-grid')
    const header = document.querySelector('.header')

    if (header.classList.contains('inicio')) {
        tools.classList.add('blur')
    } else {
        tools.classList.remove('blur')
    }
}

//Llama al menu para dispositivos pequeños
function mobileMenu() {
    const menu = document.querySelector('.menu');
    menu.addEventListener('click', showMenu)
}

//Oculta o muestra un menu en dispositivos pequeños
function showMenu() {
    const navigation = document.querySelector('.nav')
    navigation.classList.toggle('show-menu')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            navigation.classList.remove('show-menu'); // Oculta el menú en pantallas grandes
        } else {
            navigation.classList.remove('show-menu'); // También oculta en pantallas pequeñas por defecto
        }
    });
}

//Menu dropdown para mostrar las categorias
function dropDown() {
    const dropdown = document.querySelector('.dropdown')
    dropdown.addEventListener('click', showCategories)
}

//Mostrar las categorias
function showCategories() {
    const categories = document.querySelector('.categories')
    const rotate = document.querySelector('.icon-tabler-chevron-down')
    categories.classList.toggle('show-list')
    rotate.classList.toggle('rotate')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { 
            categories.classList.remove('show-list'); // Oculta el menú en pantallas grandes
        } else {
            categories.classList.remove('show-list'); // También oculta en pantallas pequeñas por defecto
        }
    });
}