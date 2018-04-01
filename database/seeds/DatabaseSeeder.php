<?php

use Illuminate\Database\Seeder;

// import Models
use App\User;
use App\Category;
use App\Item;
use App\Order;
use App\OrderItem;

// import DB Facade
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // In case we create multiple Seeders, we can use the following syntax example
        // $this->call(UsersTableSeeder::class);
        
        // Before every DB 'seeding', it's a good practice
        // to deactivate FOREIGN_KEY_CHECKS
        // and delete old data from DB tables
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Item::truncate();
        Order::truncate();
        OrderItem::truncate();
        
        // Define 'How Many' fake data will be created for testing
        $howManyUsers = 30;
        $howManyCategories = 12;
        $howManyItems = 20;
        $howManyOrders = 10;
        $howManyOrderItems = 14; // forcing some Orders to have more than one OrderItems
        
        // Generate fake data for testing
        // Note: to simplify testing,
        // but at the same time to simulate RDBMS behavior (foreign keys)
        // I create Order before OrderItem and then I update and correct
        // each Order's 'value' field.
        // It's a good practice to consider Entities Relationships
        // to decide which Factory should run first, second, etc..
        factory(User::class, $howManyUsers)->create();
        factory(Category::class, $howManyCategories)->create();
        factory(Item::class, $howManyItems)->create();
        factory(Order::class, $howManyOrders)->create();
        factory(OrderItem::class, $howManyOrderItems)->create();
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
