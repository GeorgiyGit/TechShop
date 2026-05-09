<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Database\Seeder;

class ProductCharacteristicSeeder extends Seeder
{
    public function run(): void
    {
        $characteristics = [
            'Royal Professional Coffee Maker' => [
                ['name' => 'Type', 'value' => 'Automatic Espresso Machine'],
                ['name' => 'Capacity', 'value' => '2.5 L'],
                ['name' => 'Pressure', 'value' => '15 bar'],
                ['name' => 'Grinder', 'value' => 'Built-in ceramic'],
                ['name' => 'Power', 'value' => '1400 W'],
            ],
            'Surface Go 3' => [
                ['name' => 'Display', 'value' => '10.5" PixelSense (1920x1280)'],
                ['name' => 'Processor', 'value' => 'Intel Pentium Gold 6500Y'],
                ['name' => 'RAM', 'value' => '4 GB'],
                ['name' => 'Storage', 'value' => '64 GB eMMC'],
                ['name' => 'OS', 'value' => 'Windows 11 Home S'],
                ['name' => 'Weight', 'value' => '544 g'],
            ],
            'Microwave Oven' => [
                ['name' => 'Capacity', 'value' => '25 L'],
                ['name' => 'Power', 'value' => '900 W'],
                ['name' => 'Technology', 'value' => 'Inverter'],
                ['name' => 'Turntable Diameter', 'value' => '34 cm'],
                ['name' => 'Color', 'value' => 'Black'],
            ],
            'Wireless Mouse M510' => [
                ['name' => 'Connection', 'value' => 'Wireless (USB receiver)'],
                ['name' => 'Sensor', 'value' => 'Laser'],
                ['name' => 'DPI', 'value' => '1000'],
                ['name' => 'Battery Life', 'value' => '24 months'],
                ['name' => 'Buttons', 'value' => '7'],
            ],
            'iPhone 11' => [
                ['name' => 'Display', 'value' => '6.1" Liquid Retina HD'],
                ['name' => 'Processor', 'value' => 'A13 Bionic'],
                ['name' => 'Camera', 'value' => 'Dual 12 MP (Wide + Ultra Wide)'],
                ['name' => 'Storage', 'value' => '64 GB'],
                ['name' => 'Battery', 'value' => '3110 mAh'],
                ['name' => 'Water Resistance', 'value' => 'IP68'],
            ],
            'Razr 50 Ultra' => [
                ['name' => 'Display', 'value' => '6.9" pOLED 165Hz'],
                ['name' => 'External Display', 'value' => '4" pOLED'],
                ['name' => 'Processor', 'value' => 'Snapdragon 8s Gen 3'],
                ['name' => 'RAM', 'value' => '12 GB'],
                ['name' => 'Storage', 'value' => '512 GB'],
                ['name' => 'Camera', 'value' => '50 MP + 50 MP'],
            ],
            'Moto G86' => [
                ['name' => 'Display', 'value' => '6.67" pOLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Snapdragon 2+ Gen 1'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Storage', 'value' => '256 GB'],
                ['name' => 'Battery', 'value' => '5000 mAh'],
                ['name' => 'Camera', 'value' => '50 MP OIS'],
            ],
            'ZB2951 ErgoRapido' => [
                ['name' => 'Type', 'value' => '2-in-1 Cordless Stick & Handheld'],
                ['name' => 'Power', 'value' => '18 V'],
                ['name' => 'Runtime', 'value' => 'Up to 30 min'],
                ['name' => 'Dustbin Capacity', 'value' => '0.4 L'],
                ['name' => 'Weight', 'value' => '1.4 kg'],
                ['name' => 'Filter', 'value' => 'Washable'],
            ],
            'Power Bank 20000 mAh' => [
                ['name' => 'Capacity', 'value' => '20000 mAh'],
                ['name' => 'Output', 'value' => 'USB-A, USB-C'],
                ['name' => 'Fast Charging', 'value' => '22.5 W'],
                ['name' => 'Weight', 'value' => '450 g'],
            ],
            'Refrigerator' => [
                ['name' => 'Type', 'value' => 'Top Freezer'],
                ['name' => 'Total Capacity', 'value' => '268 L'],
                ['name' => 'Energy Class', 'value' => 'A++'],
                ['name' => 'Noise Level', 'value' => '40 dB'],
                ['name' => 'Color', 'value' => 'White'],
            ],
            'Complete C3 Vacuum' => [
                ['name' => 'Type', 'value' => 'Canister'],
                ['name' => 'Power', 'value' => '890 W'],
                ['name' => 'Bag Capacity', 'value' => '4.5 L'],
                ['name' => 'Noise Level', 'value' => '73 dB'],
                ['name' => 'Cable Length', 'value' => '7.5 m'],
                ['name' => 'Filter', 'value' => 'HEPA AirClean'],
            ],
            'Watch Series 6' => [
                ['name' => 'Display', 'value' => '1.78" OLED Always-On Retina'],
                ['name' => 'Chip', 'value' => 'Apple S6'],
                ['name' => 'Sensors', 'value' => 'Blood oxygen, ECG, Heart rate'],
                ['name' => 'Water Resistance', 'value' => '50 m (WR50)'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi, Bluetooth 5.0, NFC'],
            ],
            '8S3P Molicel Battery Pack' => [
                ['name' => 'Configuration', 'value' => '8S3P'],
                ['name' => 'Cell Brand', 'value' => 'Molicel'],
                ['name' => 'Use Case', 'value' => 'Backup power and storage systems'],
                ['name' => 'Capacity', 'value' => 'High-capacity pack'],
                ['name' => 'Battery Type', 'value' => 'Lithium-ion'],
            ],
            'SE-G5.1 Pro-B Battery' => [
                ['name' => 'Model', 'value' => 'SE-G5.1 Pro-B'],
                ['name' => 'Type', 'value' => 'Modular lithium battery'],
                ['name' => 'Application', 'value' => 'Solar energy storage'],
                ['name' => 'Installation', 'value' => 'Stackable modular system'],
            ],
            'Langzeit Battery Pack' => [
                ['name' => 'Series', 'value' => 'Langzeit'],
                ['name' => 'Type', 'value' => 'Long-life battery pack'],
                ['name' => 'Use Case', 'value' => 'Backup and extended runtime'],
                ['name' => 'Battery Type', 'value' => 'Rechargeable'],
            ],
            'USB 2.0 Cable' => [
                ['name' => 'Standard', 'value' => 'USB 2.0'],
                ['name' => 'Connector', 'value' => 'USB-A to USB-A'],
                ['name' => 'Use Case', 'value' => 'Data transfer and charging'],
                ['name' => 'Length', 'value' => 'Varies by pack'],
            ],
            'EOS R100' => [
                ['name' => 'Sensor', 'value' => 'APS-C CMOS'],
                ['name' => 'Mount', 'value' => 'Canon RF'],
                ['name' => 'Autofocus', 'value' => 'Dual Pixel CMOS AF'],
                ['name' => 'Video', 'value' => '4K recording'],
                ['name' => 'Display', 'value' => '3.0" LCD'],
            ],
            'X5' => [
                ['name' => 'Capture', 'value' => '360-degree video'],
                ['name' => 'Stabilization', 'value' => 'FlowState Stabilization'],
                ['name' => 'Use Case', 'value' => 'Action and travel content'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi, Bluetooth'],
            ],
            'DV150F' => [
                ['name' => 'Type', 'value' => 'Compact digital camera'],
                ['name' => 'Display', 'value' => 'Front LCD'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi'],
                ['name' => 'Use Case', 'value' => 'Everyday photography'],
            ],
            'Air Conditioner' => [
                ['name' => 'Type', 'value' => 'Split air conditioner'],
                ['name' => 'Use Case', 'value' => 'Room cooling'],
                ['name' => 'Controls', 'value' => 'Remote control'],
                ['name' => 'Noise Level', 'value' => 'Low-noise operation'],
            ],
            'Studio Display' => [
                ['name' => 'Display Size', 'value' => '27-inch class'],
                ['name' => 'Resolution', 'value' => '5K Retina'],
                ['name' => 'Design', 'value' => 'Aluminium enclosure'],
                ['name' => 'Use Case', 'value' => 'Creative work and productivity'],
            ],
            'AirPods 3' => [
                ['name' => 'Type', 'value' => 'Wireless earbuds'],
                ['name' => 'Audio', 'value' => 'Spatial Audio support'],
                ['name' => 'Charging', 'value' => 'MagSafe compatible case'],
                ['name' => 'Use Case', 'value' => 'Music, calls, and media'],
            ],
            'JLab Earbuds' => [
                ['name' => 'Type', 'value' => 'Wireless earbuds'],
                ['name' => 'Use Case', 'value' => 'Everyday listening'],
                ['name' => 'Connectivity', 'value' => 'Bluetooth'],
                ['name' => 'Portability', 'value' => 'Pocket-friendly case'],
            ],
            'PlayStation 4 Fat' => [
                ['name' => 'Generation', 'value' => 'PlayStation 4'],
                ['name' => 'Storage', 'value' => 'Varies by model'],
                ['name' => 'Use Case', 'value' => 'Console gaming'],
                ['name' => 'Media', 'value' => 'Streaming and Blu-ray playback'],
            ],
            'PlayStation 4 Pro' => [
                ['name' => 'Generation', 'value' => 'PlayStation 4 Pro'],
                ['name' => 'Performance', 'value' => 'Enhanced graphics mode'],
                ['name' => 'Use Case', 'value' => '4K-capable console gaming'],
                ['name' => 'Media', 'value' => 'Streaming and Blu-ray playback'],
            ],
            'Silent Pro M2 Power Supply' => [
                ['name' => 'Type', 'value' => 'ATX power supply'],
                ['name' => 'Focus', 'value' => 'Quiet operation'],
                ['name' => 'Use Case', 'value' => 'Desktop builds'],
                ['name' => 'Stability', 'value' => 'Reliable output'],
            ],
            'Cobra Power Supply' => [
                ['name' => 'Type', 'value' => 'ATX power supply'],
                ['name' => 'Use Case', 'value' => 'Budget desktop builds'],
                ['name' => 'Efficiency', 'value' => 'Standard'],
                ['name' => 'Stability', 'value' => 'Basic reliable output'],
            ],
            'Bang SE' => [
                ['name' => 'Type', 'value' => 'Bluetooth speaker'],
                ['name' => 'Use Case', 'value' => 'Portable listening'],
                ['name' => 'Battery', 'value' => 'Long runtime'],
                ['name' => 'Portability', 'value' => 'Carry-friendly design'],
            ],
            'iPad 9' => [
                ['name' => 'Display', 'value' => '10.2-inch Retina'],
                ['name' => 'Chip', 'value' => 'A13 Bionic'],
                ['name' => 'Use Case', 'value' => 'Everyday tablet use'],
                ['name' => 'Accessories', 'value' => 'Apple Pencil support'],
            ],
            'Galaxy Tab S11' => [
                ['name' => 'Display', 'value' => 'Large AMOLED class panel'],
                ['name' => 'Use Case', 'value' => 'Productivity and media'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi, Bluetooth'],
                ['name' => 'Performance', 'value' => 'Multitasking-friendly'],
            ],
            'Intuos Pro Large' => [
                ['name' => 'Type', 'value' => 'Pen tablet'],
                ['name' => 'Size', 'value' => 'Large active area'],
                ['name' => 'Use Case', 'value' => 'Illustration and design'],
                ['name' => 'Input', 'value' => 'Pressure-sensitive pen'],
            ],
            'WAN282ECO' => [
                ['name' => 'Type', 'value' => 'Front-loading washing machine'],
                ['name' => 'Use Case', 'value' => 'Household laundry'],
                ['name' => 'Efficiency', 'value' => 'Energy-efficient operation'],
                ['name' => 'Programs', 'value' => 'Multiple wash programs'],
            ],
            'Washing Machine' => [
                ['name' => 'Type', 'value' => 'Washing machine'],
                ['name' => 'Use Case', 'value' => 'Daily laundry'],
                ['name' => 'Controls', 'value' => 'Simple program selection'],
                ['name' => 'Capacity', 'value' => 'Standard household load'],
            ],
            'ZWT5105' => [
                ['name' => 'Type', 'value' => 'Top-loading washing machine'],
                ['name' => 'Use Case', 'value' => 'Compact laundry setup'],
                ['name' => 'Controls', 'value' => 'Basic control panel'],
                ['name' => 'Capacity', 'value' => 'Small to medium load'],
            ],
            'Linea Mini' => [
                ['name' => 'Type', 'value' => 'Professional espresso machine'],
                ['name' => 'Boiler', 'value' => 'Heat exchanger'],
                ['name' => 'Group Count', 'value' => 'Single group'],
                ['name' => 'Pressure', 'value' => '9 bar'],
                ['name' => 'Material', 'value' => 'Stainless steel'],
            ],
            'PC-KA 1191' => [
                ['name' => 'Type', 'value' => 'Automatic espresso machine'],
                ['name' => 'Grinder', 'value' => 'Built-in with adjustable settings'],
                ['name' => 'Froth Function', 'value' => 'One-touch steam wand'],
                ['name' => 'Compact Design', 'value' => 'Suitable for small kitchens'],
            ],
            'ROG Zephyrus G15' => [
                ['name' => 'Processor', 'value' => 'Intel Core i9 latest gen'],
                ['name' => 'GPU', 'value' => 'NVIDIA RTX 4090'],
                ['name' => 'Display', 'value' => '15.6" 240Hz QHD'],
                ['name' => 'RAM', 'value' => '32 GB DDR5'],
                ['name' => 'Storage', 'value' => '1TB NVMe SSD'],
                ['name' => 'Cooling', 'value' => 'Advanced ROG Cooling'],
            ],
            'Ryzen 5 Laptop' => [
                ['name' => 'Processor', 'value' => 'AMD Ryzen 5'],
                ['name' => 'Display', 'value' => '15.6" FHD'],
                ['name' => 'RAM', 'value' => '8 GB DDR4'],
                ['name' => 'Storage', 'value' => '256GB SSD'],
                ['name' => 'Graphics', 'value' => 'Integrated Radeon'],
            ],
            'ThinkPad T14s Gen 2' => [
                ['name' => 'Processor', 'value' => 'Intel Core i7 11th Gen'],
                ['name' => 'Display', 'value' => '14" FHD IPS'],
                ['name' => 'RAM', 'value' => '16 GB LPDDR4'],
                ['name' => 'Storage', 'value' => '512GB SSD'],
                ['name' => 'Build Quality', 'value' => 'Military-grade tested'],
                ['name' => 'Keyboard', 'value' => 'Iconic ThinkPad layout'],
            ],
            'MacBook Pro 15' => [
                ['name' => 'Chip', 'value' => 'Apple M1 Pro/Max'],
                ['name' => 'Display', 'value' => '15.3" Liquid Retina XDR'],
                ['name' => 'RAM', 'value' => 'Up to 32GB unified memory'],
                ['name' => 'Storage', 'value' => 'Up to 2TB SSD'],
                ['name' => 'Battery', 'value' => 'Up to 17 hours'],
            ],
            'iPhone 11 Pro Max' => [
                ['name' => 'Display', 'value' => '6.5" Super Retina XS Max OLED'],
                ['name' => 'Processor', 'value' => 'A13 Bionic'],
                ['name' => 'Camera', 'value' => 'Triple 12MP + TOF'],
                ['name' => 'Night Mode', 'value' => 'Advanced Night Mode'],
                ['name' => 'Water Resistance', 'value' => 'IP68'],
            ],
            'iPhone 12' => [
                ['name' => 'Display', 'value' => '6.1" Super Retina XS OLED'],
                ['name' => 'Processor', 'value' => 'A14 Bionic'],
                ['name' => '5G', 'value' => 'Sub-6 GHz 5G'],
                ['name' => 'Camera', 'value' => 'Dual 12MP'],
                ['name' => 'Ceramic Shield', 'value' => '4x drop protection'],
            ],
            'iPhone 13' => [
                ['name' => 'Display', 'value' => '6.1" Super Retina XS OLED'],
                ['name' => 'Processor', 'value' => 'A15 Bionic'],
                ['name' => 'Camera', 'value' => 'Dual 12MP + Cinematic Mode'],
                ['name' => 'Battery', 'value' => 'Improved all-day battery'],
                ['name' => '5G', 'value' => 'mmWave 5G support'],
            ],
            'iPhone 15 Pro' => [
                ['name' => 'Processor', 'value' => 'A17 Pro'],
                ['name' => 'Camera', 'value' => 'Pro camera system with Photonic Engine'],
                ['name' => 'Design', 'value' => 'Titanium'],
                ['name' => 'Display', 'value' => '6.1" Super Retina XS OLED'],
                ['name' => 'USB-C', 'value' => 'USB-C with Thunderbolt support'],
            ],
            'iPhone 16 Pro' => [
                ['name' => 'Processor', 'value' => 'A18 Pro'],
                ['name' => 'Camera', 'value' => 'Advanced pro camera system'],
                ['name' => 'Display', 'value' => '6.3" Super Retina display'],
                ['name' => 'Features', 'value' => 'Latest AI capabilities'],
                ['name' => 'Battery', 'value' => 'Extended battery life'],
            ],
            'iPhone 7 Plus' => [
                ['name' => 'Display', 'value' => '5.5" Retina HD'],
                ['name' => 'Processor', 'value' => 'A10 Fusion'],
                ['name' => 'Camera', 'value' => 'Dual 12MP telephoto'],
                ['name' => 'Water Resistance', 'value' => 'IP67'],
                ['name' => 'Headphone Jack', 'value' => 'Lightning only'],
            ],
            'iPhone X' => [
                ['name' => 'Display', 'value' => '5.8" Super Retina OLED'],
                ['name' => 'Processor', 'value' => 'A11 Bionic'],
                ['name' => 'Face ID', 'value' => 'TrueDepth camera system'],
                ['name' => 'Camera', 'value' => 'Dual 12MP + telephoto'],
                ['name' => 'Design', 'value' => 'Notch design introduction'],
            ],
            'GM 8 Go' => [
                ['name' => 'OS', 'value' => 'Android Go'],
                ['name' => 'Display', 'value' => '6.5" IPS LCD'],
                ['name' => 'Processor', 'value' => 'Quad-core'],
                ['name' => 'RAM', 'value' => '2GB LPDDR3'],
                ['name' => 'Storage', 'value' => '32GB expandable'],
            ],
            'Galaxy M22' => [
                ['name' => 'Display', 'value' => '6.5" IPS 90Hz'],
                ['name' => 'Processor', 'value' => 'Helio G80'],
                ['name' => 'Battery', 'value' => '5000mAh'],
                ['name' => 'Camera', 'value' => 'Quad camera setup'],
                ['name' => 'Design', 'value' => 'Waterdrop notch'],
            ],
            'Galaxy S23 FE' => [
                ['name' => 'Processor', 'value' => 'Snapdragon 8 Gen 1'],
                ['name' => 'Display', 'value' => '6.4" Dynamic AMOLED 120Hz'],
                ['name' => 'Camera', 'value' => 'Triple rear + ultra-wide'],
                ['name' => 'Battery', 'value' => '4500mAh fast charging'],
                ['name' => 'Design', 'value' => 'Metal frame with glass back'],
            ],
            'Galaxy S24' => [
                ['name' => 'Processor', 'value' => 'Snapdragon 8 Gen 3'],
                ['name' => 'Display', 'value' => '6.2" Dynamic AMOLED 2X 120Hz'],
                ['name' => 'Camera', 'value' => 'Advanced AI photography'],
                ['name' => 'AI Features', 'value' => 'Galaxy AI suite'],
                ['name' => 'Battery', 'value' => '4000mAh with fast charging'],
            ],
            'Galaxy Z Fold' => [
                ['name' => 'Type', 'value' => 'Foldable smartphone'],
                ['name' => 'Main Display', 'value' => '7.6" AMOLED folding'],
                ['name' => 'Cover Display', 'value' => '6.2" AMOLED'],
                ['name' => 'Processor', 'value' => 'Snapdragon 8 series'],
                ['name' => 'RAM', 'value' => '12GB minimum'],
            ],
            'Xperia XA2 Ultra' => [
                ['name' => 'Display', 'value' => '6" FHD IPS'],
                ['name' => 'Processor', 'value' => 'Helio F22'],
                ['name' => 'Dual Front Camera', 'value' => '16MP + 8MP ultra-wide'],
                ['name' => 'Battery', 'value' => '3580mAh'],
                ['name' => 'Selfie Focus', 'value' => 'Front camera optimized'],
            ],
            'Redmi A5' => [
                ['name' => 'Display', 'value' => '5.09" IPS LCD'],
                ['name' => 'Processor', 'value' => 'Qualcomm Snapdragon 439'],
                ['name' => 'RAM', 'value' => '2GB LPDDR3'],
                ['name' => 'Storage', 'value' => '16GB MicroSD expandable'],
                ['name' => 'Battery', 'value' => '3000mAh'],
            ],
            'Crosswave Select C3 3551N' => [
                ['name' => 'Type', 'value' => 'Multi-surface wet-dry vacuum'],
                ['name' => 'Dual Tank', 'value' => 'Separate clean and dirty water'],
                ['name' => 'Surfaces', 'value' => 'Carpet and hard floors'],
                ['name' => 'Power', 'value' => 'Strong suction'],
            ],
            'DEEBOT T10 Plus Ozmo' => [
                ['name' => 'Type', 'value' => 'Robot vacuum + mop'],
                ['name' => 'Navigation', 'value' => 'Smart mapping'],
                ['name' => 'App Control', 'value' => 'Full app integration'],
                ['name' => 'Mopping', 'value' => 'Wet mopping capability'],
            ],
            'S5 Max' => [
                ['name' => 'Type', 'value' => 'Robot vacuum'],
                ['name' => 'Mapping', 'value' => 'Multi-level mapping'],
                ['name' => 'Dustbin', 'value' => 'Large capacity'],
                ['name' => 'Scheduling', 'value' => 'Advanced scheduling'],
            ],
            'X-Force Flex' => [
                ['name' => 'Type', 'value' => 'Cordless stick vacuum'],
                ['name' => 'Flexibility', 'value' => 'Flexible stick design'],
                ['name' => 'Weight', 'value' => 'Lightweight'],
                ['name' => 'Runtime', 'value' => 'Extended battery'],
            ],
            'X-Plorer Serie 75S' => [
                ['name' => 'Type', 'value' => 'Cordless vacuum'],
                ['name' => 'Air Flow', 'value' => 'Advanced air flow technology'],
                ['name' => 'Suction Levels', 'value' => 'Adjustable power modes'],
                ['name' => 'Runtime', 'value' => 'Long battery life'],
                ['name' => 'Filtration', 'value' => 'Advanced filter system'],
            ],
            'Vacuum S20' => [
                ['name' => 'Type', 'value' => 'Robot vacuum'],
                ['name' => 'Mapping', 'value' => 'Smart navigation'],
                ['name' => 'Efficiency', 'value' => 'Reliable cleaning patterns'],
                ['name' => 'Design', 'value' => 'Compact form factor'],
            ],
            'Z70 Robot Vacuum' => [
                ['name' => 'Type', 'value' => 'Robot vacuum'],
                ['name' => 'Budget-Friendly', 'value' => 'Affordable option'],
                ['name' => 'Automation', 'value' => 'Basic smart features'],
                ['name' => 'Noise Level', 'value' => 'Quiet operation'],
            ],
            'Vivoactive 6' => [
                ['name' => 'Display', 'value' => 'AMOLED touchscreen'],
                ['name' => 'Sports Modes', 'value' => '30+ sport activities'],
                ['name' => 'Health Metrics', 'value' => 'Comprehensive tracking'],
                ['name' => 'Battery', 'value' => 'Multi-day battery life'],
                ['name' => 'Target Audience', 'value' => 'Fitness enthusiasts'],
            ],
        ];

        $productIds = Product::query()->pluck('id', 'name');

        foreach ($characteristics as $productName => $items) {
            $productId = $productIds[$productName] ?? null;

            if ($productId === null) {
                continue;
            }

            foreach ($items as $position => $item) {
                ProductCharacteristic::updateOrCreate(
                    [
                        'product_id' => $productId,
                        'name' => $item['name'],
                    ],
                    [
                        'value' => $item['value'],
                        'position' => $position + 1,
                    ]
                );
            }
        }
    }
}
