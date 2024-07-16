import Product from '../product.js';

const electronicItems = [
    new Product('E001', 'TV', '42 inch Smart TV', 30, { brand: 'Samsung', resolution: '4K' }),
    new Product('E002', 'Laptop', 'High-performance laptop', 20, { brand: 'Dell', processor: 'Intel i7', ram: '16GB' }),
    // Add more electronic items as needed
];

export function loadElectronics() {
    const productList = document.getElementById('product-list');
    productList.innerHTML = electronicItems.map(item => `
        <div onclick="showProductDetails('${item.id}')">
            <h3>${item.name}</h3>
            <p>${item.description}</p>
        </div>
    `).join('');
}

export function showProductDetails(id) {
    const product = electronicItems.find(item => item.id === id);
    if (product) {
        document.getElementById('product-list').innerHTML = product.getProductDetails();
    }
}
