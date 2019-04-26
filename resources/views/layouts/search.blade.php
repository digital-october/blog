<!-- Search Widget -->
<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('posts.search') }}">
            @csrf
            <div class="input-group">

                <input type="text" class="form-control" name="search" placeholder="Search for...">

                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </span>

            </div>
        </form>
    </div>
</div>