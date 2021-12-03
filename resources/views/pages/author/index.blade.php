<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Authors
        </h2>
        <a class="btn btn-primary" href="{{ url('dashboard/authors/create') }}">Create Author</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataAuthor as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('dashboard/authors/'.$item->id) }}" class="btn btn-warning" style="color: white">
                                                Edit
                                            </a>
                                            <a href="{{ url('dashboard/authors/delete/'.$item->id) }}" class="btn btn-danger" style="color: white">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
