import {Product} from '../product.js';

const electronicsCategories = [
    new Product('E001', 'ทีวี 42 นิ้ว', 'ทีวีสมาร์ต 42 นิ้ว ความละเอียด 4K', 30, { brand: 'Samsung', resolution: '4K' }),
    new Product('E002', 'ทีวี 55 นิ้ว', 'ทีวีสมาร์ต 55 นิ้ว ความละเอียด Full HD', 25, { brand: 'LG', resolution: 'Full HD' }),
    new Product('E003', 'โน้ตบุ๊ก Intel i5', 'โน้ตบุ๊กประสิทธิภาพสูง พร้อมหน่วยประมวลผล Intel i5', 20, { brand: 'Dell', processor: 'Intel i5', ram: '8GB' }),
    new Product('E004', 'โน้ตบุ๊ก AMD Ryzen 5', 'โน้ตบุ๊กพร้อมหน่วยประมวลผล AMD Ryzen 5', 15, { brand: 'HP', processor: 'AMD Ryzen 5', ram: '16GB' }),
    new Product('E005', 'คอมพิวเตอร์เดสก์ท็อป', 'คอมพิวเตอร์เดสก์ท็อปสำหรับการทำงาน', 10, { brand: 'Asus', processor: 'Intel i7', ram: '16GB' }),
    new Product('E006', 'คอมพิวเตอร์ All-in-One', 'คอมพิวเตอร์ All-in-One สำหรับใช้ในบ้าน', 8, { brand: 'Lenovo', processor: 'Intel i3', ram: '8GB' }),
    new Product('E007', 'ปริ้นเตอร์เลเซอร์', 'ปริ้นเตอร์เลเซอร์ขาว-ดำ', 12, { brand: 'Brother', type: 'Laser', color: 'Black & White' }),
    new Product('E008', 'ปริ้นเตอร์อิงค์เจ็ท', 'ปริ้นเตอร์อิงค์เจ็ทสำหรับพิมพ์สี', 18, { brand: 'Canon', type: 'Inkjet', color: 'Color' }),
];

export default electronicsCategories;
