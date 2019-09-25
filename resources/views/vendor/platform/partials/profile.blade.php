<div class="wrapper v-center">
    <div class="dropdown col no-padder">
        <a href="#" class="nav-link p-0 v-center" data-toggle="dropdown">
                    <span class="thumb-xs avatar m-r-xs">
                        <img src="{{Auth::user()->getAvatar()}}" class="b b-dark bg-light">
                    </span>
            <span class="ml-2" style="width:11em;font-size: 0.85em;">
                <span class="text-ellipsis">{{Auth::user()->getNameTitle()}}</span>
                <span class="text-muted d-block text-ellipsis">{{Auth::user()->getSubTitle()}}</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow bg-white">
            <a href="{{ route('platform.logout') }}"
               class="dropdown-item"
               data-controller="layouts--form"
               data-action="layouts--form#submitByForm"
               data-layouts--form-id="logout-form"
               dusk="logout-button">
                <i class="icon-logout m-r-xs" aria-hidden="true"></i>
                <span>{{ __('Sign out') }}</span>
            </a>
            <form id="logout-form"
                  class="hidden"
                  action="{{ route('platform.logout') }}"
                  method="POST"
                  data-controller="layouts--form"
                  data-action="layouts--form#submit"
            >
                @csrf
            </form>
        </div>
    </div>
</div>
