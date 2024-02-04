<?php

namespace App\Http\Controllers;

use App\Models\UrlShortner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UrlShortnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }

        $urls = UrlShortner::where('user_id', auth()->user()->id)->get();
        return view('frontend.url.index', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }

        return view('frontend.url.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }
        $request->validate([
            'main_url' => 'required',

        ]);
        $urlShortner = new UrlShortner();
        $urlShortner->main_url = $request->main_url;
        $urlShortner->short_url = $this->generateShortUrl();
        $urlShortner->user_id = auth()->user()->id;
        $urlShortner->save();
        return redirect()->route('url.index');

    }
    public function generateShortUrl()
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }
        $shortUrl = Str::random(5);
        if (UrlShortner::where('short_url', $shortUrl)->exists()) {
            $this->generateShortUrl();
        }
        return $shortUrl;
    }
    public function hits(Request $request)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }
        $urlShortner = UrlShortner::where('short_url', $request->short_url)->first();
        $urlShortner->hits = $urlShortner->hits + 1;
        $urlShortner->save();
        return redirect($urlShortner->main_url);
    }

    /**
     * Display the specified resource.
     */
    public function show(UrlShortner $urlShortner)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }
        $shortUrl = UrlShortner::find($urlShortner->id);
        return view('frontend.url.show', compact('shortUrl'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }

        $shortUrl = UrlShortner::find($id);
        return view('frontend.url.edit', compact('shortUrl'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }

        $request->validate([
            'main_url' => 'required|url',
        ]);
        $shortUrl = UrlShortner::find($id);
        $shortUrl->main_url = $request->main_url;
        $shortUrl->short_url = $this->generateShortUrl();
        $shortUrl->save();
        return redirect()->route('url.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Gate::allows('url_access')) {
            abort(403);
        }

        $shortUrl = UrlShortner::find($id);
        $shortUrl->delete();
        return redirect()->route('url.index');
    }
}
