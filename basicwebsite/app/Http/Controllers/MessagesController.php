<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessagesController extends Controller
{
    public function submit(Request $request) {
        // return $request->input('name');
        $this->validate($request,
        [
         'name' => 'required',
         'email' => 'required'
        ]
      );

      // Create New Message
      $message = new Message;
      $message->name = $request->input('name');
      $message->email = $request->input('email');
      $message->message = $request->input('message');
      // Save Message
      $message->save();

      // Redirect to homepage
      // return redirect('/')->with('status', 'Message Sent');
      return redirect('/')->with('success', 'Message Sent');

    }

    public function getMessages() {
      $messages = Message::all();

      return view('getMessages')->with('messages', $messages);

    }
}
