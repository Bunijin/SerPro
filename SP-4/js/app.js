import { loadClothing, showProductDetails as showClothingDetails } from './categories/clothing.js';
import { loadElectronics, showProductDetails as showElectronicsDetails } from './categories/electronics.js';

window.loadClothing = loadClothing;
window.loadElectronics = loadElectronics;
window.showProductDetails = function(id) {
    const clothingItem = document.querySelector('#product-list div[data-type="clothing"]');
    const electronicsItem = document.querySelector('#product-list div[data-type="electronics"]');

    if (clothingItem) {
        showClothingDetails(id);
    } else if (electronicsItem) {
        showElectronicsDetails(id);
    }
};
