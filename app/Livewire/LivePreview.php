<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class LivePreview extends Component
{
    use WithFileUploads;

    public $image;
    public $message;
    public $tempImageUrl;

    public function updatedImage()
    {
        $this->tempImageUrl = $this->image->temporaryUrl();
    }

    public function render()
    {
        return view('livewire.live-preview');
    }
}
