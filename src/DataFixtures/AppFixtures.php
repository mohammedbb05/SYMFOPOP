<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // ===== CREATE 5 REALISTIC USERS =====
        $usersData = [
            ['name' => 'Carlos Martínez', 'email' => 'carlos@example.com'],
            ['name' => 'Laura Sánchez',   'email' => 'laura@example.com'],
            ['name' => 'Miguel Torres',   'email' => 'miguel@example.com'],
            ['name' => 'Ana García',      'email' => 'ana@example.com'],
            ['name' => 'David López',     'email' => 'david@example.com'],
        ];

        $users = [];
        foreach ($usersData as $userData) {
            $user = new User();
            $user->setName($userData['name']);
            $user->setEmail($userData['email']);
            $user->setPassword($this->hasher->hashPassword($user, 'password123'));
            $user->setRoles(['ROLE_USER']);
            $user->setIsVerified(true);
            $manager->persist($user);
            $users[] = $user;
        }

        // ===== CREATE 20 REALISTIC PRODUCTS =====
        $productsData = [
            [
                'title'       => 'iPhone 13 Pro 256GB',
                'description' => 'iPhone 13 Pro in excellent condition, used for only 8 months. Comes with original charger, box and two extra cases. Battery health at 94%. No scratches on screen, minor scuff on the back. Selling because I upgraded to iPhone 15.',
                'price'       => 649.00,
                'image'       => 'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=640&h=480&fit=crop',
                'owner'       => 0,
                'days'        => -5,
            ],
            [
                'title'       => 'MacBook Air M1 2020',
                'description' => 'MacBook Air with Apple M1 chip, 8GB RAM, 256GB SSD. Space Grey color. In perfect working condition, always kept in a sleeve. Battery cycle count is only 87. Comes with original MagSafe charger. Great for students or professionals.',
                'price'       => 799.00,
                'image'       => 'https://images.unsplash.com/photo-1611186871525-43dba13bcc6d?w=640&h=480&fit=crop',
                'owner'       => 1,
                'days'        => -10,
            ],
            [
                'title'       => 'Sony PlayStation 5 + 2 Controllers',
                'description' => 'PS5 disc edition in perfect condition. Includes 2 DualSense controllers (one white, one midnight black) and 3 games: Spider-Man Miles Morales, God of War Ragnarök, and Horizon Forbidden West. Selling because I prefer PC gaming now.',
                'price'       => 420.00,
                'image'       => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=640&h=480&fit=crop',
                'owner'       => 2,
                'days'        => -2,
            ],
            [
                'title'       => 'Trek FX3 Disc Hybrid Bike 2022',
                'description' => 'Trek FX3 Disc in matte charcoal, size M. Only 400km ridden, in immaculate condition. Hydraulic disc brakes, 24-speed Shimano gears. Includes rear rack, lights front and back, and a Kryptonite lock. Perfect for city commuting.',
                'price'       => 750.00,
                'image'       => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?w=640&h=480&fit=crop',
                'owner'       => 3,
                'days'        => -15,
            ],
            [
                'title'       => 'Canon EOS R50 Camera Kit',
                'description' => 'Canon EOS R50 mirrorless camera with 18-45mm kit lens. Only used on 3 trips, shutter count under 500. Comes with 2 batteries, 64GB SD card, original bag and all manuals. Perfect for beginners getting into photography or vlogging.',
                'price'       => 580.00,
                'image'       => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=640&h=480&fit=crop',
                'owner'       => 4,
                'days'        => -7,
            ],
            [
                'title'       => 'IKEA KALLAX Shelf Unit 4x4',
                'description' => 'IKEA KALLAX 4x4 shelf unit in white, 147x147cm. Excellent condition, no damage or stains. Comes with 6 drawer inserts (white). Must be collected — I cannot deliver. Located in Barcelona city centre. Selling due to moving abroad.',
                'price'       => 85.00,
                'image'       => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=640&h=480&fit=crop',
                'owner'       => 0,
                'days'        => -20,
            ],
            [
                'title'       => 'Nintendo Switch OLED White',
                'description' => 'Nintendo Switch OLED model in white. Purchased 6 months ago, barely used. Comes with dock, Joy-Con controllers, carrying case and screen protector already applied. Includes Mario Kart 8 Deluxe physical cartridge. No dead pixels, perfect screen.',
                'price'       => 280.00,
                'image'       => 'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=640&h=480&fit=crop',
                'owner'       => 1,
                'days'        => -3,
            ],
            [
                'title'       => 'Dyson V11 Cordless Vacuum',
                'description' => 'Dyson V11 Animal cordless vacuum cleaner. 2 years old but in great condition, suction power is still excellent. Comes with all original attachments including the mini motorhead, crevice tool and combination tool. Cleaned and ready to go.',
                'price'       => 220.00,
                'image'       => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=640&h=480&fit=crop',
                'owner'       => 2,
                'days'        => -12,
            ],
            [
                'title'       => 'Levi\'s 501 Original Jeans W32 L32',
                'description' => 'Classic Levi\'s 501 jeans in dark wash indigo. Size W32 L32. Worn only a few times, in perfect condition. No fading, no damage. These are the authentic straight fit, not the slim taper. A wardrobe essential at a fraction of retail price.',
                'price'       => 35.00,
                'image'       => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=640&h=480&fit=crop',
                'owner'       => 3,
                'days'        => -8,
            ],
            [
                'title'       => 'KitchenAid Stand Mixer Empire Red',
                'description' => 'KitchenAid Artisan Stand Mixer 5KSM175 in Empire Red, 4.8L bowl. Used maybe 10 times, in showroom condition. Comes with flat beater, dough hook, wire whip and pouring shield. All original accessories included. A dream machine for baking enthusiasts.',
                'price'       => 350.00,
                'image'       => 'https://images.unsplash.com/photo-1594495894542-a46cc73e081a?w=640&h=480&fit=crop',
                'owner'       => 4,
                'days'        => -18,
            ],
            [
                'title'       => 'Samsung 65" QLED 4K TV 2022',
                'description' => 'Samsung QE65Q80B 65-inch QLED 4K Smart TV. Only 14 months old, in perfect condition. Stunning picture quality with Quantum HDR. Comes with original remote, stands and all cables. Smart TV with Netflix, Disney+, YouTube pre-installed. Selling because we moved to a smaller flat.',
                'price'       => 700.00,
                'image'       => 'https://images.unsplash.com/photo-1593359677879-a4bb92f4834b?w=640&h=480&fit=crop',
                'owner'       => 0,
                'days'        => -25,
            ],
            [
                'title'       => 'Adidas Ultraboost 22 Size 43',
                'description' => 'Adidas Ultraboost 22 running shoes in core black/white, EU size 43. Worn only twice for short runs. In near-perfect condition, no significant wear on sole. Comes with original box and extra laces. Retail was €180, selling at half price.',
                'price'       => 90.00,
                'image'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=640&h=480&fit=crop',
                'owner'       => 1,
                'days'        => -4,
            ],
            [
                'title'       => 'Kindle Paperwhite 11th Gen',
                'description' => 'Amazon Kindle Paperwhite 11th generation, 8GB, WiFi, with ads. 6.8" display, adjustable warm light. Used for about a year, screen in perfect condition. Comes with a fabric cover (sage green) and USB-C cable. Battery still lasts weeks per charge.',
                'price'       => 75.00,
                'image'       => 'https://images.unsplash.com/photo-1592496431122-2349e0fbc666?w=640&h=480&fit=crop',
                'owner'       => 2,
                'days'        => -6,
            ],
            [
                'title'       => 'Vintage Leather Sofa 3-Seater',
                'description' => 'Beautiful genuine leather 3-seater sofa in cognac brown. Bought from a designer store 3 years ago, aged beautifully. Minor natural creasing typical of real leather. 210cm wide. Must collect from Gràcia neighbourhood, Barcelona. Happy to help disassemble legs.',
                'price'       => 450.00,
                'image'       => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=640&h=480&fit=crop',
                'owner'       => 3,
                'days'        => -30,
            ],
            [
                'title'       => 'GoPro Hero 11 Black',
                'description' => 'GoPro Hero 11 Black in perfect condition. Used on 2 ski trips. Comes with 3 batteries, dual battery charger, 64GB SanDisk Extreme card, all original mounts and a chest harness. 5.3K video, incredible stabilisation. Selling because I got a drone instead.',
                'price'       => 270.00,
                'image'       => 'https://images.unsplash.com/photo-1505935428862-770b6f24f629?w=640&h=480&fit=crop',
                'owner'       => 4,
                'days'        => -9,
            ],
            [
                'title'       => 'Nespresso Vertuo Next Coffee Machine',
                'description' => 'Nespresso Vertuo Next in matte black. 18 months old, descaled and cleaned regularly. Makes 5 cup sizes from espresso to alto. Comes with Aeroccino 3 milk frother and a selection of 20 capsules. Perfect condition, selling because we got a bean-to-cup machine.',
                'price'       => 80.00,
                'image'       => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=640&h=480&fit=crop',
                'owner'       => 0,
                'days'        => -11,
            ],
            [
                'title'       => 'Fjällräven Kånken Backpack Navy',
                'description' => 'Fjällräven Kånken classic backpack in navy blue, 16L. Used for one semester at university, in very good condition. Small pen mark inside pocket (barely visible). Iconic design, super comfortable for daily use. Comes with the sitting pad.',
                'price'       => 55.00,
                'image'       => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=640&h=480&fit=crop',
                'owner'       => 1,
                'days'        => -14,
            ],
            [
                'title'       => 'Bose QuietComfort 45 Headphones',
                'description' => 'Bose QC45 wireless noise-cancelling headphones in white smoke. Purchased 10 months ago, in excellent condition. Up to 24 hours battery life. Comes with original case, 3.5mm audio cable and USB-C charging cable. The best noise cancellation I have ever experienced.',
                'price'       => 195.00,
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=640&h=480&fit=crop',
                'owner'       => 2,
                'days'        => -16,
            ],
            [
                'title'       => 'Specialized Rockhopper MTB 29"',
                'description' => 'Specialized Rockhopper Comp 29" mountain bike, size L. 2021 model in forest green. Used on trails about 15 times, in great condition. Sram 2x9 gearing, hydraulic disc brakes, RockShox front fork. Recently had a full service. Helmet included if you want it.',
                'price'       => 620.00,
                'image'       => 'https://images.unsplash.com/photo-1576435728678-68d0fbf94e91?w=640&h=480&fit=crop',
                'owner'       => 3,
                'days'        => -22,
            ],
            [
                'title'       => 'Instant Pot Duo 7-in-1 6L',
                'description' => 'Instant Pot Duo 7-in-1 electric pressure cooker, 6 litre. Used around 20 times, works perfectly. Pressure cooker, slow cooker, rice cooker, steamer, sauté pan, yogurt maker and food warmer all in one. Comes with all accessories and the recipe booklet.',
                'price'       => 55.00,
                'image'       => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=640&h=480&fit=crop',
                'owner'       => 4,
                'days'        => -19,
            ],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setTitle($data['title']);
            $product->setDescription($data['description']);
            $product->setPrice((string) $data['price']);
            $product->setImage($data['image']);
            $product->setCreatedAt(new \DateTime($data['days'] . ' days'));
            $product->setOwner($users[$data['owner']]);
            $manager->persist($product);
        }

        $manager->flush();
    }
}