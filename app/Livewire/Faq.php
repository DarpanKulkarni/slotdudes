<?php

namespace App\Livewire;

use App\Models\Faq as FaqModel;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        return view('livewire.faq', [
            'faqs' => FaqModel::all(),
        ]);
    }
}
