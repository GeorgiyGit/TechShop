<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id', 'slug');

        $products = [
            [
                'slug' => 'saeco-royal-professional',
                'category_slug' => 'home-appliances',
                'brand' => 'Saeco',
                'name' => 'Royal Professional Coffee Maker',
                'short_description' => 'Fully automatic espresso machine with built-in ceramic grinder, adjustable grind settings, and integrated milk frother for cafe-quality espresso at home.',
                'description' => 'The Saeco Royal Professional is a fully automatic espresso machine designed for coffee lovers who demand complete control over every cup. Its built-in ceramic grinder with adjustable grind settings lets you tailor the coarseness to your preferred beans, while the integrated milk frother delivers velvety microfoam for lattes and cappuccinos at the touch of a button. The large 2.5-litre water tank and spacious bean hopper mean fewer refills during busy mornings. With a robust stainless steel body and intuitive control panel, the Royal Professional combines a professional café experience with the convenience of home brewing.',
                'price' => 899.99,
                'sort_order' => 10,
                'popularity_score' => 0,
                'stock_left' => 9
            ],
            [
                'slug' => 'microsoft-surface-go-3',
                'category_slug' => 'laptops',
                'brand' => 'Microsoft',
                'name' => 'Surface Go 3',
                'short_description' => 'Compact 2-in-1 with a 10.5-inch PixelSense touchscreen, Intel processor, and Windows 11 - ideal for students and on-the-go professionals.',
                'description' => 'The Microsoft Surface Go 3 is a compact, lightweight 2-in-1 laptop built for students, commuters, and creative professionals who need portability without sacrificing productivity. Its 10.5-inch PixelSense touchscreen delivers sharp, vibrant visuals at 1920×1280 resolution with a 3:2 aspect ratio ideal for reading and writing. Powered by the Intel Pentium Gold 6500Y processor and running Windows 11, it handles everyday tasks, Office apps, and web browsing with ease. The precision keyboard and Surface Pen support make note-taking and sketching natural. At just 544 grams, it slips effortlessly into a backpack, and the all-day battery keeps you going from the first lecture to the last meeting.',
                'price' => 629.99,
                'sort_order' => 20,
                'popularity_score' => 0,
                'stock_left' => 12
            ],
            [
                'slug' => 'panasonic-microwave-oven',
                'category_slug' => 'home-appliances',
                'brand' => 'Panasonic',
                'name' => 'Microwave Oven',
                'short_description' => '25-litre microwave with Inverter technology for even heating, 900 W output, and a digital touch panel with auto-cook programs for everyday use.',
                'description' => 'The Panasonic Microwave Oven brings intelligent cooking technology into your kitchen with its patented Inverter heating system, which delivers a continuous, consistent power stream instead of the stop-start cycling of traditional microwaves. The result is food that heats evenly from edge to edge, with no overcooked corners or cold centres. Its 25-litre capacity easily accommodates large dinner plates and family-sized portions, while the 900 W power output ensures fast, efficient results across reheating, defrosting, and cooking programs. A turntable-free flat floor design makes cleaning simple, and the intuitive digital touch panel guides you through auto-cook menus for popular dishes with minimal effort.',
                'price' => 219.99,
                'sort_order' => 30,
                'popularity_score' => 0,
                'stock_left' => 4
            ],
            [
                'slug' => 'logitech-m510',
                'category_slug' => 'accessories',
                'brand' => 'Logitech',
                'name' => 'Wireless Mouse M510',
                'short_description' => 'Ergonomic wireless mouse with 24-month battery life, laser tracking on any surface, and a plug-and-forget Unifying nano-receiver.', 'description' => 'The Logitech Wireless Mouse M510 is engineered for all-day comfort and multi-surface precision. Its sculpted, right-handed contour fits naturally in the hand, reducing wrist fatigue during long work and browsing sessions. The advanced laser sensor tracks reliably on virtually any surface - including glass - without the need for a mouse pad. A plug-and-forget Unifying nano-receiver lets you connect wirelessly without losing the tiny adapter between uses. Two AA batteries power the M510 for up to 24 months, making it one of the most energy-efficient wireless mice available. Seven programmable buttons, including back/forward controls and a hyper-fast scroll wheel, keep everything close at hand.',
                'price' => 34.99,
                'sort_order' => 40,
                'popularity_score' => 0,
                'stock_left' => 17
            ],
            [
                'slug' => 'iphone-11',
                'category_slug' => 'smartphones',
                'brand' => 'Apple',
                'name' => 'iPhone 11',
                'short_description' => 'Reliable smartphone with a 6.1-inch Liquid Retina display, A13 Bionic chip, dual 12 MP cameras with Night mode, and IP68 water resistance.',
                'description' => 'The Apple iPhone 11 remains one of the most well-rounded smartphones Apple has released, combining reliable everyday performance with a dual-camera system that punches well above its price. The 6.1-inch Liquid Retina HD display is bright, colour-accurate, and protected by Ceramic Shield glass - four times tougher than previous generations. Under the hood, the A13 Bionic chip handles demanding apps, games, and video editing with ease, and the Neural Engine powers computational photography features like Portrait mode, Smart HDR, and Night mode. Splash, water, and dust resistance rated IP68 means it can survive accidental drops in puddles, and the long-lasting battery easily sees through a full day of heavy use.',
                'price' => 479.99,
                'sort_order' => 50,
                'popularity_score' => 0,
                'stock_left' => 0
            ],
            [
                'slug' => 'motorola-razr-50-ultra',
                'category_slug' => 'smartphones',
                'brand' => 'Motorola',
                'name' => 'Razr 50 Ultra',
                'short_description' => 'Premium foldable phone with a 6.9-inch 165Hz display, 4-inch external screen, Snapdragon 8s Gen 3 chip, and dual 50 MP cameras.',
                'description' => 'The Motorola Razr 50 Ultra redefines what a foldable phone can be, pairing a large 4-inch external pOLED display - the biggest cover screen in its class - with a flagship-grade 6.9-inch main display running at 165Hz for silky-smooth scrolling. The Snapdragon 8s Gen 3 chipset delivers desktop-class performance in a pocketable form factor, handling everything from console-quality gaming to 4K video recording without breaking a sweat. The dual 50 MP camera system produces stunning detail and wide dynamic range, with Motorola\'s AI scene optimisation ensuring great shots in any lighting. When folded, the compact shell fits in the smallest pockets and clutches, making it the ultimate choice for those who refuse to compromise on either style or power.',
                'price' => 999.99,
                'sort_order' => 60,
                'popularity_score' => 0,
                'stock_left' => 3
            ],
            [
                'slug' => 'motorola-g86',
                'category_slug' => 'smartphones',
                'brand' => 'Motorola',
                'name' => 'Moto G86',
                'short_description' => 'Mid-range smartphone with a 6.67-inch 120Hz pOLED display, 50 MP OIS camera, 5000 mAh battery, and 33W TurboPower fast charging.',
                'description' => 'The Motorola Moto G86 is designed for users who want a premium experience at a mid-range price. Its 6.67-inch pOLED display with 120Hz refresh rate makes every swipe and scroll feel fluid, while deep blacks and vivid colours bring photos, videos, and games to life. The 50 MP OIS main camera stabilises handheld shots and low-light captures, so you get clear, crisp photos even in challenging conditions. A 5000 mAh battery with 33W TurboPower charging provides all-day endurance and quick top-ups when you need them. With a water-resistant design, stereo speakers, and a clean near-stock Android experience, the Moto G86 is a sensible everyday companion that doesn\'t cut corners where it counts.',
                'price' => 289.99,
                'sort_order' => 70,
                'popularity_score' => 0,
                'stock_left' => 8
            ],
            [
                'slug' => 'electrolux-zb-2951',
                'category_slug' => 'home-appliances',
                'brand' => 'Electrolux',
                'name' => 'ZB2951 ErgoRapido',
                'short_description' => 'Lightweight cordless 2-in-1 stick vacuum with automatic power boost, up to 30 min runtime, and a detachable handheld unit for versatile cleaning.',
                'description' => 'The Electrolux ZB2951 ErgoRapido is a versatile 2-in-1 cordless vacuum that transforms from a full-size stick vacuum into a compact handheld in seconds - simply detach the handheld unit to tackle stairs, upholstery, and car interiors with ease. Its Automatic Boost technology detects carpet and instantly increases suction power, then reduces it on hard floors to conserve battery. Up to 30 minutes of cordless runtime gives you the freedom to clean the whole home on a single charge. The slim swivel nozzle glides effortlessly around chair legs and under furniture, and the washable filter keeps running costs low. Lightweight at under 1.5 kg, the ErgoRapido stores neatly on its charging wall mount, always ready for quick everyday cleanups.',
                'price' => 249.99,
                'sort_order' => 115,
                'popularity_score' => 0,
                'stock_left' => 11
            ],
            [
                'slug' => 'power-bank-20000',
                'category_slug' => 'power-batteries',
                'brand' => 'Baseus',
                'name' => 'Power Bank 20000 mAh',
                'short_description' => 'High-capacity 20000 mAh power bank with 22.5W fast charging, three simultaneous outputs, and a precise digital battery indicator.',
                'description' => 'The Baseus 20000 mAh Power Bank is the travel companion that keeps all your devices topped up through long journeys, outdoor adventures, and multi-day trips. Its massive 20000 mAh capacity can fully recharge a smartphone four to five times or keep a tablet running for an entire day. Two USB-A outputs and a USB-C port allow simultaneous charging of three devices at once, so your phone, earbuds, and smartwatch can all charge together. The 22.5W fast-charging support significantly cuts down charging times compared to standard power banks, and the built-in digital display shows exact battery percentage so you always know how much power you have left. Compact enough for a jacket pocket, yet powerful enough to handle every device you carry.',
                'price' => 49.99,
                'sort_order' => 90,
                'popularity_score' => 0,
                'stock_left' => 5
            ],
            [
                'slug' => 'snaige-refrigerator',
                'category_slug' => 'home-appliances',
                'brand' => 'Snaige',
                'name' => 'Refrigerator',
                'short_description' => 'Energy-efficient top-freezer refrigerator with 268 L capacity, A++ energy rating, adjustable shelves, and whisper-quiet 40 dB operation.',
                'description' => 'The Snaige Refrigerator combines classic reliability with a modern, clean interior design that maximises usable storage space. Its 268-litre total capacity across the fridge and freezer compartments provides ample room for a family\'s weekly shop, while adjustable glass shelves and door bins let you arrange food exactly as you like. An A++ energy rating keeps electricity costs low over years of daily use, and whisper-quiet 40 dB operation ensures it never disturbs a peaceful kitchen. The white finish and minimalist styling complement contemporary and traditional kitchens alike. Built with durable Snaige components, this refrigerator is engineered for long-term performance and ease of maintenance.',
                'price' => 549.99,
                'sort_order' => 100,
                'popularity_score' => 0,
                'stock_left' => 2
            ],
            [
                'slug' => 'miele-c3',
                'category_slug' => 'home-appliances',
                'brand' => 'Miele',
                'name' => 'Complete C3 Vacuum',
                'short_description' => 'Premium canister vacuum with a powerful Vortex Motor, HEPA AirClean filter, 4.5 L dust bag, 7.5 m cable, and 20-year build quality.',
                'description' => 'The Miele Complete C3 is a premium canister vacuum cleaner that sets the standard for thorough, hygienic home cleaning. Its 890 W Miele-manufactured Vortex Motor generates powerful, consistent suction that lifts deep-seated dust, pet hair, and allergens from carpets, hard floors, and upholstery. The AirClean HEPA filter captures 99.95% of fine particles including dust mites and pollen, making it an ideal choice for allergy sufferers. A 7.5-metre cable radius and four smooth gliding castors allow effortless manoeuvrability around furniture and between rooms. The 4.5-litre dust bag extends the time between changes, and the integrated filter-change indicator reminds you when maintenance is needed. Miele builds the C3 to last for at least 20 years of regular use - a true long-term investment in a cleaner home.',
                'price' => 399.99,
                'sort_order' => 110,
                'popularity_score' => 0,
                'stock_left' => 7
            ],
            [
                'slug' => 'apple-watch-6',
                'category_slug' => 'smart-watches',
                'brand' => 'Apple',
                'name' => 'Watch Series 6',
                'short_description' => 'Feature-rich smartwatch with blood oxygen sensor, ECG app, always-on Retina display, built-in GPS, Apple Pay, and WR50 water resistance.',
                'description' => 'The Apple Watch Series 6 goes beyond timekeeping to become a comprehensive health and fitness companion worn on your wrist. The blood oxygen sensor and ECG app provide meaningful health insights you can share with your doctor, while the optical heart rate sensor tracks your heart rate continuously throughout the day. The always-on Retina LTPO OLED display stays visible in sunlight without requiring a wrist raise, and the S6 chip powers everything seamlessly. Built-in GPS tracks outdoor runs, rides, and hikes without your iPhone, and WR50 water resistance handles swimming sessions. With Apple Pay, Siri, and over 35,000 apps available on watchOS, the Series 6 is the most connected and capable wearable Apple has ever made.',
                'price' => 299.99,
                'sort_order' => 120,
                'popularity_score' => 0,
                'stock_left' => 6
            ],
            [
                'slug' => 'delonghi-magnifica-s',
                'category_slug' => 'home-appliances',
                'brand' => 'De\'Longhi',
                'name' => 'Magnifica S Coffee Machine',
                'short_description' => 'Compact super-automatic espresso machine with integrated grinder, adjustable coffee strength, and a one-touch latte crema system.',
                'description' => 'The De\'Longhi Magnifica S is the perfect gateway into super-automatic espresso for households that want café-quality drinks without the complexity of manual machines. Its patented Direct-to-Brew system grinds fresh beans and brews coffee in a single integrated process, preserving the full aroma right up to the moment it hits your cup. The adjustable grinder lets you choose between five fineness levels, while the brew-strength selector tailors the intensity from mild to extra strong. The Cappuccino System manual frother mixes steam and milk to produce a rich, creamy froth for lattes and cappuccinos on demand. The compact footprint suits smaller kitchens and the removable water tank and coffee grounds container make maintenance quick and hassle-free.',
                'price' => 749.99,
                'sort_order' => 125,
                'popularity_score' => 0,
                'stock_left' => 5
            ],
            [
                'slug' => 'lenovo-ideapad-slim-3',
                'category_slug' => 'laptops',
                'brand' => 'Lenovo',
                'name' => 'IdeaPad Slim 3',
                'short_description' => 'Affordable everyday laptop with a 15.6-inch FHD display, AMD Ryzen 5 7520U processor, 8 GB RAM, and up to 10-hour battery life.',
                'description' => 'The Lenovo IdeaPad Slim 3 is a no-nonsense everyday laptop built for students, remote workers, and anyone who needs a reliable machine without breaking the bank. Its 15.6-inch Full HD IPS display offers crisp, clear visuals with wide viewing angles, making it comfortable for long reading and video sessions. The AMD Ryzen 5 7520U processor and 8 GB RAM handle office productivity, web browsing, and light media editing with ease, while the 512 GB SSD keeps boot times and app launches fast. An all-day 10-hour battery means you can leave the charger at home during a typical work or school day. Fast Charge technology replenishes 80% battery in under an hour when you do need a top-up.',
                'price' => 489.99,
                'sort_order' => 130,
                'popularity_score' => 0,
                'stock_left' => 14
            ],
            [
                'slug' => 'samsung-ms23k',
                'category_slug' => 'home-appliances',
                'brand' => 'Samsung',
                'name' => 'Microwave Oven MS23K3513',
                'short_description' => '23-litre solo microwave with 800 W power, ceramic enamel interior for easy cleaning, and a slim fry function for healthier cooking.',
                'description' => 'The Samsung MS23K3513 is a straightforward yet cleverly designed solo microwave that brings durability and easy cleaning together in a compact 23-litre package. Its ceramic enamel interior is scratch-resistant, anti-bacterial, and far easier to wipe clean than conventional painted surfaces - a lasting advantage over years of daily use. The 800 W power output is sufficient for fast reheating, defrosting, and cooking, while five power levels let you tailor heat intensity to delicate dishes like melting chocolate or gently defrosting meat. The Slim Fry function circulates warm air over a special crusty plate, reducing the oil needed to achieve a crispy finish on chips and snacks. A push-and-turn dial and LED display make operation straightforward for all users.',
                'price' => 179.99,
                'sort_order' => 135,
                'popularity_score' => 0,
                'stock_left' => 6
            ],
            [
                'slug' => 'microsoft-arc-mouse',
                'category_slug' => 'accessories',
                'brand' => 'Microsoft',
                'name' => 'Arc Mouse Bluetooth',
                'short_description' => 'Ultra-thin Bluetooth travel mouse that snaps flat for portability and curves into an ergonomic arc for comfortable scrolling and clicking.',
                'description' => 'The Microsoft Arc Mouse is a feat of elegant engineering designed for professionals who travel light. In its flat, folded state it slips effortlessly into a laptop bag or jacket pocket without adding bulk; snap it open and the mouse curves into an ergonomic arc that comfortably supports the hand for extended use. The unique arc form eliminates the need for separate scroll wheel buttons - simply scroll anywhere along the touch strip on top of the mouse. Bluetooth connectivity means no dongle to carry or lose, and it pairs instantly with Windows, macOS, and Android devices. A single full charge powers the Arc Mouse for up to 4 months, and the precision BlueTrack sensor tracks reliably on most surfaces including coarse fabrics.',
                'price' => 79.99,
                'sort_order' => 140,
                'popularity_score' => 0,
                'stock_left' => 10
            ],
            [
                'slug' => 'samsung-galaxy-a55',
                'category_slug' => 'smartphones',
                'brand' => 'Samsung',
                'name' => 'Galaxy A55 5G',
                'short_description' => 'Mid-range smartphone with a 6.6-inch Super AMOLED 120Hz display, 50 MP OIS camera, Exynos 1480 chip, and IP67 water resistance.',
                'description' => 'The Samsung Galaxy A55 5G brings flagship-inspired features to the mid-range tier, starting with a large 6.6-inch Super AMOLED display running at a smooth 120Hz refresh rate - the same type of screen technology found in Samsung\'s premium Galaxy S series. The 50 MP main camera with Optical Image Stabilisation takes clear, detailed photos in low light and action shots without blur, while the 12 MP ultra-wide and 5 MP macro lenses cover every scene. Under the hood, the Exynos 1480 processor and 8 GB RAM ensure snappy day-to-day performance and comfortable gaming. IP67 certification protects against accidental splashes and brief submersion, and the 5000 mAh battery with 25W fast charging keeps you going through long days.',
                'price' => 369.99,
                'sort_order' => 145,
                'popularity_score' => 0,
                'stock_left' => 9
            ],
            [
                'slug' => 'xiaomi-14',
                'category_slug' => 'smartphones',
                'brand' => 'Xiaomi',
                'name' => 'Xiaomi 14',
                'short_description' => 'Compact flagship with a 6.36-inch LTPO AMOLED 120Hz display, Snapdragon 8 Gen 3 chip, Leica triple camera system, and 90W fast charging.',
                'description' => 'The Xiaomi 14 is a compact flagship that refuses to compromise, packing the most powerful mobile chipset available - the Snapdragon 8 Gen 3 - into a pocket-friendly 6.36-inch form factor. The Leica-tuned triple camera system is the star of the show: a 50 MP main sensor with variable aperture, a 50 MP telephoto with 3.2× optical zoom, and a 50 MP ultra-wide all working together under Leica\'s cinematic colour science for images with unmistakable character. The 6.36-inch LTPO AMOLED display runs at up to 120Hz for fluid scrolling and drops as low as 1Hz on static content to conserve energy. At 4610 mAh the battery is smaller than some rivals, but the 90W HyperCharge wired and 50W wireless charging keep downtime minimal.',
                'price' => 849.99,
                'sort_order' => 150,
                'popularity_score' => 0,
                'stock_left' => 4
            ],
            [
                'slug' => 'google-pixel-8a',
                'category_slug' => 'smartphones',
                'brand' => 'Google',
                'name' => 'Pixel 8a',
                'short_description' => 'Google\'s AI-first mid-ranger with a 6.1-inch 120Hz display, Tensor G3 chip, 64 MP camera with Magic Eraser, and 7 years of OS updates.',
                'description' => 'The Google Pixel 8a delivers the most desirable Pixel features at a mid-range price: the Tensor G3 chip powers industry-leading computational photography and on-device AI tools that make your photos look better with zero effort. Magic Eraser removes unwanted people and objects from shots, Best Take composites the best faces from burst photos into a single image, and Night Sight reveals colour and detail in near-darkness that other cameras simply miss. The 6.1-inch Actua Display runs at a smooth 120Hz and cranks up to 1400 nits peak brightness for clear outdoor viewing. With an IP67 rating, a full-day 4492 mAh battery, and an unprecedented 7 years of guaranteed Android OS and security updates, the Pixel 8a is one of the best long-term investments in smartphones today.',
                'price' => 539.99,
                'sort_order' => 155,
                'popularity_score' => 0,
                'stock_left' => 11
            ],
            [
                'slug' => 'anker-powercore-26800',
                'category_slug' => 'power-batteries',
                'brand' => 'Anker',
                'name' => 'PowerCore 26800 Power Bank',
                'short_description' => 'High-capacity 26800 mAh power bank with dual USB-A outputs, USB-C input, and PowerIQ intelligent charging for phones, tablets, and laptops.',
                'description' => 'The Anker PowerCore 26800 is the travel power bank for adventurers and frequent flyers who cannot afford to run out of charge. Its colossal 26800 mAh capacity translates to roughly six full smartphone charges or one to two full laptop charges, providing peace of mind across multi-day trips and international flights. Two USB-A outputs with Anker\'s PowerIQ technology detect each connected device\'s optimal charging speed and deliver up to 5V/3A per port, so two devices charge at full speed simultaneously. The USB-C port serves as both input for recharging the bank itself and as a third output. A multi-LED indicator displays remaining power in 25% increments. Constructed from aircraft-grade aluminium, the PowerCore 26800 is built for the long haul.',
                'price' => 64.99,
                'sort_order' => 160,
                'popularity_score' => 0,
                'stock_left' => 7
            ],
            [
                'slug' => 'bosch-kgn36',
                'category_slug' => 'home-appliances',
                'brand' => 'Bosch',
                'name' => 'KGN36VWEQ Refrigerator',
                'short_description' => 'Free-standing fridge-freezer with 321 L capacity, NoFrost technology, VitaFresh XL for longer freshness, and an A++ energy rating.',
                'description' => 'The Bosch KGN36VWEQ is a free-standing fridge-freezer that brings intelligent freshness management and frost-free convenience to a sleek, modern kitchen. Its NoFrost system circulates cold air evenly through both compartments, eliminating the build-up of ice crystals entirely - so defrosting becomes a thing of the past. VitaFresh XL technology maintains optimal humidity and temperature in dedicated fruit, vegetable, and meat zones, keeping fresh produce good for up to three times longer than conventional cooling. The 321-litre total capacity is generously proportioned for a 4- to 5-person household, and the clean white finish and LED interior lighting make it both practical and attractive. An A++ energy rating and low-noise 39 dB operation underline its everyday efficiency.',
                'price' => 649.99,
                'sort_order' => 165,
                'popularity_score' => 0,
                'stock_left' => 3
            ],
            [
                'slug' => 'dyson-v11',
                'category_slug' => 'home-appliances',
                'brand' => 'Dyson',
                'name' => 'V11 Cordless Vacuum',
                'short_description' => 'Powerful cordless vacuum with an intelligent motor that auto-adjusts suction, 60-min runtime, and a real-time LCD screen on the handle.',
                'description' => 'The Dyson V11 is the cordless vacuum that redefined what is possible without a power cord. Its High Torque XL cleaner head contains sensors that detect floor type and automatically increase or reduce suction motor speed to clean carpets and hard floors optimally - all without any manual adjustment. The Dynamic Load Sensor stops the brush bar mid-cycle if tangled with hair or debris, protecting both the machine and your floors. An LCD screen on the handle displays remaining battery runtime in minutes, current power mode, and filter maintenance alerts. At maximum suction, the V11 rivals many corded vacuums, and in Eco mode it stretches to 60 minutes of continuous cleaning on a single charge. The point-and-shoot hygienic bin emptying keeps hands away from dust and allergens.',
                'price' => 549.99,
                'sort_order' => 170,
                'popularity_score' => 0,
                'stock_left' => 6
            ],
            [
                'slug' => 'rowenta-x-force',
                'category_slug' => 'home-appliances',
                'brand' => 'Rowenta',
                'name' => 'X-Force 9.60 Cordless Vacuum',
                'short_description' => 'Versatile cordless vacuum with X-Force Flex technology, 45-min runtime, HEPA filter, and a self-cleaning roll brush for hair-free maintenance.',
                'description' => 'The Rowenta X-Force 9.60 is a cordless vacuum built around flexibility and ease of use. Its patented X-Force Flex motor technology combines a high-efficiency brushless motor with an articulating neck that bends to reach under low furniture without kneeling. The self-cleaning roll brush automatically wraps wound-up hair around a small cutter and discharges it into the dust cup, ending the tedious chore of manually picking hair out of the brush after every use. A 45-minute runtime on standard mode covers large homes comfortably on one charge, and the Boost mode delivers maximum suction for deep carpet cleaning when needed. The washable HEPA filter traps fine allergen particles and can be rinsed under the tap, while the hands-free dust cup ejection keeps emptying clean and hygienic.',
                'price' => 329.99,
                'sort_order' => 175,
                'popularity_score' => 0,
                'stock_left' => 8
            ],
            [
                'slug' => 'samsung-galaxy-watch-6',
                'category_slug' => 'smart-watches',
                'brand' => 'Samsung',
                'name' => 'Galaxy Watch 6',
                'short_description' => 'Advanced health smartwatch with a 1.5-inch AMOLED display, BioActive Sensor for body composition analysis, sleep coaching, and 40-hour battery.',
                'description' => 'The Samsung Galaxy Watch 6 is one of the most health-focused smartwatches on the market, built around its upgraded BioActive Sensor that tracks body composition, heart rate, blood oxygen, and ECG from a single optical array on the underside of the watch. Advanced Sleep Coaching analyses your sleep stages over multiple nights and gives personalised recommendations to improve rest quality - something no simple sleep tracker can match. The 1.5-inch Super AMOLED display is 20% larger than its predecessor and surrounded by a slimmer bezel, giving you more screen in a similar-sized case. The sapphire crystal glass and IP68/MIL-STD-810H durability ratings protect it from drops, dust, and deep-water swimming. Powered by the Exynos W930 chip and running Wear OS with One UI Watch, it integrates seamlessly with Galaxy smartphones and Google services.',
                'price' => 329.99,
                'sort_order' => 180,
                'popularity_score' => 0,
                'stock_left' => 8
            ],
        ];

        Product::where('slug', 'motorola-razr-50')->delete();

        foreach ($products as $product) {
            $product['category_id'] = $categoryIds[$product['category_slug']] ?? null;
            unset($product['category_slug']);

            Product::updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, ['is_active' => true])
            );
        }
    }
}
