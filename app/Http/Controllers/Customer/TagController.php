<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index(Request $request)
    {
		$perPage = 10; // Adjust as necessary
		$user_id = Auth::user()->id;

		// Create a new query for the Subject model
		$query = Tag::query();

		$query->where('user_from_id',$user_id)
				->with(['user_to'])
				->orderBy('id','DESC');
							
		// Paginate the query results
		$tags = $query->paginate($perPage);
							
		return view('customer.tags.index', compact('tags'));
    }

    public function create($user_id)
    {
		$auth_user_id = Auth::user()->id;

		if($auth_user_id == $user_id){	
			return redirect()->back()->with('error',  'You cannot tag yourself');
		}

		$tagged = Tag::where('user_from_id',$auth_user_id)
					->where('user_to_id',$user_id)
					->first();
		
		
		if($tagged->isNotEmpty()){	
			return redirect()->back()->with('error', 'You have already tagged this user');
		}

		$tag_data  = [
			'user_from_id' => $auth_user_id,
			'user_to_id' => $user_id,
			'date' => date('Y-m-d H:i:s'),
			'status' => 1
		];
		
		Tag::create($tag_data);
		
		return redirect()->back()->with('success',  'User tagged successfully');
    }
    
    public function delete($id)
    {
		$auth_user_id = Auth::user()->id;

		$tagged = Tag::where('user_from_id',$auth_user_id)
					->where('id',$id)
					->delete();

		if($tagged){
			return redirect()->back()->with('success',  'Tag removed successfully');
		}else{
			return redirect()->back()->with('error',  'Tag not found');
		}
	}
	
}

