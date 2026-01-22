<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample categories
        $categories = [
            [
                'name' => 'Dry Fruits',
                'description' => 'Premium quality dried fruits including dates, raisins, apricots, figs, and more. Rich in vitamins and natural sweetness.',
                'slug' => Str::slug('Dry Fruits'),
            ],
            [
                'name' => 'Nuts',
                'description' => 'Fresh and healthy nuts like almonds, cashews, walnuts, pistachios, and hazelnuts. Perfect for snacking and cooking.',
                'slug' => Str::slug('Nuts'),
            ],
            [
                'name' => 'Imported Chocolates',
                'description' => 'Premium imported chocolates from Belgium, Switzerland, and other renowned chocolate-making countries.',
                'slug' => Str::slug('Imported Chocolates'),
            ],
            [
                'name' => 'Seeds',
                'description' => 'Nutritious seeds including sunflower seeds, pumpkin seeds, chia seeds, and flax seeds. Great for health and wellness.',
                'slug' => Str::slug('Seeds'),
            ],
            [
                'name' => 'Trail Mixes',
                'description' => 'Delicious combinations of nuts, dried fruits, and seeds. Perfect for on-the-go snacking and energy boost.',
                'slug' => Str::slug('Trail Mixes'),
            ],
            [
                'name' => 'Honey & Spreads',
                'description' => 'Pure natural honey, nut butters, and healthy spreads. Organic and locally sourced options available.',
                'slug' => Str::slug('Honey & Spreads'),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Get category IDs
        $dryFruitsCat = Category::where('slug', 'dry-fruits')->first();
        $nutsCat = Category::where('slug', 'nuts')->first();
        $chocolatesCat = Category::where('slug', 'imported-chocolates')->first();
        $seedsCat = Category::where('slug', 'seeds')->first();
        $trailMixesCat = Category::where('slug', 'trail-mixes')->first();
        $honeyCat = Category::where('slug', 'honey-spreads')->first();

        // Create sample products
        $products = [
            // Dry Fruits
            [
                'name' => 'Premium Medjool Dates',
                'description' => 'Large, soft, and incredibly sweet Medjool dates. Known as the "king of dates" for their superior quality and taste. Rich in fiber, potassium, and antioxidants.',
                'price' => 65.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 100,
                'unit' => 'kg',
                'slug' => Str::slug('Premium Medjool Dates'),
            ],
            [
                'name' => 'Golden Raisins',
                'description' => 'Hand-picked golden raisins with natural sweetness. Perfect for baking, snacking, or adding to your morning cereal. No added sugar.',
                'price' => 35.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 150,
                'unit' => 'kg',
                'slug' => Str::slug('Golden Raisins'),
            ],
            [
                'name' => 'Dried Apricots',
                'description' => 'Delicious dried apricots rich in vitamins A and C, fiber, and potassium. Soft, chewy texture with a naturally sweet and tangy flavor.',
                'price' => 42.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 80,
                'unit' => 'kg',
                'slug' => Str::slug('Dried Apricots'),
            ],
            [
                'name' => 'Dried Figs',
                'description' => 'Premium Turkish dried figs. Soft, sweet, and packed with fiber, calcium, and iron. Great for digestive health.',
                'price' => 48.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 90,
                'unit' => 'kg',
                'slug' => Str::slug('Dried Figs'),
            ],
            [
                'name' => 'Dried Cranberries',
                'description' => 'Tart and sweet dried cranberries. High in antioxidants and vitamin C. Perfect for salads, baking, or as a healthy snack.',
                'price' => 38.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 120,
                'unit' => 'kg',
                'slug' => Str::slug('Dried Cranberries'),
            ],
            [
                'name' => 'Dried Mango Slices',
                'description' => 'Sweet and chewy dried mango slices. Rich in vitamin A and C. No preservatives, just pure natural mango goodness.',
                'price' => 45.00,
                'category_id' => $dryFruitsCat->id,
                'quantity' => 70,
                'unit' => 'kg',
                'slug' => Str::slug('Dried Mango Slices'),
            ],
            // Nuts
            [
                'name' => 'Roasted Almonds',
                'description' => 'Perfectly roasted almonds, healthy and delicious. Rich in protein, healthy fats, and vitamin E. Great for heart health.',
                'price' => 55.00,
                'category_id' => $nutsCat->id,
                'quantity' => 120,
                'unit' => 'kg',
                'slug' => Str::slug('Roasted Almonds'),
            ],
            [
                'name' => 'Raw Cashews',
                'description' => 'Premium quality raw cashews, creamy and nutritious. High in healthy monounsaturated fats, protein, and essential minerals.',
                'price' => 68.00,
                'category_id' => $nutsCat->id,
                'quantity' => 90,
                'unit' => 'kg',
                'slug' => Str::slug('Raw Cashews'),
            ],
            [
                'name' => 'Pistachios',
                'description' => 'Green pistachios with natural flavor and crunch. Rich in antioxidants, fiber, and healthy fats. Shelled and ready to eat.',
                'price' => 75.00,
                'category_id' => $nutsCat->id,
                'quantity' => 70,
                'unit' => 'kg',
                'slug' => Str::slug('Pistachios'),
            ],
            [
                'name' => 'Walnuts',
                'description' => 'Fresh shelled walnuts. High in omega-3 fatty acids, antioxidants, and protein. Perfect for brain health and baking.',
                'price' => 58.00,
                'category_id' => $nutsCat->id,
                'quantity' => 85,
                'unit' => 'kg',
                'slug' => Str::slug('Walnuts'),
            ],
            [
                'name' => 'Hazelnuts',
                'description' => 'Premium roasted hazelnuts. Rich, buttery flavor perfect for desserts, spreads, or snacking. High in vitamin E and healthy fats.',
                'price' => 62.00,
                'category_id' => $nutsCat->id,
                'quantity' => 75,
                'unit' => 'kg',
                'slug' => Str::slug('Hazelnuts'),
            ],
            [
                'name' => 'Brazil Nuts',
                'description' => 'Large, creamy Brazil nuts. Excellent source of selenium, magnesium, and healthy fats. Great for immune system support.',
                'price' => 72.00,
                'category_id' => $nutsCat->id,
                'quantity' => 60,
                'unit' => 'kg',
                'slug' => Str::slug('Brazil Nuts'),
            ],
            // Chocolates
            [
                'name' => 'Belgian Dark Chocolate',
                'description' => 'Authentic Belgian dark chocolate with 70% cocoa. Rich, smooth, and indulgent. Made with premium cocoa beans.',
                'price' => 28.00,
                'category_id' => $chocolatesCat->id,
                'quantity' => 200,
                'unit' => 'box',
                'slug' => Str::slug('Belgian Dark Chocolate'),
            ],
            [
                'name' => 'Swiss Milk Chocolate',
                'description' => 'Creamy Swiss milk chocolate with a smooth, velvety texture. Made with the finest Swiss chocolate-making traditions.',
                'price' => 32.00,
                'category_id' => $chocolatesCat->id,
                'quantity' => 180,
                'unit' => 'box',
                'slug' => Str::slug('Swiss Milk Chocolate'),
            ],
            [
                'name' => 'French Truffles',
                'description' => 'Luxurious French chocolate truffles. Handcrafted with premium ingredients. Perfect gift for chocolate lovers.',
                'price' => 45.00,
                'category_id' => $chocolatesCat->id,
                'quantity' => 150,
                'unit' => 'box',
                'slug' => Str::slug('French Truffles'),
            ],
            [
                'name' => 'Chocolate Covered Almonds',
                'description' => 'Premium almonds covered in rich dark chocolate. Perfect combination of crunch and sweetness. Individually wrapped.',
                'price' => 38.00,
                'category_id' => $chocolatesCat->id,
                'quantity' => 160,
                'unit' => 'box',
                'slug' => Str::slug('Chocolate Covered Almonds'),
            ],
            // Seeds
            [
                'name' => 'Sunflower Seeds',
                'description' => 'Roasted and salted sunflower seeds. High in vitamin E, selenium, and healthy fats. Great for snacking.',
                'price' => 22.00,
                'category_id' => $seedsCat->id,
                'quantity' => 200,
                'unit' => 'kg',
                'slug' => Str::slug('Sunflower Seeds'),
            ],
            [
                'name' => 'Pumpkin Seeds',
                'description' => 'Roasted pumpkin seeds. Rich in magnesium, zinc, and antioxidants. Great source of plant-based protein.',
                'price' => 28.00,
                'category_id' => $seedsCat->id,
                'quantity' => 180,
                'unit' => 'kg',
                'slug' => Str::slug('Pumpkin Seeds'),
            ],
            [
                'name' => 'Chia Seeds',
                'description' => 'Organic chia seeds. High in omega-3 fatty acids, fiber, and protein. Perfect for smoothies, yogurt, and baking.',
                'price' => 35.00,
                'category_id' => $seedsCat->id,
                'quantity' => 150,
                'unit' => 'kg',
                'slug' => Str::slug('Chia Seeds'),
            ],
            // Trail Mixes
            [
                'name' => 'Classic Trail Mix',
                'description' => 'Perfect blend of almonds, cashews, raisins, and dried cranberries. Great for hiking, snacking, or on-the-go energy.',
                'price' => 42.00,
                'category_id' => $trailMixesCat->id,
                'quantity' => 100,
                'unit' => 'kg',
                'slug' => Str::slug('Classic Trail Mix'),
            ],
            [
                'name' => 'Tropical Trail Mix',
                'description' => 'Exotic mix of cashews, dried mango, coconut flakes, and banana chips. A taste of the tropics in every bite.',
                'price' => 48.00,
                'category_id' => $trailMixesCat->id,
                'quantity' => 90,
                'unit' => 'kg',
                'slug' => Str::slug('Tropical Trail Mix'),
            ],
            // Honey & Spreads
            [
                'name' => 'Pure Wild Honey',
                'description' => '100% pure wild honey. Collected from natural beehives. Rich in antioxidants and enzymes. No additives or preservatives.',
                'price' => 55.00,
                'category_id' => $honeyCat->id,
                'quantity' => 80,
                'unit' => 'kg',
                'slug' => Str::slug('Pure Wild Honey'),
            ],
            [
                'name' => 'Almond Butter',
                'description' => 'Creamy natural almond butter. Made from premium roasted almonds. No added sugar or preservatives. High in protein and healthy fats.',
                'price' => 45.00,
                'category_id' => $honeyCat->id,
                'quantity' => 100,
                'unit' => 'jar',
                'slug' => Str::slug('Almond Butter'),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
