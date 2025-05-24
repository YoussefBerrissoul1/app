<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdminDashbord extends Controller
{
    public function index()
    {
        return view("Admin.main", [
            "clients" => User::where("role", "client")->count(),
            "message" => Message::latest()->get(),
            "products" => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count()
        ]);
    }

    public function profile()
    {
        return view('user-profile.user-profile', [
            'message' => Message::latest()->get()
        ]);
    }

    public function edite()
    {
        return view("user-profile.edite-profile", [
            'message' => Message::latest()->get()
        ]);
    }

    public function store(Request $request)
{
    $user = auth()->user();

    // Validation des données
    $validated = $request->validate([
        'name' => 'required',
        'bithdate' => 'required|date',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'adriss' => 'required',
        'city' => 'required',
        'contry' => 'required',
        'pinecode' => 'required',
        'phone' => 'required',
        'password' => 'nullable|confirmed', // Permet de ne pas exiger le mot de passe
    ]);

    // Remplir uniquement les champs autres que le mot de passe
    $user->fill(array_filter($validated, function ($key) {
        return $key !== 'password';
    }, ARRAY_FILTER_USE_KEY));

    // Mettre à jour le mot de passe uniquement s'il est fourni
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('avatar')) {
        // Supprimer l'ancien avatar s'il existe
        if ($user->avatar && Storage::exists(str_replace('storage/', 'public/', $user->avatar))) {
            Storage::delete(str_replace('storage/', 'public/', $user->avatar));
        }

        $file = $request->file("avatar");
        $name = "avatar_" . time() . "_" . $user->id . "." . $file->extension();
        Storage::putFileAs('public/avatars', $file, $name);
        $user->avatar = 'storage/avatars/' . $name; // Chemin complet pour l'URL publique
    } elseif ($request->input('check') === "removed") {
        // Supprimer l'avatar si l'utilisateur clique sur "remove"
        if ($user->avatar && Storage::exists(str_replace('storage/', 'public/', $user->avatar))) {
            Storage::delete(str_replace('storage/', 'public/', $user->avatar));
        }
        $user->avatar = null;
    }

    $user->save();

    return redirect()->route("admin.profile")->with('success', 'Profil mis à jour avec succès');
}
    public function listclient()
    {
        return view('client.listC', [
            'client' => User::where('role', 'client')->where('status', 'active')->paginate(5),
            'clients' => User::where("role", "client")->count(),
            'products' => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count(),
            'message' => Message::latest()->get(),
        ]);
    }

    public function serchclinet(Request $request)
    {
        $search = $request->search;

        $client = User::where('role', 'client')
            ->where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('adriss', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('client.listC', [
            'client' => $client,
            'clients' => User::where("role", "client")->count(),
            'products' => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count(),
            'message' => Message::latest()->get(),
        ]);
    }

    public function listnoir($id)
    {
        $client = User::find($id);
        if ($client && $client->status == 'active') {
            $client->update(['status' => 'desactive']);
        }
        return redirect()->route('admin.list');
    }

    public function listnC()
    {
        return view('client.listnc', [
            'client' => User::where('role', 'client')->where('status', 'desactive')->paginate(5),
            'clients' => User::where("role", "client")->count(),
            'products' => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count(),
            'message' => Message::latest()->get(),
        ]);
    }

    public function clientlistnoir(Request $request)
    {
        $search = $request->search;

        $client = User::where('role', 'client')
            ->where('status', 'desactive')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('adriss', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('client.listnc', [
            'client' => $client,
            'clients' => User::where("role", "client")->count(),
            'products' => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count(),
            'message' => Message::latest()->get(),
        ]);
    }

    public function listC($id)
    {
        $client = User::find($id);
        if ($client && $client->status == 'desactive') {
            $client->update(['status' => 'active']);
        }
        return redirect()->route('admin.list');
    }

    public function getmessage()
    {
        return view('admin.main', [
            'message' => Message::latest()->get()
        ]);
    }

    public function toutmessage()
    {
        return view('message.message', [
            'message' => Message::latest()->get(),
            'products' => ProductModel::count(),
            'orderliv' => Order::where('statuscmd', 'livree')->count(),
            'orders' => Order::where('statuscmd', 'En attente')->count(),
            'clients' => User::where("role", "client")->count(),
        ]);
    }

    public function clientDetails($id)
    {
        $user = User::findOrFail($id);

        return view('client.clientDetails', [
            'message' => Message::latest()->get(),
            'user' => $user,
            'orders' => Order::where('name', $user->id)->where('statuscmd', 'En attente')->get(),
            'orderliv' => Order::where('name', $user->id)->where('statuscmd', 'livree')->get(),
        ]);
    }
}