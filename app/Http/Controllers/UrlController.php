<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use LeadThread\Shortener\Shortener;

class UrlController extends Controller
{
    public function manageUrl(Request $request, Shortener $shortener)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'url' => 'required|url|unique:urls,original_url',
            ]);
        }

        $this->saveAndFlash($request, $shortener);

        return view('url.manage', []);
    }

    public function viewUrls(Request $request)
    {
        $urls = Url::all();

        return view('url.view', [
            'urls' => $urls,
            'message' => $request->session()->get('message'),
        ]);
    }

    private function save(Request $request, Shortener $shortener)
    {
        $url = new Url();
        $url->original_url = $request->input('url');
        $url->shortened_url = $shortener->shorten($request->input('url'));

        return $url->saveOrFail();
    }

    private function saveAndFlash(Request $request, Shortener $shortener) {
        $message = $this->save($request, $shortener) ? 'Record saved' : 'Record NOT saved';
        $request->session()->flash('message', $message);
    }
}
