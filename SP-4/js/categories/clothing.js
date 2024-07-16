import Product from '../product.js';

const clothingItems = [
    new Product('C001', 'T-shirt', 'Comfortable cotton T-shirt', 100, { size: 'M', color: 'Red', material: 'Cotton' }),
    new Product('C002', 'Polo Shirt', 'Stylish polo shirt', 50, { size: 'L', color: 'Blue', material: 'Polyester' }),
    // Add more clothing items as needed
];

export function loadClothing() {
    const productList = document.getElementById('product-list');
    productList.innerHTML = clothingItems.map(item => `
        <div onclick="showProductDetails('${item.id}')">
            <h3>${item.name}</h3>
            <p>${item.description}</p>
        </div>
    `).join('');
}

export function showProductDetails(id) {
    const product = clothingItems.find(item => item.id === id);
    if (product) {
        document.getElementById('product-list').innerHTML = product.getProductDetails();
    }
}
