<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500">Keranjang belanja Anda kosong</p>
                    <a href="{{ route('user.dashboard') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Lanjutkan Belanja
                    </a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="py-4 flex flex-col md:flex-row items-start md:items-center gap-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($item->product->photo)
                                            <img src="{{ asset('storage/'.$item->product->photo) }}" 
                                                 alt="{{ $item->product->nama }}" 
                                                 class="w-20 h-20 object-cover rounded">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-500 text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="flex-grow">
                                        <h3 class="font-semibold">{{ $item->product->nama }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $item->product->category }}</p>
                                        <p class="text-green-600 font-bold mt-1">
                                            Rp {{ number_format($item->product->harga) }}
                                        </p>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('cart.update', $item) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->jumlah }}"
                                                   class="w-16 text-center border rounded">
                                            <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                        
                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Subtotal -->
                                    <div class="font-semibold">
                                        Rp {{ number_format($item->quantity * $item->product->harga) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Cart Summary -->
                        <div class="mt-6 border-t pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg">Total:</span>
                                <span class="font-bold text-lg">Rp {{ number_format($total) }}</span>
                            </div>
                            
                            <div class="mt-6 flex justify-between">
                                <a href="{{ route('user.dashboard') }}" 
                                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                                    Lanjutkan Belanja
                                </a>
                                <button class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
                                    Proses Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>