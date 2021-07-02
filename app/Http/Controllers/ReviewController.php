<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(User $user)
    {
        $reviews = Review::where('user_id', $user->id)->where('anonymous', '0')->paginate(15);
        return view('reviews.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Commission $commission
     * @return Application|Factory|View|Response
     */
    public function create(Commission $commission)
    {
        if ($commission->status == 'Archived' && $commission->isBuyer()) {
            return view('reviews.create', ['commission' => $commission]);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Commission $commission
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Commission $commission, Request $request)
    {
        if ($commission->status != 'Archived' || !$commission->isBuyer()) {
            abort(404);
        }
        $res = $request->validate([
            'positive' => 'required|min:0|max:1',
            'anonymous' => 'required|min:0|max:1',
            'message' => 'max:2048',
        ]);
        $review = Review::make($res);
        $review->commission_id = $commission->id;
        $review->user_id = auth()->id();
        $review->save();
        return redirect()
            ->to(route('reviews.show', $review->fresh()))
            ->with('success', 'Review created');
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     * @return Application|Factory|View|Response
     */
    public function show(Review $review)
    {
        if ($review->anonymous == 1 && $review->user_id != auth()->id()) {
            abort(404);
        }
        return view('reviews.show', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     * @return Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Review $review
     * @return Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            abort(404);
        }
        $review->delete();
        return redirect()
            ->to(route('commissions.orders'))
            ->with('success', 'Review deleted');
    }
}
