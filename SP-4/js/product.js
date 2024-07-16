class Product {
    constructor(id, name, description, stock, properties) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.stock = stock;
        this.properties = properties;
    }

    getProductDetails() {
        return `
            <div>
                <h2>${this.name}</h2>
                <p>ID: ${this.id}</p>
                <p>${this.description}</p>
                <p>Stock: ${this.stock}</p>
                <p>Properties: ${this.formatProperties()}</p>
            </div>
        `;
    }

    formatProperties() {
        return Object.entries(this.properties).map(([key, value]) => `${key}: ${value}`).join(', ');
    }
}

export default Product;
