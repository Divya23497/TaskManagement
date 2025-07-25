<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        // Check if the user is a manager or executive
        if (Auth::user()->user_type == 'executive') {

            // Fetch all notifications for manager or executive
            $notifications = Notification::orderByDesc('created_at')->paginate(10);

        } else {
        // Fetch notifications for the logged-in user
        $notifications = Notification::where('assigned_to', auth()->id())
                                    ->orderByDesc('created_at')
                                    ->paginate(10); // Paginate notifications
        }

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
{
    // return $id;
    $notification = Notification::findOrFail($id);

    // return Auth::user()->id;
    // Ensure the notification belongs to the authenticated user
    if ($notification->assigned_to == Auth::user()->id) {
        $notification->update(['is_read' => true]);
    }


    return redirect()->route('notifications.index');
}

public function getNotificationsByAssignedTo()
{

        $user_id = Auth::user()->id;

        // Check if the user is a manager or executive
        if (Auth::user()->user_type == 'executive') {

            // Fetch all notifications for manager or executive
            $notifications = Notification::all();
        } else {
            // For other users, fetch notifications assigned specifically to them
            $notifications = Notification::where('assigned_to', $user_id)
                                     ->where('is_read', 0)
                                     ->get();
        }

        // Return the notifications as JSON
        return response()->json($notifications);

}



}
