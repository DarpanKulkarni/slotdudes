<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    var array $faqs = [
        [
            'question' => 'Who runs SlotDudes.com and why did you start it?',
            'answer' => null,
        ],
        [
            'question' => 'How do you decide which casinos make it to your “Top Casinos We Recommend” list?',
            'answer' => null,
        ],
        [
            'question' => 'Are your casino reviews truly independent and unbiased?',
            'answer' => null,
        ],
        [
            'question' => 'What does RTP mean in online slots?',
            'answer' => null,
        ],
        [
            'question' => 'How often do you update your casino reviews and rankings?',
            'answer' => null,
        ],
        [
            'question' => 'Can I use cryptocurrencies to play at online casinos?',
            'answer' => null,
        ],
        [
            'question' => 'What should I do if I have a problem with a casino?',
            'answer' => null,
        ],
        [
            'question' => 'Are there resources for gambling addiction help?',
            'answer' => null,
        ],
        [
            'question' => 'What kind of content do you post on Instagram from SlotDudes?',
            'answer' => null,
        ],
        [
            'question' => 'Can I suggest a casino for you to review on SlotDudes?',
            'answer' => null,
        ],
        [
            'question' => 'Do you review traditional land-based casinos?',
            'answer' => null,
        ],
        [
            'question' => 'Can I play slots for free before playing with real money?',
            'answer' => null,
        ],
        [
            'question' => 'Are casino bonuses worth claiming?',
            'answer' => null,
        ],
        [
            'question' => 'How long do casino withdrawals usually take?',
            'answer' => null,
        ],
        [
            'question' => 'What payment methods are most common at online casinos?',
            'answer' => null,
        ],
        [
            'question' => 'Are winnings from online slots taxable?',
            'answer' => null,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->faqs as $index => $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $index + 1,
            ]);
        }
    }
}
