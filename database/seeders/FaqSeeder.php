<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // 全般FAQ（examination_id: null）
            [
                'examination_id' => null,
                'question'       => '検査の予約はどうすればいいですか？',
                'answer'         => 'お電話またはWebフォームからご予約いただけます。お気軽にお問い合わせください。',
                'order'          => 0,
            ],
            [
                'examination_id' => null,
                'question'       => '子供でも検査は受けられますか？',
                'answer'         => 'お子様でも検査を受けることができます。年齢や体格を考慮して検査方法が異なりますので、事前にご相談ください。',
                'order'          => 0,
            ],

            // 胸部CT（examination_id: 3）
            [
                'examination_id' => 3,
                'question'       => 'CT検査は痛いですか？',
                'answer'         => 'CT検査では痛みを伴いません。ただし造影剤を使用する場合、注射を行います。',
                'order'          => 0,
            ],
            [
                'examination_id' => 3,
                'question'       => '放射線被ばくは大丈夫ですか？',
                'answer'         => 'CT検査では放射線を使用しますが、1回で受ける線量は日常生活で受ける自然放射線と比べても問題ございません。ただし、妊娠中の方はご相談ください。',
                'order'          => 1,
            ],

            // 頭部MRI（examination_id: 5）
            [
                'examination_id' => 5,
                'question'       => 'MRI検査中はどんな音がしますか？',
                'answer'         => '検査中は「ドンドン」「ガンガン」といった大きな音がします。耳栓やヘッドフォンを着けますのでご安心ください。',
                'order'          => 0,
            ],

            // 腹部エコー（examination_id: 6）
            [
                'examination_id' => 6,
                'question'       => 'なぜ絶食が必要なのでしょうか？',
                'answer'         => '食事をすると胆嚢が収縮してしまい、胆石などが発見されにくくなります。また腸にガスが溜まって臓器が見えにくくなります。',
                'order'          => 0,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
