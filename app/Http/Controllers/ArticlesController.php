<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{

    public function formatPublishDate($publishDateString)
    {
        $now = new \DateTime();
        $date = new \DateTime($publishDateString);

        $diff = $now->getTimestamp() - $date->getTimestamp();
        $diffMinutes = floor($diff / 60);
        $diffHours = floor($diff / 3600);
        $diffDays = floor($diff / 86400);

        if (
            $now->format('Y') === $date->format('Y') &&
            $now->format('m') === $date->format('m') &&
            $now->format('d') === $date->format('d') &&
            $now->format('H') === $date->format('H')
        ) {
            return $diffMinutes === 1 ? "1 minuto fa" : "$diffMinutes minuti fa";
        }

        if (
            $now->format('Y') === $date->format('Y') &&
            $now->format('m') === $date->format('m') &&
            $now->format('d') === $date->format('d')
        ) {
            return $diffHours === 1 ? "1 ora fa" : "$diffHours ore fa";
        }

        if ($diffDays < 7) {
            return $diffDays === 1 ? "1 giorno fa" : "$diffDays giorni fa";
        }

        return $date->format('d/m/Y');
    }

    public function get_articles(Request $request, $offset = 0, $limit = 8)
    {
        
        $articlesQuery = Article::with(['authorUser:id,name,surname'])
            ->orderByDesc('publishDate')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $articles = [];
        foreach ($articlesQuery as $article) {
            $articles[] = [
                'id' => $article->id,
                'title' => $article->title,
                'publishDate' => $this->formatPublishDate($article->publishDate),
                'author' => $article->authorUser->name . ' ' . $article->authorUser->surname,
                'description' => $article->description,
                'imgSrc' => $article->imgSrc,
                'likes_count' => $article->likes_count ?? 0,
            ];
        }

        return response()->json(['articles' => $articles]);
    }

    public function user_articles(Request $request, $offset = 0, $limit = 8)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        $articlesQuery = Article::with(['authorUser:id,name,surname'])
            ->where('author', $user_id)
            ->orderByDesc('publishDate')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $articles = [];
        foreach ($articlesQuery as $article) {
            $articles[] = [
                'id' => $article->id,
                'title' => $article->title,
                'publishDate' => $this->formatPublishDate($article->publishDate),
                'author' => $article->authorUser->name . ' ' . $article->authorUser->surname,
                'description' => $article->description,
                'imgSrc' => $article->imgSrc,
                'likes_count' => $article->likes_count ?? 0,
            ];
        }

        return response()->json([
            'articles' => $articles]);
    }

    public function article_view(Request $request, $id)
    {
        $article = Article::with(['authorUser:id,name,surname,avatar'])
            ->find($id);

        $articleArray = [
            'id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'publishDate' => $this->formatPublishDate($article->publishDate),
            'author' => [
                'name' => $article->authorUser->name,
                'surname' => $article->authorUser->surname,
                'avatar' => $article->authorUser->avatar,
            ],
        ];

        $user = null;
        $user_id = Session::get('user_id');
        if ($user_id) {
            $user = \App\Models\User::find($user_id);
        }

        return view('article', [
            'article' => $articleArray,
            'user' => $user
        ]);
    }

    public function like_article(Request $request)
    {
        $user = Session::get('user_id');
        if (!$user) {
            return response()->json([
                'success' => false,
                'authenticated' => false,
                'error' => 'Utente non autenticato'
            ]);
        }

        $article_id = intval($request->input('article_id', 0));
        if ($article_id <= 0) {
            return response()->json([
                'success' => false,
                'error' => 'ID articolo non valido'
            ]);
        }

        $like = Likes::where('user_id', $user)
            ->where('article_id', $article_id)
            ->first();

        if ($like) {
            $like->delete();

            $likes_count = \App\Models\Article::where('id', $article_id)
                ->value('likes_count') ?? 0;

            return response()->json([
                'article_id' => $article_id,
                'success' => true,
                'liked' => false,
                'authenticated' => true,
                'likes_count' => $likes_count
            ]);
        } else {
            $inserted = Likes::create([
                'user_id' => $user,
                'article_id' => $article_id
            ]);

            if ($inserted) {
                $likes_count = \App\Models\Article::where('id', $article_id)
                    ->value('likes_count') ?? 0;

                return response()->json([
                    'article_id' => $article_id,
                    'success' => true,
                    'liked' => true,
                    'authenticated' => true,
                    'likes_count' => $likes_count
                ]);
            } else {
                return response()->json([
                    'article_id' => $article_id,
                    'success' => false,
                    'liked' => false,
                    'authenticated' => true,
                    'error' => 'Errore durante l\'inserimento del like'
                ]);
            }
        }
    }

    public function check_like(Request $request)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return response()->json([
                'success' => false,
                'authenticated' => false,
                'error' => 'Utente non autenticato'
            ]);
        }

        $article_id = intval($request->input('article_id', 0));
        if ($article_id <= 0) {
            return response()->json([
                'success' => false,
                'error' => 'ID articolo non valido'
            ]);
        }

        $like = Likes::where('user_id', $user_id)
            ->where('article_id', $article_id)
            ->first();

        return response()->json([
            'article_id' => $article_id,
            'success' => true,
            'liked' => $like ? true : false,
            'authenticated' => true
        ]);
    }

    public function check_email(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        
        return response()->json([
            'exists' => $user ? true : false
        ]);
    }
}