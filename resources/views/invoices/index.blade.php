<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoice</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                    <div class="flex gap-2">
                        <input id="search-input" type="text" value="{{ $search }}"
                               placeholder="Cari nama proyek..."
                               class="border-gray-300 rounded-md shadow-sm">
                        <select id="status-filter" class="border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="unpaid" @selected($status === 'unpaid')>Unpaid</option>
                            <option value="paid" @selected($status === 'paid')>Paid</option>
                            <option value="overdue" @selected($status === 'overdue')>Overdue</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('invoices.export.pdf', request()->query()) }}" class="bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700 text-sm">Export PDF</a>
                        <a href="{{ route('invoices.export.excel', request()->query()) }}" class="bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 text-sm">Export Excel</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('invoices.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">+ Tambah Invoice</a>
                        @endif
                    </div>
                </div>

                <div id="invoice-table">
                    @include('invoices.partials.table', ['invoices' => $invoices])
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function () {
            let timer;
            function doSearch() {
                $.ajax({
                    url: '{{ route('invoices.index') }}',
                    data: { search: $('#search-input').val(), status: $('#status-filter').val() },
                    success: function (html) { $('#invoice-table').html(html); }
                });
            }
            $('#search-input').on('keyup', function () { clearTimeout(timer); timer = setTimeout(doSearch, 400); });
            $('#status-filter').on('change', doSearch);

            $(document).on('click', '#invoice-table .pagination a', function (e) {
                e.preventDefault();
                $.get($(this).attr('href'), { search: $('#search-input').val(), status: $('#status-filter').val() }, function (html) {
                    $('#invoice-table').html(html);
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
