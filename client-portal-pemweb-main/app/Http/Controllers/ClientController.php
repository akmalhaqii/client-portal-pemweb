<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Hanya admin yang boleh akses (lihat routes/web.php -> middleware role:admin)

    public function index(Request $request)
    {
        $search = $request->get('search');

        $clients = Client::with('user')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Mendukung pencarian via AJAX (jQuery) -> kembalikan partial table saja
        if ($request->ajax()) {
            return view('clients.partials.table', compact('clients'))->render();
        }

        return view('clients.index', compact('clients', 'search'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'company'  => 'nullable|string|max:255',
            'phone'    => 'nullable|string|max:30',
            'address'  => 'nullable|string',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8',
        ]);

        $userId = null;

        // Opsional: buat akun login untuk client jika email diisi
        if (! empty($validated['email'])) {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password'] ?? 'password'),
                'role'     => 'client',
            ]);
            $userId = $user->id;
        }

        Client::create([
            'user_id' => $userId,
            'name'    => $validated['name'],
            'company' => $validated['company'] ?? null,
            'phone'   => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('clients.index')->with('success', 'Klien berhasil ditambahkan.');
    }

    public function show(Client $client)
    {
        $client->load('projects');

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Data klien berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Klien berhasil dihapus.');
    }
}
