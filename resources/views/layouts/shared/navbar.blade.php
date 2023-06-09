<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    
    <nav class="nav navbar-nav">
      
      <ul class="navbar" style="list-style-type: none;">
        <li class="nav-item ml-auto">
          @if(auth()->check())
            <a class="notification-button" id="messagesButton" data-container="body" data-toggle="popover" data-placement="bottom" style="margin-right: 10px; cursor: pointer;">
              <i class="fa fa-bell"></i> Notifications
            </a>
            <div id="messagesDropdown">
              <div id="messagesPopoverContent" style="display: none;">
                <ul id="messagesList" class="list-group"></ul>
              </div>
            </div>
          @endif
        </li>
        <li class="nav-item">
          <a class="about-button" href="{{ route('about-us') }}" style="margin-right: 10px;">
            <i class="fa fa-info-circle"></i> About Us
          </a>
        </li>
        @guest
  <li class="nav-item">
    <a class="dropdown-item" href="{{ route('login') }}">
      <i class="fa fa-sign-in"></i> Log In
    </a>
  </li>
@else
<li class="nav-item">
    <div class="user-profile">
        <a id="navbarDropdown" data-toggle="modal" data-target="#userInfoModal" style="cursor: pointer;">
            <img src="{{ asset('uploads/profilepic/' . (auth()->user()->profilepic ?? 'userprof.png')) }}" alt="User image" class="rounded-circle mx-auto d-block" style="width: 30px; height: 30px; border-radius: 50%; cursor: pointer;">
            {{ Auth()->user()->first_name ?? ''}} {{ Auth()->user()->last_name ?? ''}}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="dropdown-item" type="submit" style="background: none; border: none; padding: 0;"><i class="fa fa-sign-out pull-right"></i></button>
        </form>
    </div>
</li>

<!-- User Info Modal -->
<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{ asset('uploads/profilepic/' . (auth()->user()->profilepic ?? 'userprof.png')) }}" alt="User Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; display: block; margin: 0 auto;">
                    <h4>{{ Auth()->user()->first_name ?? ''}} {{ Auth()->user()->last_name ?? ''}}</h4>
                </div>
                <p><strong>Contact Number:</strong> {{ Auth()->user()->contact_no ?? ''}}</p>
                <p><strong>Email:</strong> {{ Auth()->user()->email ?? ''}}</p>
                <p><strong>Role:</strong> {{ Auth()->user()->role ?? ''}}</p>
            </div>
        </div>
    </div>
</div>


@endguest


      </ul>
    </nav>
  </div>
</div>

@include('layouts.scripts.messages-script')
