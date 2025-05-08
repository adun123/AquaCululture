<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Manajemen Akun User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('users.index') }}" class="p-6 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                            <h3 class="text-lg font-semibold mb-2">Manajemen User</h3>
                            <p class="text-gray-600">Kelola akun user, tambah, edit, atau hapus user</p>
                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>