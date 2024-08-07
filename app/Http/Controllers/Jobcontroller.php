<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jobcontroller extends Controller
{
    function addJob(Request $req){

        $data = [
            'dept' => $req->input('dept'),
            'vacancy' => intval($req->input('vacancy')),
            'category' => $req->input('category'),
            'area' => $req->input('area'),
            'company_name' => $req->input('company_name'),
            
        ];

        try {
            DB::table('jobs')->insert($data);
            return response()->json(['message' => 'Job created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create job.'], 500);
        }

        return response()->json(['message' => 'User created successfully.']);
        
    }

    public function updateJob(Request $req, $id)
    {
        $data = [
            'dept' => $req->input('dept'),
            'vacancy' => $req->input('vacancy'),
            'category' => $req->input('category'),
            'area' => $req->input('area'),
            'company_name' => $req->input('company_name'),
        ];

        try {
            $affectedRows = DB::table('jobs')
                ->where('id', $id)
                ->update($data);

            if ($affectedRows > 0) {
                return response()->json(['message' => 'Job updated successfully.'], 200);
            } else {
                return response()->json(['message' => 'No job found to update.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update job.'], 500);
        }
    }


    public function deleteJob($id)
    {
        try {
            // Delete the job from the 'jobs' table
            $deletedRows = DB::table('jobs')
                ->where('id', $id)
                ->delete();

            if ($deletedRows > 0) {
                return response()->json(['message' => 'Job deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'No job found to delete.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete job.'], 500);
        }
    }

    public function getAllJobs()
    {
        try {
            
            $jobs = DB::table('jobs')->get();

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch jobs.'], 500);
        }
    }

    public function getJobInfo($id)
{
    try {
        
        $job = DB::table('jobs')
            ->where('id', $id)
            ->first();

        if ($job) {
            return response()->json(['job' => $job], 200);
        } else {
            return response()->json(['message' => 'Job not found.'], 404);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve job information.'], 500);
    }
}
}
