<div class="card mb-5">
    @if($post->photo_path)
        <div>
            <img src="{{ asset('storage/' . $post->photo_path) }}" class="card-img-top mt-2" alt="Post photo">
        </div>
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 250, '...') }}</p>

        <div class="row justify-content-between">
            <div class="col-7">
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary me-3">Read more</a>
                <small class="text-muted">Added: {{ $post->created_at->format('d M Y H:i') }}</small>
            </div>
            <div class="col-5 text-end">
                <a type="button" class="btn btn-outline-success" href="" onclick="event.preventDefault(); document.getElementById('like').submit();">
                    Like: {{ $post->likes }}
                </a>
                <form id="like" action="" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="type" value="1">
                </form>

                <a type="button" class="btn btn-outline-danger" href="" onclick="event.preventDefault(); document.getElementById('dislike').submit();">
                    Dislike: {{ $post->dislikes }}
                </a>
                <form id="dislike" action="" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="type" value="0">
                </form>

                <div class="btn-group">
                    <button type="button" class="btn btn-secondary"> {{ $post->status }}</button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Published</a></li>
                        <li><a class="dropdown-item" href="#">Draft</a></li>
                    </ul>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{route('posts.edit', $post->id)}}">Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deletePostModal{{ $post->id }}">Delete</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.delete_post_modal', ['post' => $post])
