<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Debug Page
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">

            <h2 class="text-xl font-bold mb-4">
                Debug User Info
            </h2>

            <p class="mb-2">
                Name: {{ auth()->user()->name }}
            </p>

            <p class="mb-2">
                Email: {{ auth()->user()->email }}
            </p>

            <p class="mb-4">
                Role:
                <span class="font-bold text-blue-600">
                    {{ auth()->user()->role }}
                </span>
            </p>

            @if(auth()->user()->role === 'admin')
                <div class="p-3 bg-green-100 text-green-700 rounded">
                    ADMIN DETECTED
                </div>
            @elseif(auth()->user()->role === 'tailor')
                <div class="p-3 bg-yellow-100 text-yellow-700 rounded">
                    TAILOR DETECTED
                </div>
            @else
                <div class="p-3 bg-gray-100 text-gray-700 rounded">
                    USER DETECTED
                </div>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded">
                    Logout
                </button>
            </form>

        </div>
    </div>
</x-app-layout>