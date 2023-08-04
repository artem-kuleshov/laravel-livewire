<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users')]
class LiveTable extends Component
{
    use WithPagination;

    public $sortField = 'name'; // default sorting field
    public $sortAsc = true; // default sort direction
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function delete(int $id, string $name)
    {
        User::find($id)->delete();
        $this->dispatch('user-deleted', user_name: $name);
    }

    #[On('user-created')]
    public function triggerRefresh($user_name)
    {
        return $this->render();
    }

    public function render()
    {
        return view('livewire.live-table', [
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate(10),
        ]);
    }
}
