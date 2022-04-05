<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\ProjectLeader;
use App\ProjectMember;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('view_project')) {
            abort(403, 'Unauthorized action');
        }
        return view('project.index');
    }

    public function ssd(Request $request)
    {
        $projects = Project::query();
        return DataTables::of($projects)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('description', function ($each) {
                return Str::limit($each->description, 50, ' ....');
            })
            ->addColumn('leaders', function ($each) {
                $output = '';
                foreach ($each->leaders as $leader) {
                    $output .= '<img src="' . $leader->profile_img_path() . '" alt="" class="profile-thumb-2">';
                }

                return $output;
            })
            ->addColumn('members', function ($each) {
                return '-';
            })
            ->editColumn('status', function ($each) {
                if ($each->status == 'pending') {
                    return "<span class='badge badge badge-warning p-1'>Pending</span>";
                } else if ($each->status == 'in_progress') {
                    return "<span class='badge badge badge-info p-1'>In Progress</span>";
                } else if ($each->status == 'complete') {
                    return "<span class='badge badge badge-success p-1'>Complete</span>";
                }
            })
            ->editColumn('priority', function ($each) {
                if ($each->priority == 'high') {
                    return "<span class='badge badge badge-danger p-1'>High</span>";
                } else if ($each->priority == 'middle') {
                    return "<span class='badge badge badge-info p-1'>Middle</span>";
                } else if ($each->priority == 'low') {
                    return "<span class='badge badge badge-dark p-1'>Low</span>";
                }
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '';
                $del = '';
                $detail = '';

                if (auth()->user()->can('edit_project')) {
                    $edit = '<a href="' . route('project.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                }

                $detail = '<a href="' . route('project.show', $each->id) . '" class="btn btn-sm btn-secondary p-2 rounded mr-2"><i class="fa-solid fa-circle-info"></i></a>';

                if (auth()->user()->can('delete_project')) {
                    $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';
                }

                return '<div class="action-icon">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action', 'status', 'priority', 'leaders'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create_project')) {
            abort(403, 'Unauthorized action');
        }

        $employees = User::all();
        return view('project.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        if (!auth()->user()->can('create_project')) {
            abort(403, 'Unauthorized Action');
        }

        $images = null;
        if ($request->hasFile('images')) {
            $images = [];
            $img_files = $request->file('images');
            foreach ($img_files as $img_file) {
                $newName = 'project_' . uniqid() . '.' . $img_file->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($img_file));
                $images[] = $newName;
            }
        }

        $files = null;
        if ($request->hasFile('files')) {
            $files = [];
            $file_names = $request->file('files');
            foreach ($file_names as $file_name) {
                $newName = 'project_' . uniqid() . '.' . $file_name->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($file_name));
                $files[] = $newName;
            }
        }

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->images = $images;
        $project->files = $files;
        $project->start_date = $request->start_date;
        $project->deadline = $request->deadline;
        $project->priority = $request->priority;
        $project->status = $request->status;
        $project->save();

        foreach (($request->leaders ?? []) as $leader) {
            $project_leader = new ProjectLeader();
            $project_leader->project_id = $project->id;
            $project_leader->user_id = $leader;
            $project_leader->save();
        }

        foreach (($request->members ?? []) as $member) {
            $project_member = new ProjectMember();
            $project_member->project_id = $project->id;
            $project_member->user_id = $member;
            $project_member->save();
        }

        return redirect()->route('project.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $project->title . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (!auth()->user()->can('delete_project')) {
            abort(403, 'Unauthorized action');
        }
        $project->delete();
    }
}
