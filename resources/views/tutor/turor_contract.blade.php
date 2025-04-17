@extends('layouts.cms')

@section('page-css')
<link rel="stylesheet" href="{{asset('front/assets/css/signature.css')}}">
@endsection

@section('content')
    <section class="dashboard-with-sidebar">
        <div class="container">
            <div class="row">
              <div class="col dashboard-content">
                  @include('elements.alert_message')
                    <div id="maincontent">
                        <h1>Tutor Contract</h1>
                        <div>
                            <tt style="font-size: 16px;">This contract forms an agreement between <b>{{ @$booking->tutor->tutor->title}} {{ @$booking->tutor->full_name}}</b> and
                                <b>{{ config('constants.SITE.TITLE') }}</b>.
                                @if(!empty($contractObj->signed_date))
                                <br>Dated: {{ date(config('constants.SITE.DATE_FORMAT'), strtotime($contractObj->signed_date)) }}
                                @endif
                            </tt>
                        </div>
                        <div>
                            <p>To ensure that {{ config('constants.SITE.TITLE') }} can maintain its low commission rate we
                                expect all our tutors to work with us and not book lessons outside our site. Tutors who
                                maintain a high frequency of lessons will be rewarded with further job opportunities, those
                                who break our terms will be permanently removed with no option to re-join in the future.</p>
                            <p style="margin-bottom:0; margin-top: 30px; color: #444; font-size: 13px;"><em
                                    style="font-weight: bold;">Please read the clauses below very carefully - you can agree
                                    to each clause by clicking the box on the left side.</em></p>
                            <div style="min-height: 140px;">
                                @if(!empty($contractObj->cd_1))
                                <div id="declaration-1" class="declare mb-2">
                                    {!! $contractObj->cd_1 !!}
                                </div>
                                @endif
 
                                @if(!empty($contractObj->cd_1))
                                <div id="declaration-2" class="declare mb-2">
                                  {!! $contractObj->cd_2 !!}
                                </div>
                                @endif

                                @if(!empty($contractObj->cd_1))
                                <div id="declaration-3" class="declare mb-2">
                                  {!! $contractObj->cd_3 !!}
                                </div>
                                @endif

                                @if(!empty($contractObj->cd_1))
                                <div id="declaration-4" class="declare mb-2">
                                  {!! $contractObj->cd_4 !!}
                                </div>
                                @endif

                                @if(!empty($contractObj->cd_1))
                                <div id="declaration-5" class="declare mb-2">
                                  {!! $contractObj->cd_5 !!}
                                </div>
                                @endif
                            </div>
                            <p>
                                <br> <br>
                                Your Name: {{ @$booking->tutor->full_name}}<br><br>
                            </p>
                            
                            @if(!empty($contractObj->ip_address))
                              <p><tt style="font-size: 13px; margin-top: 20px; display:inline-block;">Your contract signature
                                      will be stored along with your IP Address: <strong
                                          style="color: #000;">{{ $contractObj->ip_address }}</strong></tt>
                              </p>
                            @endif


                            @if(!empty($contractObj->signature) && $contractObj->status == 'signed')
                              <div class="signature">
                                <img src="{{ asset('storage/signatures/'.$contractObj->signature) }}" alt="Signature" style="width: 200px; height: auto;">
                              </div>
                            @else
                            <form id="signatureform" method="post" action="{{ route('tutor.contract', $contractObj->id) }}">
                                @csrf
                                
                              <div id="content">
                                  <div id="signatureparent">
                                    <div>jSignature inherits colors from parent element. Text = Pen color. Background = Background. (This works even when Flash-based Canvas emulation is used.)</div>
                                    <div id="signature"></div></div>
                                  <div id="tools"></div>
                                  <div>
                                      <div id="displayarea"></div>
                                  </div>
                                </div>
                          
                                <input type="submit" id="submit" class="btn btn-green" value="Sign Submit" />
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection





@section('page-js')
<script type="text/javascript">
  jQuery.noConflict()
  </script>
<script src="{{ asset('front/assets/js/jSignature.min.noconflict.js') }}"></script>
<script src="{{ asset('front/assets/js/signature.js') }}"></script>
@endsection

@section('custom-js')
<script>
  jQuery('')
</script>
@endsection