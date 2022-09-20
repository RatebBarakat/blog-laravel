<div>

        <div class="contain blackwhite m-3 p-2 d-flex" style="flex-direction: column;gap: 20px">
                <form action="" wire:submit.prevent="addComment({{$post->id}})" method="post">
                    @csrf
                    <div class="d-flex">
                        <div class="form-control" style="background: transparent !important">
                            <textarea style="background: var(--input-color)" class="w-100" name="" id="" cols="30" rows="4" wire:model.defer="body"></textarea>
                            <div class="errors">
                                @if ($errors->any())
                                <div class="container">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger list-item">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            </div>
                            <div class="d-flex w-100" style="justify-content: space-between">
                                <div class="rating__stars">
                                    Rate:
                                    <input id="rating-1" wire:model.defer="rate" checked class="rating__input rating__input-1" type="radio" name="rating" value="1">
                                    <input id="rating-2" wire:model.defer="rate" class="rating__input rating__input-2" type="radio" name="rating" value="2">
                                    <input id="rating-3" wire:model.defer="rate" class="rating__input rating__input-3" type="radio" name="rating" value="3">
                                    <input id="rating-4" wire:model.defer="rate" class="rating__input rating__input-4" type="radio" name="rating" value="4">
                                    <input id="rating-5" wire:model.defer="rate" class="rating__input rating__input-5" type="radio" name="rating" value="5">
                                    <label class="rating__label" for="rating-1">
                                        <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                            <g transform="translate(16,16)">
                                                <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                            </g>
                                            <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <g transform="translate(16,16) rotate(180)">
                                                    <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                                    <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                                </g>
                                                <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                                    <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="rating__sr">1 star—Terrible</span>
                                    </label>
                                    <label class="rating__label" for="rating-2">
                                        <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                            <g transform="translate(16,16)">
                                                <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                            </g>
                                            <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <g transform="translate(16,16) rotate(180)">
                                                    <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                                    <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                                </g>
                                                <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                                    <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="rating__sr">2 stars—Bad</span>
                                    </label>
                                    <label class="rating__label" for="rating-3">
                                        <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                            <g transform="translate(16,16)">
                                                <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                            </g>
                                            <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <g transform="translate(16,16) rotate(180)">
                                                    <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                                    <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                                </g>
                                                <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                                    <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="rating__sr">3 stars—OK</span>
                                    </label>
                                    <label class="rating__label" for="rating-4">
                                        <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                            <g transform="translate(16,16)">
                                                <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                            </g>
                                            <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <g transform="translate(16,16) rotate(180)">
                                                    <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                                    <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                                </g>
                                                <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                                    <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="rating__sr">4 stars—Good</span>
                                    </label>
                                    <label class="rating__label" for="rating-5">
                                        <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                            <g transform="translate(16,16)">
                                                <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                            </g>
                                            <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <g transform="translate(16,16) rotate(180)">
                                                    <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                                    <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                                </g>
                                                <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                                    <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                                    <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="rating__sr">5 stars—Excellent</span>
                                    </label>
                                </div>
                                <div class="submit">
                                    <button type="submit" class="btn btn-outline-primary">
                                        add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <div class="head space-between px-3">
                <h2>comments:</h2>
                <div class="count">{{count($comments)}} comments | average: {{substr($avg_rate,0,3)}}</div>
            </div>
            @foreach ($comments as $comment)
            <div class="card  comment" id="id_{{$comment->id}}" style="border: 1px solid rgba(0,0,0,0.5)">
                <div class="card-header d-flex" style="justify-content: space-between">
                    <div class="name" style="color: var(--form-text)">
                    {{$comment->user->name}}
                    </div>
                    <div class="rate" style="color: var(--blue-color)">
                        <span class="mx-1" style="color: var(--form-text)">
                            {{$comment->created_at->diffForHumans()}}
                        </span>
                        Rate: {{$comment->rate}}
                    </div>
                </div>
                <div class="card-content px-4" style="color: var(--form-text);min-height: 70px;
                color: var(--form-text);min-height: 70px;display: flex;justify-content: space-between;align-items: center;">
                    <div class="body">
                        {{$comment->body}}
                    </div>
                    @auth
                        @if(auth()->user()->id == $comment->user_id || auth()->user()->admin == 1)
                        <div class="actions" style="flex-wrap: nowrap;display: flex;gap: 10px;">
                            <form action="" method="post" 
                            wire:submit.prevent="delete_comment({{$comment->id}})">
                            <button class="btn btn-sm btn-danger"  type="submit">delete</button>
                            </form>
                        @endif
                    @endauth
                    @auth
                    @if (auth()->user()->id != $comment->user_id && !auth()->user()->admin == 1)
                    <button wire:click="get_data_report({{$comment->id}})"
                    type="button" class="btn btn-info btn-sm" 
                    data-toggle="modal" data-target="#report">
                      report
                    </button>
                    @endif
     
                    @else
                    <button wire:click="get_data_report({{$comment->id}})"
                        type="button" class="btn btn-info btn-sm" 
                        data-toggle="modal" data-target="#report">
                          report
                    </button>   
                    @endauth
                 
                    <div wire:ignore.self class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="reportLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="reportLabel">Report</h5>
                                      <button type="button" 
                                      class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                        <div class="modal-body">
                                        <h3>why you would to report</h3>
    
                            <form action="" method="post" wire:submit.prevent="report_comment({{$comment->id}})">
                                <div class="form-group">
                                    <select wire:model="report_reason" 
                                    style="background: transparent;border:1op solid;color:var(--form-text)
                                    " name="" id="" class="form-control">
                                        <option value=""></option>
                                        <option value="bad content">cad content</option>
                                        <option value="rasism">rasisam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input wire:model="report_reason_other" class="form-control" type="text" name="" id="" placeholder="other reasons">
                                </div>
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">send</button>
                          </div>
                        </form>
                                        
    
                                  </div>
                                </div>
                              </div>
    
                </div>
            </div>
            </div>
            @endforeach
        </div>
        <script>
        window.addEventListener('addPost', event => { 
        $('#report').modal('hide');
    });
        </script>
</div>
