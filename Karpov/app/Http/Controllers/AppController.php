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
            'service_type' => 'required|in:general_clearing, clearing_posle_remonta, clearing_office',
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
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([

            'status' => 'required|in:new,success,declaimed',
        ]);

        $app = App::findOrFail($id);
        if (Auth::user()->role !== 'admin') {
            return back()->withErrors(['error' => 'Отказ в доступе']);
        }

        $app->update(['status' => $request->status]);
        return redirect()->route('apps.index')->with(['success' => 'Статус обновлён']);
    }
}
