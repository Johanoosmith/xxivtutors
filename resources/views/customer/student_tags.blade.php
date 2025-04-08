@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    <h2>My Tagged Users</h2>
                    <p>Here are all your tagged {{ config('constants.SITE.TITLE') }} users. These are your users you are interested in, so you can easily remember them at a later date for contact. This list is private to you and will not show in your profile.</p>
                    @include('elements.user.alert_message')
                    @if(!empty($tags) && count($tags) > 0)
                        <div class="card">
                            <div class="cardtable tablewrap">
                                <table class="table tablestriped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 29%;">Name</th>
                                            <th style="width: 29%;">Tags</th>
                                            <th></th>
                                        </tr>
                                        <tr>  
                                            <td height="30">
                                                <div class="infopanel-wrapper">
                                                    <span style="position: relative; top: -2px;"></span>
                                                </div>
                                            </td>
                                            <td> 
                                            <div class="infopanel-wrapper">
                                                    <span style="position: relative; top: -2px;"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>  
                        </div> 
                        @else
                        <span class="profilescorealert">
                        <p class="important">You have no users tagged.</p>
                        </span>
                    @endif
    <div class="cardcontent">
        <p></p>
    </div>
</div>

                </div>
            </div>
        </div>
</section>
@endsection

<style>
    .important {
    padding: 8px 35px 8px 14px;
    margin-bottom: 18px;
    color: #a07324;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    background-color: #fcf8e3;
    border: 1px solid #fbeed5;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    line-height: 1.4;
}
</style>