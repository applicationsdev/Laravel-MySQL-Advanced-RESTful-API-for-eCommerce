<?php

// imports
use Faker\Generator as Faker;
use App\OrderItem;
use App\Item;
use App\Order;
use Illuminate\Support\Facades\DB;

$factory->define(OrderItem::class, function (Faker $faker) {
    
    // To simplify testing, all generated Items (via ItemFactory) are available
    // but as long as OrderItems are generated, Item available_qty gets reduced
    // and Item status can become 'is_not_available'
    
    // Get one random available product
    // In current testing I require 'available_qty' > 1
    // to simulate in a simple way a few transactions
    // that can have more than 1 ordered qty
    $itemToOrder = Item::inRandomOrder()->where('available_qty', '>', 1)->first();
    
    // Set OrderItem 'qty'
    // (in current version I simulate B2C shops behavior so I keep max qty=2)
    $orderItemQty = rand(1, 2);
    
    // Calculate OrderItem 'value'
    $orderItemValue = $orderItemQty * $itemToOrder->catalog_price;
    
    // Update Item table data after this purchase
    // (to simplify testing, Order 'status' is not examined in this app version
    // otherwise the Item data should be updated after payment is verified
    // and product gets dispatched from our physical warehouse)
    DB::table('items')
        ->where('id', $itemToOrder->id)
        ->decrement('available_qty', $orderItemQty);
    
    // To avoid useless DB queries, I do a local check and then send DB query if needed
    $itemAvailableQty = $itemToOrder->available_qty;
    $itemAvailableQty -= $orderItemQty;
    if ($itemAvailableQty == 0) {
        DB::table('items')
            ->where('id', $itemToOrder->id)
            ->update(['status' => Config::get('customConstants.item.status.is_not_available')]);
            // needs [] because it's a "key => value"
    }
    
    // Fetching a valid order_id into the current OrderItem
    // (to simplify testing, I have already executed OrderFactory before OrderItemFactory)
    $order = Order::inRandomOrder()->first();
    
    // Increment Order's value by adding the current OrderItem's value
    // (one Order can have many OrderItems)
    DB::table('orders')
        ->where('id', $order->id)
        ->increment('value', $orderItemValue);
    
    // Export "Key => Value" array so DatabaseSeeder can generate fake OrderItems
    return [
        'qty' => $orderItemQty,
        'value' => $orderItemValue,
        'item_id' => $itemToOrder->id,
        'order_id' => $order->id,
        // These fake data are generated for testing purposes
        // To simplify data generation, it is accepted that Order 'created_at' timestamp
        // will be a few seconds earlier than OrderItem 'created_at' timestamp
        // which technically is not realistic, but is helpful for easier testing
    ];
});
