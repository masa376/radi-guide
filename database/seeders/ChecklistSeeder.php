<?php

namespace Database\Seeders;

use App\Models\Checklist;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $checklists = [
            // 胸部X線検査（examination_id: 1）
            [
                'examination_id' => 1,
                'item'           => 'アクセサリー・ネックレスを外してください',
                'is_required'    => true,
                'order'          => 0,
            ],
            [
                'examination_id' => 1,
                'item'           => 'ブラジャーのワイアーを含む金属類を外してください',
                'is_required'    => true,
                'order'          => 1,
            ],
            [
                'examination_id' => 1,
                'item'           => '貼付薬（湿布等）を外してください',
                'is_required'    => true,
                'order'          => 2,
            ],
            [
                'examination_id' => 1,
                'item'           => '妊娠中または妊娠の可能性がある場合は申し出ください',
                'is_required'    => true,
                'order'          => 3,
            ],

            // 胸部CT検査（examination_id: 3）
            [
                'examination_id' => 3,
                'item'           => '金属類・アクセサリー等は外してください',
                'is_required'    => true,
                'order'          => 0,
            ],
            [
                'examination_id' => 3,
                'item'           => '妊娠中または妊娠の可能性がある場合は申し出ください',
                'is_required'    => true,
                'order'          => 1,
            ],

            // 頭部MRI検査（examination_id: 5）
            [
                'examination_id' => 5,
                'item'           => 'ペースメーカーを装着されている方は検査できません。必ずお申し出ください。',
                'is_required'    => true,
                'order'          => 0,
            ],
            [
                'examination_id' => 5,
                'item'           => '金属製のインプラント・クリップがある方は事前にお申し出ください',
                'is_required'    => true,
                'order'          => 1,
            ],
            [
                'examination_id' => 5,
                'item'           => '閉所恐怖症の方は事前にお申し出ください',
                'is_required'    => false,
                'order'          => 2,
            ],
            [
                'examination_id' => 5,
                'item'           => 'アクセサリー・磁気カード・補聴器・スマートフォン等は撮影室に持ち込まないでください',
                'is_required'    => true,
                'order'          => 3,
            ],

            // 腹部エコー検査（examination_id: 6）
            [
                'examination_id' => 6,
                'item'           => '検査前5～6時間前から絶食してください',
                'is_required'    => true,
                'order'          => 0,
            ],
            [
                'examination_id' => 6,
                'item'           => '前日夜から脂っこいものは避けてください',
                'is_required'    => true,
                'order'          => 1,
            ],
            [
                'examination_id' => 6,
                'item'           => '（膀胱充満が必要な場合）できるだけ排尿を我慢してお越しください',
                'is_required'    => false,
                'order'          => 0,
            ]
        ];

        foreach ($checklists as $checklist) {
            Checklist::create($checklist);
        }
    }
}
