<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';

    public $createUserForm = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public $editUserForm = [
        'name' => '',
        'email' => '',
        'profile_photo_url' => ''
    ];

    public $creatingUser = false;
    public $editingUser = false;
    public $userBeingEdited;
    public $confirmingUserDeletion = false;
    public $userBeingDeleted;
    public $photo = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function createUser()
    {
        $this->creatingUser= true;
    }

    public function store(CreatesNewUsers $creator)
    {
        // dd($this->createUserForm);
        event(new Registered($user = $creator->create($this->createUserForm)));

        $this->createUserForm = [];

        $this->creatingUser = false;
    }

    public function resetForm()
    {
        $this->createUserForm = [];

        $this->creatingUser = false;
    }

    public function editUser($userId)
    {
        $this->editingUser = true;

        $this->userBeingEdited = User::where(
            'id', $userId
        )->firstOrFail();

        // dd($this->userBeingEdited->profile_photo_url);
        // need a better solution why cant i access userBeingEdited->.. from component
        $this->photo = $this->userBeingEdited->profile_photo_url;

        $this->editUserForm['name'] = $this->userBeingEdited->name;
        $this->editUserForm['email'] = $this->userBeingEdited->email;
        $this->editUserForm['profile_photo_url'] = $this->userBeingEdited->profile_photo_url;
    }

    public function updateUser()
    {
        // $this->managingPermissionsFor->forceFill([
        //     'abilities' => Jetstream::validPermissions($this->updateApiTokenForm['permissions']),
        // ])->save();

        $this->editingUser = false;
    }

    public function confirmUserDeletion($userId)
    {
        $this->confirmingUserDeletion = true;

        $this->userBeingDeleted = $userId;
    }

    public function deleteUser()
    {
        User::where('id', $this->userBeingDeleted)->delete();

        $this->confirmingUserDeletion = false;
    }

    public function render()
    {
        return view('admin.users.users-table', [
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
