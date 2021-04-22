<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Listing as ModelListing;

class Listing extends Component
{
    public $showModal = false;
    public $editMode = false;

    public $name;
    public $address;
    public $website;
    public $email;
    public $phone;
    public $bio;

    protected $rules = [
        'name' => 'required',
        'address' => 'required',
        'website' => 'required|url',
        'email' => 'required|email',
        'phone' => 'required',
        'bio' => 'required|max:255',
    ];

    public function showCreateModal()
    {
        $this->showModal = true;
    }
    public function showEditModal($id)
    {
        $this->showModal = true;
        $this->editMode = true;
    }

    public function createLisitng()
    {
        $this->validate();

        Auth::user()->listings()->create([
            'name' => $this->name,
            'address' => $this->address,
            'website' => $this->website,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio
        ]);

        $this->reset();
    }

    public function deleteListing($id)
    {
        $listing = ModelListing::findOrFail($id);
        $listing->delete();
    }

    public function render()
    {
        return view('livewire.listing', [
            'listings' => Auth::user()->listings
        ]);
    }
}
