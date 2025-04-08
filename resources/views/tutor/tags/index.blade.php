@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
        <div class="row"> 
            @include('layouts.tutor_tabs')
            <div class="col dashboard-content">
                <h2>My Tagged Users</h2>
                <p>Here are all your tagged {{ config('constants.SITE.TITLE') }} users. These are your users you are interested in, so you can easily remember them at a later date for contact. This list is private to you and will not show in your profile.</p>
                @include('elements.alert_message')
                    @if(!empty($tags) && count($tags) > 0)
                    <div class="card">
                        <div class="cardtable tablewrap">
                            <table class="table tablestriped">
                                <tbody>
                                    <tr>
                                        <th>User</th>
                                        <th>Date Tagged</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($tags as $tag)
                                        <tr>  
                                            <td>{{ $tag->user_to->username }}</td>
                                            <td>{{ date(config('constants.SITE.DATE_FORMAT'), strtotime($tag->date)) }}</td>
                                            <td>

                                            <form id="{{ 'TagDelete_'.$tag->id }}" action="{{ route('tutor.tag.delete', $tag->id) }}" method="POST" style="display: inline;" data-toggle="tooltip" onsubmit="return confirm('are you sure to delete record?');" title="Delete Tag" data-original-title="Delete Tag" >
                                                @csrf
                                                @method('POST')
                                                
                                                <button type="submit" class="icon-btn icon-red">
                                                    <svg class="icon">
                                                        <use xlink:href="#cancel"></use>
                                                    </svg>
                                                </button>
                                            </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                        </div> 
                    @else
                        <span class="profilescorealert">
                            <p class="important">You have no users tagged.</p>
                        </span>
                    </div>
                    @endif
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