<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::where(['user_id'=>Auth::id()])->get();
        return view('urls.index', compact('urls'));
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = Auth::user();

        if ($user->urls()->count() >= 10) {
            return response()->json(['error' => 'You have reached the maximum number of shortened URLs.'], 403);
        }

        do {
            $shortUrl = Str::random(6);
        } while (Url::where('short_url', $shortUrl)->exists());

        if($request->id){
            $url = Url::find($request->id);
        }else{
            $url = new Url();
        }
        $url->user_id=$user->id;
        $url->original_url=$request->original_url;
        $url->short_url=$shortUrl;
        $url->save();

        return response()->json(['short_url' => url('/' . $url->short_url)]);
    }

    public function edit(Url $url)
    {
        return view('urls.create', compact('url'));
    }

    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('url.index')->with('success', 'Url deleted successfully.');
    }

    public function disable(Url $url)
    {
        $url->is_disabled=1;
        $url->save();
        return redirect()->route('url.index')->with('success', 'Url deleted successfully.');
    }
}
