<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">
            @php
                $categories = \App\Domain\Categories\Category::all();
                $start = 0;
            @endphp


                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach($categories as $key => $category)
                            @php
                                if ($key > 34) {
                                    $start = $key;
                                    break;
                                }
                            @endphp
                            <li>
                                <a href="{{ route('posts.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            @php
                $categories = \App\Domain\Categories\Category::all();
                $categories = $categories->slice($start);
            @endphp

                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach($categories as $key => $category)
                            <li>
                                <a href="{{ route('posts.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

        </div>
    </div>
</div>


