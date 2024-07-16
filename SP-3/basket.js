function basket(customer_id) {
    let order_number = 0;
    let items = [];
    return function addItem(item_id, item_amount) { // ฟังก์ชันภายในที่เป็น Closure
        order_number++;
        items.push({ order_number, item_id, item_amount });
        return `รหัสลูกค้า ${customer_id} - ลำดับรายการ ${order_number}, รหัสสินค้า ${item_id}, จำนวนสินค้า ${item_amount} ชิ้น`;
    };
}

const customer_basket = basket(58);

console.log(customer_basket(41, 23));
console.log(customer_basket(68, 17));
console.log(customer_basket(25, 2));