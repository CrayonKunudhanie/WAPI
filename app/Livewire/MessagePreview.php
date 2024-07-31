<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Broadcast; 

class MessagePreview extends Component
{
    use WithFileUploads;

    public $bcname;
    public $waktu;
    public $image;
    public $message = '';
    public $buttonUrl = '';
    public $buttonText = "CEK SEKARANG";
    public $showButton = false;

    public $customError = '';

    protected $rules = [
        'bcname' => 'required|string|max:300',
        'waktu' => 'required|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,heic|max:1024',
        'message' => 'string|max:1000',
        'buttonUrl' => 'string|max:255|url',
    ];

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
        $this->customError = '';

        try {
            $this->validateOnly($propertyName);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($propertyName == 'image') {
                $this->customError = 'Mohon maaf, file yang dapat diupload hanya gambar.';
            }
        }
    }

    public function addName()
    {
        $this->message .= ' {{ nama }}';
        logger('Message updated:', ['message' => $this->message]);
    }

    public function store()
    {

        $this->validate();

        $broadcast = new Broadcast();
        $broadcast->bcname = $this->bcname;
        $broadcast->waktu = $this->waktu;
        $broadcast->message = $this->message;
        $broadcast->showButton= $this->showButton;
        $broadcast->buttonText = $this->buttonText;
        $broadcast->buttonUrl = $this->buttonUrl;

        if ($this->image) {
            $imageName = $this->image->store('images', 'public');
            $broadcast->image = $imageName;
        }

        $broadcast->save();

        session()->flash('message', 'Broadcast tersimpan!');
    }

    public function render()
    {
        return view('livewire.message-preview');
    }
}
