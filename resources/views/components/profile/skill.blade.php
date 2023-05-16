<h3 class="text-uppercase font-18 mt-3">
    <i class="mdi mdi-briefcase me-1"></i>
    Skill
</h3>
<ul class="default-ul user-skill-list">
    @foreach($skills as $skill)
        <li class="skill-items skill-{{$skill}}">{{$skill}}</li>
    @endforeach
</ul>
