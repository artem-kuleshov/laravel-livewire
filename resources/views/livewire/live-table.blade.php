<div class="container mt-3 mb-3" x-on:user-created="console.log('ХКЙЙЙЙЙЙЙЙЙЙЙЙЙ');">
    <div class="row mb-4">
        <div class="col-md-12">

            <div class="float-left mb-5 ">
                <button class="btn btn-success" @click="$dispatch('triggerCreate')">Create New User</button>
            </div>

            <div class="float-right mt-5">
                <input wire:model="search" class="form-control" type="text" placeholder="Search Users...">
            </div>
        </div>
    </div>

    <div class="row">
        @if ($users->count())
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <a wire:click.prevent="sortBy('id')" role="button" href="#">
                            id
                            @include('includes.sort-icon', ['field' => 'id'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('name')" role="button" href="#">
                            Name
                            @include('includes.sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('email')" role="button" href="#">
                            Email
                            @include('includes.sort-icon', ['field' => 'email'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('address')" role="button" href="#">
                            Address
                            @include('includes.sort-icon', ['field' => 'address'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('age')" role="button" href="#">
                            Age
                            @include('includes.sort-icon', ['field' => 'age'])
                        </a>
                    </th>
                    <th>
                        <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                            Created at
                            @include('includes.sort-icon', ['field' => 'created_at'])
                        </a>
                    </th>
                    <th>
                        Delete
                    </th>
                    <th>
                        Edit
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->created_at->format('m-d-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $user->id }}, '{{ $user->name }}')">
                                Delete
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-dark" wire:click="$emitTo('user-form', 'triggerEdit', {{ $user }})">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Your query returned zero results.
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col">
            {{ $users->links() }}
        </div>
    </div>

    <!-- add this -->
    <div class="modal" tabindex="-1" role="dialog" id="user-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <livewire:user-form/>
                </div>
            </div>
        </div>
    </div>
</div>


