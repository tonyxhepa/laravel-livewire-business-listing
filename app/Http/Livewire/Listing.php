<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Listing as ModelListing;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editMode = false;
    public $listingId;
    public $search = '';

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

    public function updatedShowModal()
    {
        $this->editMode = false;
    }

    public function showCreateModal()
    {
        $this->showModal = true;
    }
    public function showEditModal($id)
    {
        $this->showModal = true;
        $this->editMode = true;
        $this->listingId = $id;

        $listing = ModelListing::find($id);
        $this->name = $listing->name;
        $this->address = $listing->address;
        $this->website = $listing->website;
        $this->email = $listing->email;
        $this->phone = $listing->phone;
        $this->bio = $listing->bio;
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
        session()->flash('flash.banner', 'Listing created successfuly');
        $this->reset();
    }

    public function listingUpdate()
    {
        $this->validate();

        $listing = ModelListing::find($this->listingId);

        $listing->update([
             'name' => $this->name,
            'address' => $this->address,
            'website' => $this->website,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio
        ]);
        session()->flash('flash.banner', 'Listing updated successfuly');
        $this->reset();
    }

    public function deleteListing($id)
    {
        $listing = ModelListing::findOrFail($id);
        $listing->delete();
        session()->flash('flash.banner', 'Listing deleted successfuly');
    }

    public function render()
    {
        $listings = Auth::user()->listings()->paginate(2);
        if ($this->search) {
            $listings = Auth::user()
            ->listings()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(2);
        }
        return view('livewire.listing', [
            'listings' => $listings
        ]);
    }
}
