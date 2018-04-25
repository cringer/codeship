<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function manageUrl(Request $request, Store $session, Shortner $shortner)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'url' => 'required|url|unique:urls,original_url',
            ]);
        }

        $this->saveAndFlash($request, $session, $shortner);
    }

    private function saveAndFlash(Request $request, Store $session, Shortner $shortner) {
        $message = $this->save($request, $shortner) ? 'Record saved' : 'Record NOT saved';
        $session->flash('message', $message);
    }
}
