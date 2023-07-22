<ol class="breadcrumb m-0">
    @foreach ($breadcrumb as $index => $bc)
        <li class="breadcrumb-item {{$index == count($breadcrumb) - 1 && 'active'}}"><a href="javascript: void(0);">{{$bc}}</a></li>
    @endforeach
</ol>