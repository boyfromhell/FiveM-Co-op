<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $name;
    public $email;
    public $password;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,' .Auth::user(),
            'email' => 'required|unique:users,email,' .Auth::user(),
            'password' => 'required',
        ];
    }

    /**
     * The livewire mount function
     *
     * @return void
     */
    public function mount()
    {
        // Resets the pagination after reloading the page
        $this->resetPage();
    }

    /**
     * Function to create new user.
     *
     * @return void
     */
    public function createUser()
    {
        $this->validate();
        User::create($this->modelData());

        $this->modalFormVisible = false;
        $this->resetVars();
    }

    /**
     * Function to update user.
     *
     * @return void
     */
    public function updateUser()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    /**
     * Function to delete user.
     *
     * @return void
     */
    public function deleteUser()
    {
        User::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Returns all Users in paginate
     *
     * @return void
     */
    public function read()
    {
        return User::paginate(5);
    }

    /**
     * Shows the form modal
     * of the create function.
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    /**
     * Shows the form modal
     * of the update function.
     *
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * Shows the delete confirmation modal.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
        $this->loadModel();
    }

    /**
     * Lodas the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = User::find($this->modelId);
        $this->name = $data->name;
        $this->email = $data->email;
    }

    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }

    /**
     * Resets all the variables
     * to null.
     *
     * @return void
     */
    public function resetVars()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->modelId = null;
    }

    /**
     * The livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.users', [
            'data' => $this->read(),
        ]);
    }
}
