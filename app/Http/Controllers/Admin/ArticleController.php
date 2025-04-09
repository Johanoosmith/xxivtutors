<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Subscription;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->user . '%')
                    ->orWhere('lastname', 'like', '%' . $request->user . '%')
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->user . "%"]);
            });
        }

        // Optional: Handle per_page selection
        $perPage = $request->get('per_page', 10);
        $articles = $query->paginate($perPage)->appends($request->all());

        return view('admin.article.index', [
            'articles' => $articles
        ]);
    }

    public function approve(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = 1;
        $article->reject_reason = null;
        $article->save();

        return response()->json(['success' => true]);
    }

    public function reject(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'reject_reason' => 'required|string|max:255'
        ]);

        $article = Article::findOrFail($request->article_id);
        $article->status = 2;
        $article->reject_reason = $request->reject_reason;
        $article->save();

        return response()->json(['success' => true]);
    }
}
