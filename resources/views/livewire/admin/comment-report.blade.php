<div>
    <input type="search" name="search" placeholder="..search"  id="search" wire:model="search" wire:input="search">
    <div class="table-responsive">
        <table class="projects-table table" style="color:white">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">type</th>
          <th scope="col">body</th>
          <th scope="col">poster</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comment_report as $report)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$report->type}}</td>
            <td>@foreach ($report->body as $r)
                <ul>
                    <li style="text-align: left">{{$r}}</li>
                </ul>
        @endforeach
        </td>
        <td>{{$report->user->name}}</td>
        <td>
            <a class="btn btn-outline-primary btn-sm" href="{{route('post.details',[$report->comment->post_id])}}#id_{{$report->comment_id}}">
                show
            </a>
            <form action="" method="post" wire:submit.prevent="delete_comment({{$report->comment_id}})">
                <button type="submit" class="btn btn-sm btn-outline-danger">delete</button>
            </form>
        </td>
        </tr>
        @endforeach
      </tbody>
        </table>
        {{$comment_report->links()}}
    </div>
</div>
