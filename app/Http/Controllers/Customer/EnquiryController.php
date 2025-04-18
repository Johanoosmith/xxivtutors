<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a Customer model
use App\Models\Country;
use App\Models\County;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\UserView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Question;
use App\Models\Enquiry;
use App\Models\EnquiryComment;
use App\Models\Notification;



class EnquiryController extends Controller
{
    public function enquiries(Request $request)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = Auth::user();
        $enquiries = Enquiry::where('receiver_id', $user->id)
            ->whereHas('enquiry_comments')
            ->with(['enquiry_comments' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get();



        return view('customer.enquiries.index', compact('enquiries'));
    }
    public function showEnquire($enquiry_id, $booking_id = null)
    {
        $user = Auth::user();

        // Fetch all chats between the logged-in tutor and the specific sender
        $enquiry = Enquiry::where('id', $enquiry_id)
            ->with([
                'sender' => ['tutor'],
                'receiver' => ['student'],
                'booking_enquiry',
                'subject_tutor' => ['subject', 'level']
            ])
            ->orderBy('created_at', 'asc')
            ->first();

        if (empty($booking_id)) {
            $booking_id = $enquiry->booking_enquiry[0]->booking_id;
        }

        $booking = \App\Models\Booking::where('id', $booking_id)->first();

        $messages = $this->getChatMessages($enquiry_id);

        return view('customer.enquiries.chats', compact('enquiry', 'booking', 'messages'));
    }


    public function getChatMessages($enquiryId)
    {
        $messages = EnquiryComment::where('enquiry_id', $enquiryId)
            ->orderBy('created_at', 'DESC') // Ensure proper sequence
            ->get();

        return $messages;
    }

    public function sendEnquiryMessage(Request $request)
    {

        $user = Auth::user(); // Fetch the authenticated user
        if (empty($request->content) || empty($request->enquiry_id)) {
            return redirect()->back()->with('error', 'Something went wrong, Please try again later.');
        }

        $enquiry = Enquiry::findOrFail($request->enquiry_id); // Fetch enquiry

        $enquiryCommentCount = EnquiryComment::where('enquiry_id', $request->enquiry_id)
            ->where('sender_id', $user->id)
            ->count();

        if ($enquiryCommentCount > config('constants.SITE.ENQUIRY_MESSAGE_LIMIT')) {
            // If the limit is exceeded, redirect back with an error message
            return redirect()->back()->with('error', 'You have exceed enquiry ' . config('constants.SITE.ENQUIRY_MESSAGE_LIMIT') . ' message limit ');
        }


        $last_enquiry_comment = EnquiryComment::where('enquiry_id', $request->enquiry_id)->orderBy('id', 'DESC')->first();


        $parent_id = (!empty($last_enquiry_comment->id)) ? $last_enquiry_comment->id : 0;

        EnquiryComment::create([
            'parent_id'     => $parent_id,
            'enquiry_id'    => $enquiry->id,
            'sender_id'     => Auth::id(),
            'receiver_id'   => $enquiry->sender_id,
            'content'       => $request->content,
            'status'        => 'unread'
        ]);

        // Get user data
        $user = User::find($enquiry->sender_id);
        if ($user) {
                $userArray['tutor_name'] = $user->firstname . ' ' . $user->lastname;
                $emailSent = sendMail($user->email, $userArray, 'TUTOR_UNREAD_ENQUIRY');
            }
    
        //return redirect()->route('tutor.enquiries.chats', ['enquiry_id' => $enquiry->id])
        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function enquiryClose(Request $request, $enquiry_id)
    {

        $auth_user  = Auth::user(); // Fetch the authenticated user
        $enquiry    = Enquiry::where('receiver_id', $auth_user->id)
            ->where('status', 1)
            ->findOrFail($enquiry_id); // Fetch the enquiry  

        $enquiry->status = 3; // Update the status to closed
        $enquiry->action_by = $auth_user->id;
        $enquiry->save();
        return redirect()->back()->with('success', 'Enquiry has been closed.');
    }

    public function enquiryReport(Request $request, $enquiry_id)
    {

        $auth_user  = Auth::user(); // Fetch the authenticated user

        $enquiry = Enquiry::where('receiver_id', $auth_user->id)
            ->where('status', 1)
            ->findOrFail($enquiry_id); // Fetch the enquiry  


        if ($request->isMethod('post')) {

            $request->validate([
                'report_reason' => 'required|string|max:5500',
            ]);

            $enquiry->report_reason = $request->report_reason;
            $enquiry->status = 2; // Update the status to reported
            $enquiry->action_by = $auth_user->id;
            $enquiry->save();

            return redirect()->route('student.enquiries.enquiries')->with('success', 'Enquiry has been reported.');
        }


        return view('customer.enquiries.report', compact('enquiry', 'enquiry_id'));
    }
}
