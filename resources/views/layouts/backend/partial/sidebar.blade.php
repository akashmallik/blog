<aside id="leftsidebar" class="sidebar">
  <!-- User Info -->
  <div class="user-info">
      <div class="image">
          <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
      </div>
      <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
          <div class="email">{{ Auth::user()->email }}</div>
          <div class="btn-group user-helper-dropdown">
              <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
              <ul class="dropdown-menu pull-right">
                  <li><a href="{{ Auth::user()->role->id ==1 ? route('admin.settings') : route('author.settings') }}"><i class="material-icons">settings</i>Settings</a></li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">logout</i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <!-- #User Info -->
  <!-- Menu -->
  <div class="menu">
      <ul class="list">
          @if (Request::is('admin*'))
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active':''}}">
                <a href="{{ route("admin.dashboard") }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/tag*') ? 'active':''}}">
                <a href="{{ route("admin.tag.index") }}">
                    <i class="material-icons">local_offer</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/category*') ? 'active':''}}">
                <a href="{{ route("admin.category.index") }}">
                    <i class="material-icons">apps</i>
                    <span>Category</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/post*') ? 'active':''}}">
                <a href="{{ route("admin.post.index") }}">
                    <i class="material-icons">assignment</i>
                    <span>Post</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/pending/post') ? 'active':''}}">
                <a href="{{ route("admin.post.pending") }}">
                    <i class="material-icons">assignment</i>
                    <span>Pending Post</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/favorite') ? 'active':''}}">
                <a href="{{ route("admin.favorite.index") }}">
                    <i class="material-icons">favorite</i>
                    <span>Favorite Post</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/comments') ? 'active':''}}">
                <a href="{{ route("admin.comment.index") }}">
                    <i class="material-icons">comment</i>
                    <span>Comments</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/subscriber') ? 'active':''}}">
                <a href="{{ route("admin.subscribe.index") }}">
                    <i class="material-icons">subscriptions</i>
                    <span>Subscribers</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li class="{{ Request::is('admin/settings') ? 'active':''}}">
                <a href="{{ route("admin.settings") }}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">logout</i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
          @endif
          @if (Request::is('author*'))
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('author/dashboard') ? 'active':''}}">
                <a href="{{ route("admin.dashboard") }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('author/post*') ? 'active':''}}">
                <a href="{{ route("author.post.index") }}">
                    <i class="material-icons">assignment</i>
                    <span>Post</span>
                </a>
            </li>
            <li class="{{ Request::is('author/favorite') ? 'active':''}}">
                <a href="{{ route("author.favorite.index") }}">
                    <i class="material-icons">favorite</i>
                    <span>Favorite Post</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li class="{{ Request::is('author/settings') ? 'active':''}}">
                <a href="{{ route("author.settings") }}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">logout</i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
					@endif
      </ul>
  </div>
  <!-- #Menu -->
  <!-- Footer -->
  <div class="legal">
      <div class="copyright">
          &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
      </div>
      <div class="version">
          <b>Version: </b> 1.0.5
      </div>
  </div>
  <!-- #Footer -->
</aside>