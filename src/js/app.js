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
        const URL = '/api/tools'; // URL de la API de herramientas
        const result = await fetch(URL); // Realiza la solicitud
        const tools = await result.json(); // Convierte la respuesta a JSON
        listTools(tools); // Llama a la función para listar herramientas
    } catch (error) {
        console.log(error); // Maneja errores en la solicitud
    }
}

// Función asíncrona para obtener categorías desde la API
async function getCategoriesAPI() {
    try {
        const URL = '/api/category'; // URL de la API de categorías
        const result = await fetch(URL); // Realiza la solicitud
        const categories = await result.json(); // Convierte la respuesta a JSON
        listCategories(categories); // Llama a la función para listar categorías
    } catch (error) {
        console.log(error); // Maneja errores en la solicitud
    }
}

// Función para listar herramientas en el contenedor HTML
function listTools(tools) {
    const toolsContainer = document.querySelector('#toolsContainer'); // Selecciona el contenedor de herramientas

    tools.forEach(tool => {
        const { name, image, description, url, category_id } = tool; // Desestructura los datos de la herramienta

        const toolContainer = document.createElement('div'); // Crea un contenedor para la herramienta
        toolContainer.classList.add('card'); // Añade la clase 'card' para estilos
        toolContainer.setAttribute('data-category-id', category_id); // Almacena el ID de la categoría

        // Crea y añade el nombre de la herramienta
        const toolName = document.createElement('h3');
        toolName.textContent = name;

        // Crea y añade la imagen de la herramienta
        const toolImg = document.createElement('IMG');
        toolImg.loading = 'lazy'; // Activa carga diferida de la imagen
        toolImg.src = `/images/${image}`; // Establece la fuente de la imagen

        // Crea y añade la descripción de la herramienta
        const toolDescription = document.createElement('p');
        toolDescription.textContent = description; // Cambiado a toolDescription

        // Crea y añade el enlace a la herramienta
        const toolLink = document.createElement('a');
        toolLink.href = url; // Establece el enlace
        toolLink.textContent = 'Explorar'; // Texto del enlace
        toolLink.target = '_blank'; // Abre el enlace en una nueva pestaña
        toolLink.classList.add('button'); // Añade clase para estilos

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
    const categoriesContainer = document.querySelector('#categories-container'); // Selecciona el contenedor de categorías
    categoriesContainer.innerHTML = ''; // Limpia el contenido existente

    // Añade un botón para mostrar todas las categorías
    const allButton = createCategoryButton('Todas', 0);
    categoriesContainer.appendChild(allButton);

    // Crea un botón para cada categoría y lo añade al contenedor
    categories.forEach(category => {
        const { id, name } = category;
        const button = createCategoryButton(name, id);
        categoriesContainer.appendChild(button);
    });

    // Establece el botón "Todas" como activo por defecto
    allButton.classList.add('active');
    filterTools(0); // Filtra las herramientas para mostrar todas
}

// Función para crear un botón de categoría
function createCategoryButton(name, id) {
    const button = document.createElement('BUTTON'); // Crea un botón
    button.classList.add('tab-button'); // Añade clase para estilos
    button.setAttribute('data-category-id', id); // Almacena el ID de la categoría
    button.textContent = name; // Establece el texto del botón

    // Añade un evento para filtrar herramientas al hacer clic
    button.addEventListener('click', function() {
        const allButtons = document.querySelectorAll('.tab-button'); // Selecciona todos los botones de categoría
        allButtons.forEach(btn => btn.classList.remove('active')); // Remueve la clase 'active' de todos
        button.classList.add('active'); // Establece 'active' en el botón clicado
        filterTools(id); // Filtra herramientas por el ID de la categoría
    });

    return button; // Retorna el botón creado
}

// Función para filtrar las herramientas mostradas según la categoría seleccionada
function filterTools(categoryId) {
    const cards = document.querySelectorAll('#toolsContainer .card'); // Selecciona todas las tarjetas de herramientas
    cards.forEach(card => {
        const cardCategoryId = card.getAttribute('data-category-id'); // Obtiene el ID de la categoría de cada tarjeta
        // Muestra la tarjeta si coincide con la categoría seleccionada o si se selecciona "Todas"
        if (categoryId == 0 || cardCategoryId == categoryId) {
            card.style.display = 'flex'; // Muestra la tarjeta
        } else {
            card.style.display = 'none'; // Oculta la tarjeta
        }
    });
}

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

function disableBlur() {
    const tools = document.querySelector('.tools-grid')
    const header = document.querySelector('.header')

    if (header.classList.contains('inicio')) {
        tools.classList.add('blur')
    } else {
        tools.classList.remove('blur')
    }
}

function mobileMenu() {
    const menu = document.querySelector('.menu');
    menu.addEventListener('click', showMenu)
}

function showMenu() {
    const navigation = document.querySelector('.nav')
    navigation.classList.toggle('show-menu')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // Cambia este valor según tus necesidades
            navigation.classList.remove('show-menu'); // Oculta el menú en pantallas grandes
        } else {
            navigation.classList.remove('show-menu'); // También oculta en pantallas pequeñas por defecto
        }
    });
}

function dropDown() {
    const dropdown = document.querySelector('.dropdown')
    dropdown.addEventListener('click', showCategories)
}

function showCategories() {
    const categories = document.querySelector('.categories')
    const rotate = document.querySelector('.icon-tabler-chevron-down')
    categories.classList.toggle('show-list')
    rotate.classList.toggle('rotate')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // Cambia este valor según tus necesidades
            categories.classList.remove('show-list'); // Oculta el menú en pantallas grandes
        } else {
            categories.classList.remove('show-list'); // También oculta en pantallas pequeñas por defecto
        }
    });
}