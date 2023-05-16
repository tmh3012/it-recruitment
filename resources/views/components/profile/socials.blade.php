<ul class="social-list list-inline mt-3 mb-0">
    @foreach($socials as $social)
        <li class="list-inline-item">
            <a target="_blank"
               href="@if($social->key == 'google')mailto:@endif{{$social->value}}"
               class="social-list-item item-{{$social->key}}">
                <i class="fa-brands fa-{{$social->key}}"></i>
            </a>
        </li>
    @endforeach
</ul>
