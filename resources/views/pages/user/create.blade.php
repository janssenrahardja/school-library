<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-lg-12 mb-4">
                        <form method="POST" action="{{ url('dashboard/users') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option disabled @if (old('role') == null) selected @endif>Select Role</option>
                                            <option value="admin" @if (old('role') == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if (old('role') == 'user') selected @endif>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="example: Joko" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example: joko@gmail.com" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="name">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ url('dashboard/users') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
