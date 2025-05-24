<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\Cart;            // <-- Nouveau import
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $clients  = User::where('role', 'client')->count();
        $products = ProductModel::count();
        $product  = ProductModel::all();

        return view('client.dashboard', compact('product', 'products', 'clients'));
    }

    public function profile()
    {
        return view('user-profile.user-profile');
    }

    /**
     * Affiche le panier de l'utilisateur, avec option de tri.
     */
    public function cart(Request $request)
    {
        // On part de la requête Eloquent pour récupérer le panier de l'utilisateur
        $query = Cart::where('user_id', auth()->id());

        // Application du tri si le paramètre 'sort' est présent
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    // Tri par prix total croissant (quantité × prix unitaire)
                    $query->orderByRaw('qte * price ASC');
                    break;
                case 'price_desc':
                    // Tri par prix total décroissant
                    $query->orderByRaw('qte * price DESC');
                    break;
                case 'category':
                    // Tri par nom de catégorie (marke)
                    $query->orderBy('marke', 'asc');
                    break;
            }
        }

        $cartItems = $query->get();

        // On renvoie la vue en passant les items et la valeur de tri pour garder le select synchronisé
        return view('client.cart', [
            'cart' => $cartItems,
            'currentSort' => $request->sort,
        ]);
    }
}
