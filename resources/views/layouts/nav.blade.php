<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <a class="navbar-brand" href="#"><img src="/img/logo.png" style="max-height:75px;">Jim's Offroad Service</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item {{(Request::path()=='/')? 'active':''}}">
        <a class="nav-link" href="{{ route('home') }}">Current Tickets</a>
      </li>
      <li class="nav-item {{(Request::path()=='service')? 'active':''}}">
        <a class="nav-link" href="/service">Create a Ticket</a>
      </li>
    </ul>
  </div>
</nav>
