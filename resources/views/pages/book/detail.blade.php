<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Book Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-lg-12 mb-4">
                        <form method="POST" action="{{ url('dashboard/books/'.$data->id) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="author">Author</label>
                                        <select class="form-control" name="author_id" id="author_id" required>
                                            <option disabled @if (old('author_id') == null) selected @endif>Select Author</option>
                                            @foreach ($dataAuthor as $author)
                                            <option @if( $data->author_id === $author->id) selected @endif value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="example: Title 1" value="{{ $data->title }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="example: lorem ipsum dolor sit amet" value="{{ $data->description }}" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ url('dashboard/books') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
