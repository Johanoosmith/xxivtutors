

<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-2 rounded-lg bg-yellow-100">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-black cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto cookie-consent-button">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade photo-popup " id="cookie_consent_popup" tabindex="-1" aria-labelledby="cookie_consent_popup" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="heading-blue">
        <h3>Welcome to our website</h3>
      </div>
      <div class="forms-popup-content">
        <div class="forms-popup-detail">
            <p class="ml-3 text-black cookie-consent__message">
                {!! trans('cookie-consent::texts.message') !!}
            </p>
        </div>
      </div>
      <div class="modal-footer">
            <button data-bs-dismiss="modal" class="btn btn btn-primary  js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                {{ trans('cookie-consent::texts.agree') }}
            </button>        
      </div>

    </div>
  </div>
</div>


