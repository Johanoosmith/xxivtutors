
@if($page_template == 'homepage')
    @include('includes.admin.ajax.pages.home_page_form')
@elseif($page_template == 'landing')
    @include('includes.admin.ajax.pages.landing_page_form')
@elseif($page_template == 'contact')
    @include('includes.admin.ajax.pages.contact_page_form')
@elseif($page_template == 'search')
    @include('includes.admin.ajax.pages.search_page_form')
@elseif($page_template == 'tutor')
    @include('includes.admin.ajax.pages.tutor')
@elseif($page_template == 'order_transport')
    @include('includes.admin.ajax.pages.order_transport_form')

@elseif($page_template == 'pet_movement_legislation')
    @include('includes.admin.ajax.pages.pet_movement_legislation_form')


@else
    @include('includes.admin.ajax.pages.cms_page_form')
@endif

