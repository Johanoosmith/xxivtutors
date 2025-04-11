@extends('layouts.cms')
@section('content')
    <section class="dashboard-with-sidebar">
        <div class="container">
            <div class="row">
                <div class="col dashboard-content">
                    <div id="maincontent">
                        <h1>Tutor Contract</h1>
                        <div>
                            <tt style="font-size: 16px;">This contract forms an agreement between <b>{{ @$booking->tutor->tutor->title}} {{ @$booking->tutor->full_name}}</b> and
                                <b>{{ config('constants.SITE.TITLE') }}</b>.<br>Dated: {{ $booking->created_at->format(config('constants.SITE.DATE_FORMAT')) }}</tt>
                        </div>
                        <p></p>
                        <div>
                            <p>To ensure that {{ config('constants.SITE.TITLE') }} can maintain its low commission rate we
                                expect all our tutors to work with us and not book lessons outside our site. Tutors who
                                maintain a high frequency of lessons will be rewarded with further job opportunities, those
                                who break our terms will be permanently removed with no option to re-join in the future.</p>
                            <p style="margin-bottom:0; margin-top: 30px; color: #444; font-size: 13px;"><em
                                    style="font-weight: bold;">Please read the clauses below very carefully - you can agree
                                    to each clause by clicking the box on the left side.</em></p>
                            <div style="min-height: 140px;">
                                <div id="declaration-1" class="declare mb-2">
                                    I acknowledge that {{ config('constants.SITE.TITLE') }} will carry out regular
                                    compliance checks with students introduced to me to ensure all lessons are booked
                                    through {{ config('constants.SITE.TITLE') }}.
                                </div>

                                <div id="declaration-2" class="declare mb-2">
                                    I understand that, Lauren (Miss) has agreed to pay an <strong>hourly rate of
                                        {{ getAmount($booking->hourly_rate) }}</strong> which includes {{ config('constants.SITE.TITLE') }}'s commission.
                                </div>

                                <div id="declaration-3" class="declare mb-2">
                                    I understand that all online lessons must take place through our whiteboard (provided by
                                    Zoom). Access links to the lesson will appear 15 minutes before the lesson takes place.
                                </div>

                                <div id="declaration-4" class="declare mb-2">
                                    If I break these rules I understand that I will be subject to a maximum fine of {{ getAmount(150) }} per
                                    student, permanent removal from {{ config('constants.SITE.TITLE') }}, and no option to
                                    re-join as we only allow one account per photo ID we receive.
                                </div>

                                <div id="declaration-5" class="declare mb-2">
                                    I understand that if I cannot attend a lesson, or if I need to rearrange the lesson
                                    time/date, I must do so within the {{ config('constants.SITE.TITLE') }} booking system.
                                    The student will automatically get notified as to any scheduling alterations.
                                </div>
                            </div>
                            <p>
                                <br> <br>
                                Your Name: {{ @$booking->tutor->full_name}}<br><br>
                            </p>
                            <!--<p><tt style="font-size: 13px; margin-top: 20px; display:inline-block;">Your contract signature
                                    will be stored along with your IP Address: <strong
                                        style="color: #000;">77.96.138.183</strong><br>Once signed, a copy of this contract
                                    will be available to you to view within the members portal for reference.</tt>
                            </p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
