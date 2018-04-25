<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function manageUrl(Request $request, Store $session, Shortener $shortener)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'url' => 'required|url|unique:urls,original_url',
            ]);
        }

        $this->saveAndFlash($request, $session, $shortener);
    }

    public function viewUrls(Store $session)
    {
        $urls = Url::all();

        return view('url.view', [
            'urls' => $urls,
            'message' => $session->get('message'),
        ]);
    }

    private function save(Request $request, Shortener $shortener)
    {
        $url = new Url();
        $url->original_url = $request->input('url');
        $url->shortened_url = $shortener->shorten($request->input('url'));

        return $url->saveOrFail();
    }

    private function saveAndFlash(Request $request, Store $session, Shortener $shortener) {
        $message = $this->save($request, $shortener) ? 'Record saved' : 'Record NOT saved';
        $session->flash('message', $message);
    }
}
