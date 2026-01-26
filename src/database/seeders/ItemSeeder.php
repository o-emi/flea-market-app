<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $items = [
        [
          'name' => '腕時計',
          'price' => 15000,
          'brand' => 'Rolax',
          'description' => 'スタイリッシュなデザインのメンズ腕時計',
          'image_path' => 'items/watch.jpg',
          'condition' => '良好',
          'is_sold' => false,
          'user_id' => 1,
        ],
        [
          'name' => 'HDD',
          'price' => 5000,
          'brand' => '西芝',
          'description' => '高速で信頼性の高いハードディスク',
          'image_path' => 'items/hdd.jpg',
          'condition' => '目立った傷や汚れなし',
          'is_sold' => false,
          'user_id' => 2,
        ],
        [
          'name' => '玉ねぎ3束',
          'price' =>  300,
          'brand' => 'なし',
          'description' => '新鮮な玉ねぎ3束のセット',
          'image_path' => 'items/onion.jpg',
          'condition' => 'やや傷や汚れあり',
          'is_sold' => false,
          'user_id' => 3,
        ],
        [
          'name' => '革靴',
          'price' => 4000,
          'brand' =>  null,
          'description' => 'クラシックなデザインの革靴',
          'image_path' => 'items/leather_shoes.jpg',
          'condition' => '状態が悪い',
          'is_sold' => false,
          'user_id' => 4,
        ],
        [
          'name' => 'ノートPC',
          'price' => 45000,
          'brand' => null,
          'description' => '高性能なノートパソコン',
          'image_path' => 'items/laptop.jpg',
          'condition' => '良好',
          'is_sold' => false,
          'user_id' => 5,
        ],
        [
          'name' => 'マイク',
          'price' => 8000,
          'brand' => 'なし',
          'description' => '高音質のレコーディング用マイク',
          'image_path' => 'items/mic.jpg',
          'condition' => '目立った傷や汚れなし',
          'is_sold' => false,
          'user_id' => 6,
        ],
        [
          'name' => 'ショルダーバック',
          'price' => 3500,
          'brand' => null,
          'description' => 'おしゃれなショルダーバッグ',
          'image_path' => 'items/shoulder_bag.jpg',
          'condition' => 'やや傷や汚れあり',
          'is_sold' => false,
          'user_id' => 7,
        ],
        [
          'name' => 'タンブラー',
          'price' => 500,
          'brand' => 'なし',
          'description' => '使いやすいタンブラー',
          'image_path' => 'items/tumbler.jpg',
          'condition' => '状態が悪い',
          'is_sold' => false,
          'user_id' => 8,
        ],
        [
          'name' => 'コーヒーミル',
          'price' => 4000,
          'brand' => 'Starbacks',
          'description' => '手動のコーヒーミル',
          'image_path' => 'items/coffee_mill.jpg',
          'condition' => '良好',
          'is_sold' => false,
          'user_id' => 9,
        ],
        [
          'name' => 'メイクセット',
          'price' => 2500,
          'brand' => null,
          'description' => '便利なメイクアップセット',
          'image_path' => 'items/makeup_set.jpg',
          'condition' => '目立った傷や汚れなし',
          'is_sold' => false,
          'user_id' => 10,
        ],
      ];

      foreach ($items as $item) {
          Item::create($item);
      }
    }
}
