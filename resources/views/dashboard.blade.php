@extends('layouts.admin')
@section('content')
@section('title')
    dashboard
@endsection
<main role="main" class="col-md-12 ml-sm-auto my-3">
    <div class="card-list">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card blue">
                   <a href="" class="text-white" style="text-decoration: none;color: white">
                    <div class="title"></div>
                    <i class="zmdi zmdi-upload"></i>
                    <div class="title">Users</div>
                    <div class="value">{{count($users)}}</div>
                    <div class="stat"><b>13</b>% increase</div>
                   </a>
                </div>
            </div>
            <a class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4" href="{{route('admin.categories')}}" class="text-white text-descoration-none">
                <div >
                    <div class="card green">
                        <div class="title">Categories</div>
                        <i class="zmdi zmdi-upload"></i>
                        <div class="value">{{count($categories)}}</div>
                        <div class="stat"><b>4</b>% increase</div>
                    </div>
                </div>
            </a>
            <a class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4" href="{{route('admin.posts')}}">
                <div >
                    <div class="card orange">
                        <div class="title">posts</div>
                        <i class="zmdi zmdi-download"></i>
                        <div class="value">{{count($posts)}}</div>
                        <div class="stat"><b>13</b>% decrease</div>
                    </div>
                </div>
            </a>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card red">
                    <div class="title">new customers</div>
                    <i class="zmdi zmdi-download"></i>
                    <div class="value">3</div>
                    <div class="stat"><b>13</b>% decrease</div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="projects mb-4">
        <div class="projects-inner">
            <header class="projects-header">
                <div class="title">Ongoing Projects</div>
                <div class="count">| 32 Projects</div>
                <i class="zmdi zmdi-download"></i>
            </header>
            <table class="projects-table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Deadline</th>
                        <th>Leader + Team</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        <p>New Dashboard</p>
                        <p>Google</p>
                    </td>
                    <td>
                        <p>17th Oct, 15</p>
                        <p class="text-danger">Overdue</p>
                    </td>
                    <td class="member">
                        <div class="member-info">
                            <p>Myrtle Erickson</p>
                            <p>UK Design Team</p>
                        </div>
                    </td>
                    <td>
                        <p>$4,670</p>
                        <p>Paid</p>
                    </td>
                    <td class="status">
                        <span class="status-text status-orange">In progress</span>
                    </td>
                    <td>
                        <form class="form" action="#" method="POST">
                        <select class="action-box">
                            <option>Actions</option>
                            <option>Start project</option>
                            <option>Send for QA</option>
                            <option>Send invoice</option>
                        </select>
                        </form>
                    </td>
                </tr>
   
            </table>
        </div>
    </div> --}}

</main>
@endsection