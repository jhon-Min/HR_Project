<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MyProjectController extends Controller
{
    public function index()
    {
        return view('my.my-project');
    }

    public function ssd(Request $request)
    {
        $projects = Project::with('leaders', 'members')
            ->whereHas('leaders', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->orWhereHas('members', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });

        return DataTables::of($projects)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            // ->editColumn('description', function ($each) {
            //     return Str::limit($each->description, 50, ' ....');
            // })
            ->addColumn('leaders', function ($each) {
                $output = "<div class=' position-absolute'>";
                foreach ($each->leaders as $leader) {
                    $output .= '<img src="' . $leader->profile_img_path() . '" alt="" class="leader-thumb-2 shadow-sm">';
                }

                return $output;
            })
            ->addColumn('members', function ($each) {
                $output = "<div class=' position-absolute'>";
                foreach ($each->members as $member) {
                    $output .= '<img src="' . $member->profile_img_path() . '" alt="" class="member-thumb-2 shadow-sm">';
                }

                return $output;
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
                $detail = '';

                $detail = '<a href="' . route('my-project.show', $each->id) . '" class="btn btn-sm btn-secondary p-2 rounded mr-2"><i class="fa-solid fa-circle-info"></i></a>';

                return '<div class="action-icon">'  . $detail . '</div>';
            })
            ->rawColumns(['action', 'status', 'priority', 'leaders', 'members'])
            ->make(true);
    }

    public function show($id)
    {
        $project = Project::with('leaders', 'members')
            ->where('id', $id)
            ->where(function ($query) {
                $query->whereHas('leaders', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })->orWhereHas('members', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            })->firstOrFail();

        return view('my.my-project-show', compact('project'));
    }
}
