@extends('admin.layout')
@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-10">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">All Confirmations</h1>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b w-32">Nama User</th>
                    <th class="py-2 px-4 border-b">Nama Barang</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Bukti</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konfirmasi as $index => $k)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $k['name'] }}</td>
                        <td class="py-2 px-4 border-b">{{ $k['nama'] }}</td>
                        <td class="py-2 px-4 border-b">{{ $k['harga'] }}</td>
                        <td class="py-2 px-4 border-b"><button type="button" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700" onclick="openModal('{{ asset('gambar/' . $k['bukti']) }}')">Lihat</button></td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('acceptKonfirmasi', $k['id_konfirmasi']) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-700">Terima</button>
                            </form>
                            <form action="{{ route('rejectKonfirmasi', $k['id_konfirmasi']) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-700 ml-2">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bukti Transfer</h3>
                            <div class="mt-2">
                                <img id="modalImage" src="" alt="Bukti" class="w-full">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
@endsection
