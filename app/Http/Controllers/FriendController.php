<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function search(Request $request)
{
    $users = User::where('name', 'like', "%{$request->query('q')}%")
        ->where('id', '!=', auth()->id())
        ->select('id', 'name', 'email')
        ->get();

    return response()->json($users);
}

public function sendRequest(Request $request)
{
    FriendRequest::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
    ]);

    return response()->json(['status' => 'request_sent']);
}

public function incomingRequests()
{
    $requests = FriendRequest::with('sender')
        ->where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->get();

    return response()->json($requests);
}

public function respondRequest(Request $request)
{
    $friendRequest = FriendRequest::findOrFail($request->request_id);

    if ($request->action === 'accept') {
        $friendRequest->update(['status' => 'accepted']);

        // Optionally store in `friends` table
        DB::table('friends')->insert([
            ['user_id' => auth()->id(), 'friend_id' => $friendRequest->sender_id],
            ['user_id' => $friendRequest->sender_id, 'friend_id' => auth()->id()],
        ]);
    } else {
        $friendRequest->update(['status' => 'rejected']);
    }

    return response()->json(['status' => 'responded']);
}
}
