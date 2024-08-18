@extends('admin.layout')
@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">All Users</h1>
        </div>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b w-32">Nama</th>
                    <th class="py-2 px-4 border-b">Username</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $index => $u)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $u->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $u->username }}</td>
                        <td class="py-2 px-4 border-b">{{ $u->email }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('deleteuser', $u->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
