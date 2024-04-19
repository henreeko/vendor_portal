<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class DeletedUsers extends Component
{
    use WithPagination;
    

    public function refreshComponent()
    {
        $this->render();
    }

    protected $listeners = ['restore' => 'restore', 'forceDelete' => 'forceDelete'];

    public function render()
    {
        $deletedUsers = User::onlyTrashed()->paginate(10);
        return view('livewire.admin.deleted-users', compact('deletedUsers'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $this->emit('showToast', 'success', 'User restored successfully.');
        $this->emitSelf('refreshComponent');
    }

    public function forceDelete($id, $password)
    {
        if (!Hash::check($password, auth()->user()->password)) {
            $this->emit('showToast', 'error', 'Password verification failed.');
            return;
        }

        $user = User::onlyTrashed()->findOrFail($id);

        if ($user) {
            $user->forceDelete();
            $this->emit('showToast', 'success', 'User permanently deleted.');
        } else {
            $this->emit('showToast', 'error', 'User not found.');
        }

        $this->emitSelf('refreshComponent');
    }
}