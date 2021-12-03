<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Author
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-lg-12 mb-4">
                        <form method="POST" action="{{ url('dashboard/authors') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="example: Joko" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ url('dashboard/authors') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
