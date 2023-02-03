<div class="filter-block">
    <form class="fm-filter" id="fm-filter" action="{{route('jobs-page')}}">
        <div class="header-block d-flex justify-content-between align-items-center border-bottom">
            <h4 class="text-main">{{__('frontPage.advHeading')}}</h4>
            <a class="filter-reset text-dark font-13 font-weight-semibold"
               href="{{route('jobs-page')}}">{{__('frontPage.filterReset')}}</a>
        </div>
        <div class="body-block pt-3">
            <div class="filter-item mb-3">
                <lable class="h4 text-cl-main d-block mb-3">{{__('frontPage.keyword')}}</lable>
                <input class="form-control" name="keyword" type="text"
                       placeholder="{{__('frontPage.keyword')}}..."
                       @isset($ft_key_word) value="{{$ft_key_word}}" @endisset>
            </div>
            <div class="filter-item mb-3">
                <lable class="h4 text-cl-main d-block my-1">{{__('frontPage.location')}}</lable>
                <select class="form-control border-0 select2" data-toggle="select2"
                        name="city" id="">
                    <option value="">{{__('frontPage.location')}}</option>
                    @foreach($arrCities as $value)
                        <option value="{{$value}}"
                            @php
                                if (!empty($ft_city)){
                                     $selected = ($value == $ft_city) ? 'selected' : ' ';
                                      echo $selected;
                                }
                            @endphp
                        >
                            {{$value}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-item mb-3">
                <lable class="h4 text-cl-main d-block mb-3">{{__('frontPage.salaryRange')}}</lable>
                <input type="text" id="range_salary" data-plugin="range-slider" data-type="double"
                       data-grid="true"
                       @if(!empty($fr_min_salary) && !empty($fr_max_salary))
                           data-from="{{$fr_min_salary}}"
                       data-to="{{$fr_max_salary}}"
                       @else
                           data-from="{{$configs['filter_min_salary']}}"
                       data-to="{{$configs['filter_max_salary']}}"
                       @endif
                       data-min="{{$configs['filter_min_salary']}}"
                       data-max="{{$configs['filter_max_salary']}}"
                       data-prefix="$"/>
                <input type="hidden" name="min_salary"
                       @if(!empty($fr_min_salary))value="{{$fr_min_salary}}" @endif
                       id="min_salary">
                <input type="hidden" name="max_salary"
                       @if(!empty($fr_max_salary))value="{{$fr_max_salary}}" @endif
                       id="max_salary">
            </div>
            <div class="filter-item mb-3">
                <lable class="h4 text-cl-main d-block my-1">{{__('frontPage.workPlace')}}</lable>
                <select name="remote" class="form-control" id="">
                    @foreach($arrRemote as $key=>$value)
                        <option value="{{$value}}"
                                @if($fr_remote == $value)
                                    selected
                            @endif
                        >
                            {{__('frontPage.'.$key)}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-item mb-3">
                <lable class="h4 text-cl-main d-block my-1">{{__('frontPage.workingTime')}}</lable>
                <select class="form-control" name="can_parttime" id="">
                    <option value="0">{{__('frontPage.full_time')}}</option>
                    <option value="1">{{__('frontPage.part_time')}}</option>
                </select>
            </div>
            <div class="filter-item mb-3 text-center">
                <button type="submit" class="btn btn-primary w-75 ">{{__('frontPage.filter')}}</button>
            </div>
        </div>
    </form>
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            const ft_jobs = $('#fr_jobs');
            const rangeSalary = $('#range_salary');
            const min_salary = $('#min_salary');
            const max_salary = $('#max_salary');

            $('#fm-filter').on('change', '#range_salary', function () {
                let range = $(this).val().split(';');
                min_salary.val(range[0]);
                max_salary.val(range[1]);
                console.log('min salary: ', min_salary.val());
                console.log('max salary:', max_salary.val());
            });

            // function filter
        });
    </script>
@endpush
