<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsTableSeeder extends Seeder
{
    var array $faqs = [
        [
            'question' => 'Who runs SlotDudes.com and why was the site created?',
            'answer' => 'SlotDudes.com is run by a small team of online casino enthusiasts from Sweden with long-term experience in online gambling. The site was created to help players find reliable casinos and slots, and better understand games, bonuses, and responsible play.',
        ],
        [
            'question' => 'How do you choose which online casinos to recommend?',
            'answer' => 'Casinos are evaluated based on licensing, game selection, software providers, payment options, withdrawal speed, bonus terms, and overall reputation. Only casinos that meet strict quality criteria are included in our recommended lists.',
        ],
        [
            'question' => 'Are your casino reviews truly independent and unbiased?',
            'answer' => 'Yes. All reviews are written independently and based on research, testing, and user feedback. While we may earn commissions from partners, this does not influence our ratings or opinions of any casino.',
        ],
        [
            'question' => 'What does RTP mean in online slots?',
            'answer' => 'RTP stands for Return to Player and represents the theoretical percentage of wagered money a slot returns to players over time. A higher RTP generally means better long-term payout potential.',
        ],
        [
            'question' => 'How often do you update your casino & slot reviews?',
            'answer' => 'We update our content continuously by reviewing and adding new casinos and slot games whenever we find ones that meet our standards and are worth featuring on SlotDudes.',
        ],
        [
            'question' => 'Can I use cryptocurrencies to play at online casinos?',
            'answer' => 'Yes, many online casinos accept cryptocurrencies such as Bitcoin or Ethereum, depending on the casino and location. If a casino listed on SlotDudes accepts crypto, we clearly note this in our review.',
        ],
        [
            'question' => 'What should I do if I have a problem with a casino?',
            'answer' => 'If you experience issues, first contact the casino’s customer support. If the problem remains unresolved, you can reach out to the casino’s licensing authority or use independent dispute-resolution services for assistance.',
        ],
        [
            'question' => 'Are there resources for gambling addiction help?',
            'answer' => 'Yes. We encourage responsible gambling and provide links to professional organizations that offer support, self-exclusion tools, and confidential help for anyone experiencing gambling-related problems.',
        ],
        [
            'question' => 'What kind of content do you post on social media from SlotDudes?',
            'answer' => 'Our social media mainly showcases slot games we are currently testing, including both new releases and established titles, so followers can see what we’re playing and which slots we consider worth trying.',
        ],
        [
            'question' => 'Can I suggest a casino or slot for you to review on SlotDudes?',
            'answer' => 'Yes. Visitors are welcome to suggest online casinos or slot games for review. All suggestions are carefully evaluated, and only those that meet our quality and safety standards are featured on the site.',
        ],
        [
            'question' => 'Do you review traditional land-based casinos?',
            'answer' => 'No, SlotDudes is dedicated to online casinos and slot games. Occasionally, our blog may feature news or stories about land-based casinos, but we do not review them.',
        ],
        [
            'question' => 'Can I play slots for free before playing with real money?',
            'answer' => 'Many online casinos let players try slots in free-mode using virtual credits. This allows visitors to explore game features and mechanics before deciding whether to play with real money.',
        ],
        [
            'question' => 'Are casino bonuses worth claiming?',
            'answer' => 'Casino bonuses can be valuable, but they always come with terms and wagering requirements. It’s important to read the conditions carefully to decide whether a bonus suits your playing style and budget.',
        ],
        [
            'question' => 'How long do casino withdrawals usually take?',
            'answer' => 'Withdrawal times vary depending on the casino and payment method. E-wallets and cryptocurrencies are often fastest, while bank transfers may take several business days to process and receive.',
        ],
        [
            'question' => 'What payment methods are most common at online casinos?',
            'answer' => 'Common payment methods include debit and credit cards, bank transfers, e-wallets like Skrill or Neteller, and cryptocurrencies. Availability depends on the casino, player location, and local regulations.',
        ],
        [
            'question' => 'Are winnings from online slots taxable?',
            'answer' => 'Tax rules vary by country and individual circumstances. In some regions, gambling winnings are tax-free, while in others they must be reported. Players should always check local tax laws or consult a professional.',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->truncate();

        foreach ($this->faqs as $index => $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $index + 1,
            ]);
        }
    }
}
