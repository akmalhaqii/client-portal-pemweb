<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Klien</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between mb-4">
                    <input id="search-input" type="text" value="{{ $search }}"
                           placeholder="Cari nama, perusahaan, atau telepon..."
                           class="border-gray-300 rounded-md shadow-sm w-1/3 focus:ring-indigo-500 focus:border-indigo-500">
                    <a href="{{ route('clients.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        + Tambah Klien
                    </a>
                </div>

                <div id="client-table">
                    @include('clients.partials.table', ['clients' => $clients])
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function () {
            let searchTimer;
            $('#search-input').on('keyup', function () {
                clearTimeout(searchTimer);
                const value = $(this).val();
                searchTimer = setTimeout(function () {
                    $.ajax({
                        url: '{{ route('clients.index') }}',
                        data: { search: value },
                        success: function (html) {
                            $('#client-table').html(html);
                        }
                    });
                }, 400);
            });

            // Pagination link tetap berfungsi via AJAX
            $(document).on('click', '#client-table .pagination a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.get(url, { search: $('#search-input').val() }, function (html) {
                    $('#client-table').html(html);
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
