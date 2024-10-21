document.addEventListener('DOMContentLoaded', function () {
    getCategories();
    mobileMenu();
    dropDown();
    disabledDrop();
    disableBlur();
});


function getCategories() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const toolsContainer = document.getElementById('toolsContainer');

    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const categoryId = this.getAttribute('data-category-id');
            
            // Remove 'active' class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Add 'active' class to clicked button
            this.classList.add('active');

            // Get all tool cards
            const cards = toolsContainer.querySelectorAll('.card');

            // Filter cards based on selected category
            cards.forEach(card => {
                const cardCategoryId = card.getAttribute('data-category-id');
                if (categoryId == 0 || cardCategoryId == categoryId) {
                    card.style.display = 'flex'; // Mostrar
                } else {
                    card.style.display = 'none'; // Ocultar
                }
            });
        });
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