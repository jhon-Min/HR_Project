@extends('layouts.app')

@section('title')
    {{ $project->title }}
@endsection

@section('head')
    <style>
        .project-desc{
            word-spacing: 1px;
            line-height: 23px;
        }

        .show-img{
            width: 120px;
            border-radius: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('project.index') }}">Projects</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Project Detail
                    </li>
                </x-bread-crumb>

               <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="">{{ $project->title }}</h4>
                                    <div>
                                        <span class="text-theme small font-weight-bold">Start Date: {{ $project->start_date }}</span>
                                        <span class="mx-2 text-semi">|</span>
                                        <span class="text-theme small font-weight-bold">Deadline: {{ $project->deadline }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <p class="text-semi d-flex align-items-center">
                                        <span class="mr-1">Priority:</span>
                                        @if($project->priority == 'high')
                                        <span class="badge badge-pill badge-danger">High</span>
                                        @elseif($project->priority == 'middle')
                                        <span class="badge badge-pill badge-info">Middle</span>
                                        @elseif($project->priority == 'low')
                                        <span class="badge badge-pill badge-dark">Low</span>
                                        @endif
                                    </p>
                                    <p class="mx-2"></p>
                                    <p class="text-semi d-flex align-items-center">
                                        <span class="mr-1">Status:</span>
                                        @if($project->status == 'pending')
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif($project->status == 'in_progrss')
                                        <span class="badge badge-pill badge-info">In Progress</span>
                                        @elseif($project->status == 'complete')
                                        <span class="badge badge-pill badge-success">Complete</span>
                                        @endif
                                    </p>
                                </div>
                                <p class="mt-3 project-desc">{{ $project->description }}</p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="mb-3">Images</h5>
                                <div id="imgs">
                                    @isset($project->images)
                                        @foreach ($project->images as $image)
                                        <img src="{{ asset('storage/project/'.$image) }}" alt="" class="show-img shadow-sm mr-1 mb-2">
                                        @endforeach
                                    @else
                                        <p class="text-semi text-center">No Image Here</p>
                                    @endisset
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-body">
                                <h5 class="mb-3">Files</h5>
                                @isset($project->files)
                                    @foreach ($project->files as $file)
                                    <a href="{{asset('storage/project/' . $file)}}" class="pdf-thumbnail" target="_blank"><i class="fas fa-file-pdf"></i> <p class="mb-0 small">File {{$loop->iteration}}</p></a>
                                    @endforeach

                                @else
                                   <p class="text-semi text-center">No File Here</p>
                                @endisset
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="mb-3">Leaders</h6>
                                    @forelse ($project->leaders as $leader)
                                    <img src="{{ asset($leader->profile_img_path()) }}" alt="" class="leader-thumb-1 shadow-sm mr-1 mb-2">
                                    @empty
                                    <small class="text-semi text-center">No Leader Here</small>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="mb-3">Members</h6>
                                    @forelse ($project->members as $member)
                                    <img src="{{ asset($member->profile_img_path()) }}" alt="" class="member-thumb-1 shadow-sm mr-1 mb-2">
                                    @empty
                                    <small class="text-semi text-center">No Member Here</small>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
               </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            new Viewer(document.getElementById('imgs'));
        })
    </script>
@endsection


