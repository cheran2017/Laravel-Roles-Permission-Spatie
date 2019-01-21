<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Users</title>
  @include('admin.config.app-css')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.config.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @include('admin.config.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              Users
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Users List
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          @include('admin.config.flash')
          <div class="row">
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{url('users/create')}}" class="btn btn-primary text-right">Create User</a>
                      </div>
                    </div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Users List</h4>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(count($data['users']) > 0)
                          @foreach($data['users'] as $user)
                          <tr>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>
                                @if(count($user->getRoleNames()->pluck('name')) > 0)
                                  {{implode(",",$user->getRoleNames()->toArray())}}
                                @else
                                  No Role Assigned
                                @endif
                              <td>
                                <a href="/users/{{ $user->id }}" class="btn btn-sm btn-warning ">
                                  <i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
                                </a>
                                <form method="POST" action="{{url('roles')}}/{{$user->id}}">
                                  {{ method_field('DELETE') }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-sm btn-danger "><i class="mdi mdi-close-circle" aria-hidden="true"></i></button>
                                </form>
                              </td>
                          </tr>
                          @endforeach
                        @else
                          <tr>
                            <td colspan="3">No Records Found</td>
                          </tr>
                        @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3" >{{$data['users']->links()}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.cheranblog.com/" target="_blank">Cheran Admin Panel</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Roles and Permissions <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('admin.config.app-script')

</body>

</html>

