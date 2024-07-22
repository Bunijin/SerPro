import {Product} from '../product.js';

const electronicsCategories = [
    new Product('C001', 'เสื้อเชิ้ตแขนยาว', 'เสื้อเชิ้ตแขนยาวผ้าฝ้ายคุณภาพดี', 100, { size: 'M', color: 'ขาว', material: 'Cotton' }),
    new Product('C002', 'เสื้อเชิ้ตแขนสั้น', 'เสื้อเชิ้ตแขนสั้นลายสก็อต', 120, { size: 'L', color: 'น้ำเงิน', material: 'Cotton' }),
    new Product('C003', 'เสื้อโปโลผ้าเนื้อดี', 'เสื้อโปโลสีพื้นเนื้อดีใส่สบาย', 150, { size: 'M', color: 'เทา', material: 'Polyester' }),
    new Product('C004', 'เสื้อโปโลลายทาง', 'เสื้อโปโลลายทางสำหรับการออกกำลังกาย', 160, { size: 'L', color: 'ดำ', material: 'Polyester' }),
    new Product('C005', 'กางเกงขาสั้นลายดอก', 'กางเกงขาสั้นลายดอกไม้สำหรับฤดูร้อน', 80, { size: 'M', color: 'เขียว', material: 'Cotton' }),
    new Product('C006', 'กางเกงขาสั้นผ้าฝ้าย', 'กางเกงขาสั้นผ้าฝ้ายสบาย', 90, { size: 'L', color: 'ดำ', material: 'Cotton' }),
    new Product('C007', 'กางเกงขายาวฟอร์ม', 'กางเกงขายาวฟอร์มสำหรับการทำงาน', 200, { size: 'M', color: 'กรมท่า', material: 'Wool' }),
    new Product('C008', 'กางเกงขายาวยีนส์', 'กางเกงขายาวยีนส์ผ้านิ่ม', 220, { size: 'L', color: 'น้ำเงิน', material: 'Denim' }),
];

export default electronicsCategories;