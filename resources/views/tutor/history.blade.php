@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.tutor_tabs')
                <div class="col dashboard-content">
                    <h2>My History</h2>
                    <p>Here you can view your history in terms of whose profile pages you have recently viewed,
                        the most recent viewed is at the top of the list. You can clear your history here,
                        or if you would prefer not to have your history stored you can change this setting in the Privacy section.</p>
                    @include('elements.user.alert_message')
                    <div class="card">
                    <div class="table-responsive">
                                @php
                                    $views = getUserViewCounts(auth()->id());
                                @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-qualification">User Profile	</th>
                                    <th class="col-institute">Date Viewed	</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($user_views as $view)
                                    <tr style="height: 38px;">
                                        <td>
                                            <a href="{{ route('profile', $view->viewer_id) }}">{{ $view->viewer->firstname ?? 'N/A' }} {{ $view->viewer->lastname ?? 'N/A' }}</a>
                                        </td>
                                        <td>{{ optional($view->viewer)->created_at ? $view->viewer->created_at->format('d-m-Y') : 'N/A' }}</td>
                                        <td class="mobno">
                                            <div class="infobut" style="position: relative; top: -4px;">
                                                <a href="#">
                                                <img src="{{ asset('storage/uploads/icon-contact.png') }}" alt="Contact" width="100">
                                                </a>
                                        </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>  
                <div class="cardcontent">
                <p>
                </p></div>
                </div>
                </div>
            </div>
        </div>
</section>
@endsection

