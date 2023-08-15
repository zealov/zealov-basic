<section class="sidebar-panel">
    <div class="sidebar-title">
        {{$title}}
    </div>
    <div class="sidebar-content">
        <ul class="sidebar-list">
            @foreach($data as $key=>$value)
            <li>
                <a href="{{$value['redirect']?$value['redirect']:'/blog/'.$value['id']}}">
                   {{$value['name']}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</section>
