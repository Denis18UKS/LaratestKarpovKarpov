<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\App;

class AppController extends Controller
{
    public function index()
    {
        $apps = Auth::user()->role === 'admin'
            ? App::with('user')->get()
            : App::where('user_id', Auth::id())->get();

        return view('apps.index', compact('apps')); // Отображаем вид
    }


    public function showCreateForm()
    {
        return view('apps.create');
    }


    public function create(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:general_clearing,clearing_posle_remonta,clearing_office',
            'date_time' => 'required',
            'address' => 'required|string',
        ]);

        App::create([
            'service_type' => $request->service_type,
            'date_time' => $request->date_time,
            'address' => $request->address,
            'status' => 'new',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('apps.index')->with(['success' => 'Заявка успешно создана!']);
    }


    public function updateStatus(Request $request, $id)
    {
        $app = App::findOrFail($id);
        $app->status = $request->input('status');
        $app->save();

        return redirect()->back()->with('success', 'Статус успешно обновлен!');
    }

}

