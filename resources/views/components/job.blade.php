<div class="job-item p-4 mb-5 position-relative">
    @if((session()->has("user")) && (session()->get("user")->isCompany) && ($job->company_id == session()->get("user")->id) && ($job->boosted))
        <div class="boostedJob">
            <span class="btn">Boosted<i class="fas fa-bolt ms-4"></i></span>
        </div>
    @endif
    @if(($job->isBoosted()) && ((!session()->has("user")) || (((session()->get("user")->isCompany) && ($job->company_id != session()->get("user")->id)) || (!session()->get("user")->isCompany))))
        <div class="boostedJob d-flex align-items-center px-3">
            <i class="fas fa-gem"></i>
            <span class="btn">Featured Job</span>
        </div>
    @endif

    @if((session()->has("user")) && (session()->get("user")->isCompany) && ($job->company_id == session()->get("user")->id) && (!$job->boosted))
        <div class="boostJob">
            <a href="" class="btn btn-warning" data-id="{{$job->id}}">Boost Job<i class="fas fa-bolt"></i></a>
        </div>
    @endif
    @if((session()->has("user")) && (session()->get("user")->isCompany) && ($job->company_id == session()->get("user")->id))
        <div class="deleteJob">
            <a href="" class="btn btn-danger" data-id="{{$job->id}}">X</a>
        </div>
    @endif


    <div class="row g-4">
        <div class="col-sm-12 col-md-8 d-flex align-items-center">
            <a href="{{route("companies.show", $job->company->id)}}"><img class="flex-shrink-0 border" src="{{asset("assets/img/companies/" . $job->company->logo)}}" alt="" style="width: 80px; height: 80px;"></a>
            <div class="text-start ps-4">
                <a href="{{route("jobs.show", $job->id)}}"><h5 class="mb-3 jobName">{{$job->name}}</h5></a>
                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city->name}}</span>
                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$job->full_time ? "Full time" : "Part-time"}}</span>
                <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>{{$job->seniority->name}}</span>
                <span class="text-truncate me-3"><i class="fas fa-briefcase text-primary me-2"></i>{{$job->workplace->name}}</span>

                @if($job->salary)
                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{$job->salary}}&euro;</span>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
            <div class="d-flex mb-3">
                @if(session()->has("user") && !session()->get("user")->isCompany && !session()->get("user")->isAdmin)
                    @if($job->saved_jobs->where("id", session()->get("user")->id)->first())
                        <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$job->id}}" href=""><i class="fas fa-heart text-primary"></i></a>
                    @else
                        <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$job->id}}" href=""><i class="far fa-heart text-primary"></i></a>
                    @endif
                @endif
                @if(session()->has("user") && !session()->get("user")->isCompany && $job->applications->where("user_id", session()->get("user")->id)->first())
                    <a class="btn btn-muted" href="{{route("jobs.show", $job->id)}}">Applied</a>
                @elseif(!session()->has("user") || ((session()->has("user") && !session()->get("user")->isCompany) && !session()->get('user')->isAdmin))
                    <a class="btn btn-primary" href="{{route("jobs.show", $job->id)}}">Apply Now</a>
                @else
                    <a class="btn btn-primary" href="{{route("jobs.show", $job->id)}}">View job</a>
                @endif

            </div>
            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{date('d/m/Y', strtotime($job->application_deadline))}}</small>
        </div>
        <div class="col-12">
            <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                @if($job->technology)
                    @foreach($job->technology as $technology)
                        <span class="badge bg-primary me-2">{{$technology->name}}</span>
                    @endforeach
                    <span class="badge bg-primary me-2">{{$job->seniority->name}}</span>
                @else
                    <span class="badge bg-primary me-2">{{$job->seniority->name}}</span>
                @endif
            </div>
        </div>
    </div>
</div>
