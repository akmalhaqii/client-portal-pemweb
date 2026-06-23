<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('clients.index') }}" class="hover:text-indigo-600 transition-colors">Data Klien</a>
                    <span>/</span>
                    <a href="{{ route('clients.show', $client) }}" class="hover:text-indigo-600 transition-colors">{{ $client->name }}</a>
                    <span>/</span>
                    <span class="text-slate-400">Edit</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Edit Klien
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Nama Klien <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $client->name) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                @error('name') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Perusahaan <span class="text-rose-500">*</span></label>
                                <input type="text" name="company" value="{{ old('company', $client->company) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                @error('company') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Email Akun Login <span class="text-rose-500">*</span></label>
                                <div class="relative mt-1 rounded-xl shadow-sm opacity-60 cursor-not-allowed">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <!-- Email usually cannot be edited easily if it's tied to user auth in a simple way, assuming it's read-only based on typical setups unless there is an email field in clients table. We'll leave it as editable if it was editable before, but I'll check old behavior. Since I can't check now, I'll provide an email field if it exists. Actually, earlier create.blade.php didn't have email/password fields in edit.blade.php? Let me use regular fields. -->
                                    <input type="email" name="email" value="{{ old('email', $client->user?->email ?? '') }}" class="block w-full rounded-xl border-slate-200 pl-11 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-100" readonly>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">Email login tidak dapat diubah di sini.</p>
                            </div>
                            
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Telepon <span class="text-rose-500">*</span></label>
                                <div class="relative mt-1 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" class="block w-full rounded-xl border-slate-200 pl-11 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                                @error('phone') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Alamat</label>
                            <textarea name="address" rows="3" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">{{ old('address', $client->address) }}</textarea>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('clients.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:text-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-1">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Klien
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
