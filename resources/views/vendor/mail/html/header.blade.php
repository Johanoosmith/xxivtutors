@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png"  class="logo" alt="Laravel Logo">
@else
<img src="{{url('front/images/logo.png')}}" class="logo" style="width:250px;height:45px;"  alt=""/>
@endif
</a>
</td>
</tr>
