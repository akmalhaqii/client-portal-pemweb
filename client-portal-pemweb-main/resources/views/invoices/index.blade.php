<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Data Invoice
                </h2>
                <p class="text-sm text-slate-500 mt-1">Kelola penagihan dan pembayaran proyek</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex justify-between items-center relative" x-transition>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-emerald-700 font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input id="search-input" type="text" value="{{ $search }}"
                                   placeholder="Cari invoice..."
                                   class="pl-10 w-full sm:w-64 border-slate-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-shadow">
                        </div>
                        <select id="status-filter" class="border-slate-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-shadow">
                            <option value="">Semua Status</option>
                            <option value="unpaid" @selected($status === 'unpaid')>Unpaid</option>
                            <option value="paid" @selected($status === 'paid')>Paid</option>
                            <option value="overdue" @selected($status === 'overdue')>Overdue</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('invoices.export.pdf', request()->query()) }}" class="inline-flex items-center bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-red-600 transition-colors text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            PDF
                        </a>

                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('invoices.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-colors text-sm font-medium shadow-sm shadow-indigo-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Invoice
                            </a>
                        @endif
                    </div>
                </div>

                <div id="invoice-table" class="overflow-x-auto">
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
                $('#invoice-table').css('opacity', '0.5');
                $.ajax({
                    url: '{{ route('invoices.index') }}',
                    data: { search: $('#search-input').val(), status: $('#status-filter').val() },
                    success: function (html) { 
                        $('#invoice-table').html(html).css('opacity', '1'); 
                    }
                });
            }
            $('#search-input').on('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(doSearch, 400);
            });
            $('#status-filter').on('change', doSearch);

            $(document).on('click', '#invoice-table .pagination a', function (e) {
                e.preventDefault();
                $('#invoice-table').css('opacity', '0.5');
                $.get($(this).attr('href'), { search: $('#search-input').val(), status: $('#status-filter').val() }, function (html) {
                    $('#invoice-table').html(html).css('opacity', '1');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
