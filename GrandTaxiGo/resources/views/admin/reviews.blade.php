@extends('layouts.admin')
@section('titre', 'Review Management')

@section('content')
  <!-- Reviews Tab -->
  <div id="reviews" class="tab-content ">
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Gestion des avis</h2>
      <p class="text-gray-600">Modération des avis et commentaires</p>
    </div>

    <!-- Reviews List -->
    <div class="space-y-4">
        @if($reviews->isEmpty())
    <p>Aucun avis disponible.</p>
@else
      @foreach($reviews as $review)
        <div class="bg-white rounded-lg shadow-lg p-6">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <!-- Replace the placeholder with the user's actual avatar -->
              <img class="h-10 w-10 rounded-full" src="{{asset('storage/'.$review->passenger->profile_picture)}}" alt="User Avatar">
              <div class="ml-4">
                <h4 class="text-sm font-medium text-gray-900">{{ $review->passenger->f_name }} {{ $review->passenger->l_name }}</h4>
                <div class="flex items-center">
                  <!-- Show the actual rating dynamically -->
                  <span class="text-yellow-400">
                    @for($i = 0; $i < $review->review; $i++)
                      ★
                    @endfor
                  </span>
                  <span class="ml-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>

            <div class="flex space-x-2">
              <!-- Approve Button -->
              

              <!-- Delete Button -->
              <form action="{{route('delete.review',$review->id)}}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                  Supprimer
                </button>
              </form>
            </div>
          </div>
          
          <!-- Display the review text -->
          <p class="text-gray-700">{{ $review->comment}}</p>
        </div>
      @endforeach
      @endif

    </div>
  </div>
@endsection
