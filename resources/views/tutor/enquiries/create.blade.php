@extends('layouts.cms')

@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            <div class="col dashboard-content">
                @include('elements.alert_message')
                   
                <div class="title-with-link-wrapper">
                    <h3>Enquiry to <a href="{{ route('profile', $user->id) }}"> {{ $user->username }}</a></h3>
                    
                    @if(!empty($enquiry))
                        @if($enquiry->status == 1)
                            <form id="{{ 'EnquiryClose_'.$enquiry->id }}" action="{{ route('tutor.enquiries.close', $enquiry->id) }}" method="POST" style="display: inline;" data-toggle="tooltip" onsubmit="return confirm('are you sure to close the enquiry?');" title="" data-original-title="Cancel Enquiry" >
                                @csrf
                                @method('POST')
                                <!--<input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">-->
                                <button type="submit" class="btn btn-yellow btn-small">
                                    Close Enquiry
                                </button>
                            </form>
                        @elseif($enquiry->status == 2)
                            <a href="#" class="btn bg-danger text-white btn-small" title="Enquiry has reported.">Enquiry Reported</a>
                        @elseif($enquiry->status == 3)
                            <a href="#" class="btn btn-danger btn-small" title="Enquiry has closed.">Enquiry Closed</a>
                        @endif
                    @endif
                </div>

                <div class="profileblock">
                    <div class="profileline">
                        <div class="address">
                            @if(!empty($user->student->county))
                                <svg class="small-icon">
                                    <use xlink:href="#map"></use>
                                </svg>
                                @if(!empty($user->student->town))
                                    {{ @$user->student->town }}
                                @endif

                                {{ getCountyNameById($user->student->county); }}
                                
                            @endif
                        </div>
                    </div>
                </div>
                <div class="enquiryreply">
                    <form action="{{ route('tutor.enquiries.create', $user->id) }}" method="POST">
                        <input type="hidden" name="enquiry_id" value="{{ @$enquiry->id }}">
                        @csrf
                        @method('POST')
                        
                            <div id="enquirymsg" class="col-12 form-field">
                                <textarea class="form-control" required maxlength="5500" name="content" id="content" placeholder="Write your message here (please don't exchange phone numbers or email addresses)"></textarea>
                                
                            </div>
                            <div class="col-12 form-field">
                                <button type="submit" class="btn btn-green">Send Enquiry</button>
                            </div>
                    </form>

                    @if(!empty($messages))
                        <div id="ChatContainer" class="chat-container">
                            <div class="chat-box">
                                <div class="message-container">
                                    @if($messages->isNotEmpty())
                                        @php
                                            $count = 1;
                                            $total_message = count($messages);
                                        @endphp
                                        @foreach($messages as $message)
                                            <div class="message {{ $message->sender_id == auth()->id() ? 'right' : 'left' }}">
                                                <div class="message-content" id="{{ $total_message == $count ? 'last-message':'' }}" >
                                                    <p>{{ $message->content }}</p>
                                                    <span class="timestamp">{{ date('h:i A | M d, Y', strtotime($message->created_at)) }}</span>
                                                </div>
                                            </div>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @else
                                        <div class="message left">
                                            <div class="message-content">
                                                <p>No messages found</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="archivedLink">
                    </div>
                    <div id="archivedenquiries">
                    </div>
                </div>
            </div>
            <div class="col right-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h4>How it works</h4>
                    </div>
                    <div class="card-body">
                        <h6>1. Can you help?</h6>
                        <p>Let the student know whether you can help, and how you would be a suitable tutor for them.</p>
                        <h6>2. Book your first lesson</h6>
                        <p>Once the student is ready to start tuition, you need to book in the first lesson and create a schedule. To start a booking, press the "Book Lessons" button.</p>
                        <h6>3. Student confirms the schedule</h6>
                        <p>Once you have created a schedule the student will be asked to enter their payment details, this will confirm the schedule.  Once the lessons are confirmed you can freely exchange contact details here.</p>
                        <h6>Please Remember</h6>
                        <p class="small">
                            <strong>All lessons must take place through {{ config('constants.SITE.TITLE') }}. Do not exchange any contact details until your student has confirmed their first lesson. </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('custom-js')
<script>
    document.getElementById("content").addEventListener("input", function () {
        let textarea = this;
        let errorMessage = document.getElementById("error-message");
        
        // Regex to detect emails, URLs, and potential addresses
        let forbiddenPattern = /([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})|((https?:\/\/|www\.)\S+)|(\d{1,5}\s\w+\s\w+)/gi;

        if (forbiddenPattern.test(textarea.value)) {
            errorMessage.style.display = "block";
            textarea.style.border = "2px solid red";
        } else {
            errorMessage.style.display = "none";
            textarea.style.border = "";
        }
    });

    function scrollToBottom() {
        let chatContainer = document.getElementById('ChatContainer');
        let lastMessage = document.getElementById('last-message');
        
        if (chatContainer && lastMessage) {
            lastMessage.scrollIntoView({ behavior: "smooth" });
        }
    }

    // Call function on page load
    //window.onload = scrollToBottom;

    // Call function when new messages are added (if using AJAX)
    function newMessageAdded() {
        scrollToBottom();
    }

</script>
@endsection 
 