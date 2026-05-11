<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Examination;
use Illuminate\Database\Seeder;

class ExaminationSeeder extends Seeder
{
    public function run(): void
    {
        $examinations = [
            // X線検査（category_id：1）
            [
                'category_id'  => 1,
                'title'        => '胸部X線検査',
                'slug'         => 'chest-xray',
                'description'  => '肺や心臓、肋骨などの状態を確認するための検査です。健康診断でも広く使われる検査です。',
                'purpose'      => "肺炎・肺がん・結核などの肺疾患の有無・評価\n心臓の大きさや形の確認\n肋骨や脊椎などの骨状態確認",
                'procedure'    => "1. 検査着に着替えます\n2. 撮影台の前に立ちます\n3. 息を吸って止めた状態で撮影します。\n4. 撮影完了後、着替えて終了です",
                'duration'     => 10,
                'precautions'  => "・アクセサリー・ブラジャー（金属類付き）・貼付薬などは外してください\n・妊娠中または妊娠の可能性がある方は事前にお申し出ください",
                'is_published' => true,
                'order'        => 0,
            ],
            [
                'category_id'  => 1,
                'title'        => '腹部X線検査',
                'slug'         => 'abdomen-xray',
                'description'  => '腹部内の臓器や腸の状態を確認するための検査です。腸閉塞や結石などの診断に使われます。',
                'purpose'      => "腸閉塞・イレウスの確認\n尿結石・胆石の確認\n腹部臓器の状態確認",
                'procedure'    => "1. 検査着に着替えます\n2. 撮影台の前に立ちます\n3. 息を吸って吐いて、止めた状態で撮影します。\n4. 撮影完了後、着替えて終了です",
                'duration'     => 10,
                'precautions'  => "・アクセサリー・ベルト・貼付薬などは外してください\n・妊娠中または妊娠の可能性がある方は事前にお申し出ください",
                'is_published' => true,
                'order'        => 1,
            ],

            // CT検査（category_id：2）
            [
                'category_id'  => 2,
                'title'        => '胸部CT検査',
                'slug'         => 'chest-ct',
                'description'  => 'X線を使って胸部を輪切りにした断面画像を撮影する検査です。通常のX線検査では見えにくい病変も詳しく調べることができます。',
                'purpose'      => "肺がん・肺炎・肺気腫などの詳細な評価\n縦隔腫瘍・リンパ節の確認\n心臓・大血管の状態確認",
                'procedure'    => "1. 検査着に着替えます\n2. 寝台で仰向けになります\n3. 寝台がドーナツ型の撮影装置の中を通ります\n4. 撮影装置から息を止めるよう指示があります（約10秒）\n5. 撮影完了後、着替えて終了です",
                'duration'     => 20,
                'precautions'  => "金属類・アクセサリーは外してください\n・妊娠中または妊娠の可能性がある方は検査できない場合があります",
                'is_published' => true,
                'order'        => 0,
            ],
            [
                'category_id'  => 2,
                'title'        => '腹部CT検査',
                'slug'         => 'abdomen-ct',
                'description'  => 'X線を使って腹部を輪切りにした断面画像を撮影する検査です。肝臓・膵臓・腎臓などの腹部臓器を詳しく調べる検査です。',
                'purpose'      => "肝臓・膵臓・腎臓・脾臓などの状態確認\n腹部外傷の評価",
                'procedure'    => "1. 検査着に着替えます\n2. 寝台で仰向けになります\n3. 寝台がドーナツ型の撮影装置の中を通ります\n4. 撮影装置から息を止めるよう指示があります（約10秒）\n5. 撮影完了後、着替えて終了です",
                'duration'     => 20,
                'precautions'  => "・金属類・アクセサリーは外してください\n・妊娠中または妊娠の可能性がある方は検査できない場合があります",
                'is_published' => true,
                'order'        => 0,
            ],

            // MRI検査（category：3）
            [
                'category_id'  => 3,
                'title'        => '頭部MRI検査',
                'slug'         => 'head-mri',
                'description'  => '磁気と電波を使って断面画像を作成し、脳や脊髄を詳しく調べる検査です。放射線を使用しないため、被ばくの心配がありません。検査中に大きな音がします。',
                'purpose'      => "脳梗塞・脳出血・脳腫瘍の有無確認\n認知症の評価",
                'procedure'    => "1. 検査着に着替え、金属類をすべて外します。\n2. 寝台に仰向けになります\n3. 頭部に専用コイルを装着します\n4. 筒状の装置内に入ります（約15～20分）",
                'duration'     => 30,
                'precautions'  => "・ペースメーカーを装着されている方は検査できません\n・金属製のインプラント・クリップがある方は事前にお申し出ください\n・閉所恐怖症の方は事前にご相談ください\n・アクセサリー・磁気カード・補聴器・スマートフォンは撮影室に持ち込まないでください",
                'is_published' => true,
                'order'        => 0,
            ],

            // エコー検査（category_id：4）
            [
                'category_id'  => 4,
                'title'        => '腹部エコー検査',
                'slug'         => 'abdomen-us',
                'description'  => '腹部エコー検査は、超音波を使って肝臓・膵臓・腎臓などの腹部臓器を調べる検査です。放射線を使用しないため、被ばくの心配はありません。',
                'purpose'      => "肝臓・胆嚢・膵臓・腎臓の腫瘍・結石の有無\n脂肪肝・肝硬変の評価\n腹水の確認",
                'procedure'    => "1. 寝台で仰向けになります\n2. お腹にゼリーを塗ります\n3. プローブ（探触子）をお腹に当てて観察します\n4. 検査時間は約20分です\n. ゼリーを拭いて終了です。",
                'duration'     => 20,
                'precautions'  => "・検査5～6時間前から絶食してください\n・前日の夜以降は脂っこいものは避けてください\n・（膀胱充満が必要な場合）できるだけ検査前は排尿の我慢をお願いします",
                'is_published' => true,
                'order'        => 0,
            ],
        ];

        foreach ($examinations as $examination) {
                Examination::create($examination);
            }
    }
}
