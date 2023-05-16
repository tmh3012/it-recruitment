<div class="short-intro bg-white rounded p-3 box-shadow">
    <div class="text-start">
        <h3 class="text-uppercase font-18"><i class="mdi mdi-briefcase me-1"></i>
            About me:</h3>
        <p class="text-muted font-13 mb-3">
            {!! $profile->bio !!}
        </p>
        <h4 class="text-muted mb-2 font-13"><strong>Full Name :</strong>
            <span class="ms-2">{{$profile->name}}</span>
        </h4>
        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
            <span class="ms-2">{{$profile->phone}}</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>Email :</strong>
            <span class="ms-2 ">{{$profile->emailContact}}</span>
        </p>
        <p class="text-muted mb-1 font-13"><strong>Location :</strong>
            <span class="ms-2">{{$profile->city}}</span>
        </p>
        <p class="text-muted mb-1 font-13"><strong>Website :</strong>
            <a target="_blank" href="{{$profile->link}}"><span
                    class="ms-2">{{$profile->link}}</span></a>
        </p>
    </div>
    <x-profile.socials :socials="$socials"/>

    <x-profile.skill :skills="$skills"/>

</div>
