<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="profilepage"><img src="/resources/images/GetHiredV2.1.jpg" alt = "g in a circle" height = "25" width = "25"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="joppage">Jobs</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="searchjobs">Job Search</a>
      </li>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Groups
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="allgroups">Groups</a>
          <a class="dropdown-item" href="addgroups">Add Group</a>
          <a class="dropdown-item" href="managegroups">Manage Group</a>
        </div>
 		</li>
      <li class="nav-item">
        <a class="nav-link" href="profile">Profile</a>
      </li>
      <li class="nav-item">
       @if(session('userID') == NULL)
        <a class="nav-link" href="login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register">Sign up</a>
      </li>
       <li class="nav-item">
       @else
        <a class="nav-link" href="logout">Log Out</a>  
      </li>
      
      <li class="nav-item dropdown">
      			@if(session('role') == "1")
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin">Users</a>
          <a class="dropdown-item" href="addjob">Add Job</a>
          <a class="dropdown-item" href="managejob">Manage Job</a>
        </div>
        @endif
        @endif
      </li>
    </ul>
  </div>
</nav>
