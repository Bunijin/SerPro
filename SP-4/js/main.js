import clothingCategories from './categories/clothing.js';
import electronicsCategories from './categories/electronics.js';

function displayProducts(products, containerId) {
    const container = document.getElementById(containerId);
    if (!container) {
        console.error('Container element not found:', containerId);
        return;
    }
    
    container.innerHTML = '';

    for (let i = 0; i < products.length; i++) {
        container.innerHTML += products[i].getProductDetails();
    }
}

function loadClothing() {
    console.log('Loading clothing products...');
    displayProducts(clothingCategories, 'product-list');
}

function loadElectronics() {
    console.log('Loading electronics products...');
    displayProducts(electronicsCategories, 'product-list');
}

window.loadClothing = loadClothing;
window.loadElectronics = loadElectronics;
