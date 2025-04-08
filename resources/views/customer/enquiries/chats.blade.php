@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row">
            <div class="col dashboard-content">
                @include('elements.alert_message')
                    
                <div class="title-with-link-wrapper justify-content-start chat-user-profile">
                    <div class="user-profile-img">
                        <img src="{{ asset('storage/' . $enquiry->sender->profile_image) }}" alt="{{ $enquiry->sender->username }}'s Profile Image" >
                    </div>
                    <h3>Enquiry to <a href="{{ route('tutor', ['id' => $enquiry->sender->id]) }}"> {{ $enquiry->sender->username }}</a></h3>
                </div>
                <div class="profileblock">
                    <div class="profileline">
                        <div class="text-primary fs-3">
                            {{config('constants.CURRENCY_SYMBOL')}} {{ intval($booking->student_rate) }}<span class="ph">/hr</span>
                        </div>
                    </div>
                    <div class="profileline">
                        <div class="address">
                            @if(!empty($enquiry->sender->tutor->county))
                                <svg class="small-icon">
                                    <use xlink:href="#map"></use>
                                </svg>
                                @if(!empty($enquiry->sender->student->town))
                                    {{ @$enquiry->sender->student->town }}
                                @endif

                                {{ getCountyNameById($enquiry->sender->tutor->county); }}
                                
                            @endif
                        </div>
                    </div>
                    <div class="profileline row">
                        <div class="col-12 col-md-4 text-primary">
                            {{ @$enquiry->subject_tutor->subject->title;}} ({{ @$enquiry->subject_tutor->level->title }})
                        </div>
                        <div class="col-12 col-md-4 text-center">
                        </div>
                        <div class="col-12 col-md-4 text-end">
                            <a href="{{ route('customer.booking.index') }}" class="btn btn-yellow btn-small">View Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="enqprogress">
                    <div class="profileblock row">
                        <div class="profileline col-12 col-md-4" id="enqprogresslast">
                        </div>
                    </div>
                </div>
                <div class="enquiryreply">
                    <form action="{{ route('student.enquiries.sendMessage') }}" id="mailform" method="POST">
                        <input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">
                        @csrf
                        @method('POST')
                        <div id="enquirymsg" class="col-12 form-field">
                            <textarea class="form-control" maxlength="5500" name="content" id="content" placeholder="Write your message here (please don't exchange phone numbers or email addresses)"></textarea>
                            
                        </div>
                        <div class="col-12 form-field">
                            <button type="submit" class="btn btn-green">Send Enquiry</button>
                        </div>
                    </form>
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
                </div>
            </div>
            <div class="col right-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h4>How it works</h4>
                    </div>
                    <div class="card-body">
                    <h6>1. Message your tutor</h6>
                        <p>
                        Your message will be sent to your tutor, they should respond back to you soon.
                        </p>
                        <h6>2. Tutor books in your first lesson</h6>
                        <p>
                        Chat to your tutor, once you are happy, they will book in your first lesson and schedule.
                        </p>
                        <h6>3. You confirm the schedule</h6>
                        <p>
                        Once your tutor has created your schedule, you will be asked to enter your payment details, this will confirm the schedule. Once the lessons are confirmed you can freely exchange contact details here.
                        </p>
                        <h6>Important</h6>
                        <p>
                            Lessons must be supervised by an parent or guardian for the duration of a tutoring session irrespective of where tuition takes place, or whether the lesson is conducted online.
                        </p>
                        <p>
                            Do not exchange any contact details until your first lesson is confirmed. This includes arranging a meeting point or exchanging phone numbers / email addresses / URLs / home addresses / usernames.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
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
</script>

