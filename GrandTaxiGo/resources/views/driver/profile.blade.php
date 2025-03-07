@extends('layouts.driver')

@section('title', 'Gérer mon profile')
@section('header', 'Gérer mon profile')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
      <div class="flex flex-col md:flex-row items-center">
        <div class="relative">
          <img id="profileImage" src="{{asset('storage/'.$profile[0]->profile_picture)}}" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-400">
          <button onclick="triggerFileInput()" class="absolute bottom-0 right-0 bg-blue-400 p-2 rounded-full hover:bg-blue-500 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
          </button>
          <input type="file" id="fileInput" class="hidden" accept="image/*">
        </div>
        <div class="md:ml-6 mt-4 md:mt-0 text-center md:text-left">
          <h1 class="text-2xl font-bold text-gray-800">{{$profile[0]->f_name}} {{$profile[0]->l_name}}</h1>
          <p class="text-gray-600">Chauffeur professionnel</p>
          <div class="flex items-center justify-center md:justify-start mt-2">
            <div class="flex items-center">
              <span class="text-yellow-400">★★★★</span><span class="text-gray-300">★</span>
              <span class="ml-1 text-gray-600">(4.0)</span>
            </div>
            <span class="mx-2 text-gray-300">|</span>
            <span class="text-gray-600">10 trajets</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Informations détaillées -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Informations personnelles -->
      <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Informations personnelles</h2>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <p class="mt-1">{{$profile[0]->email}}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
            <p class="mt-1">+212 654 766 875</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Ville</label>
            <p class="mt-1">{{$profile[0]->location}}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Membre depuis</label>
            <p class="mt-1">{{ \Carbon\Carbon::parse($profile[0]->created_at)->format('d-m-y') }}</p>
        </div>
        </div>
      </div>

      <!-- Statistiques -->
      <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Statistiques</h2>
        <div class="grid grid-cols-2 gap-4">
          <div class="text-center p-4 bg-gray-50 rounded-lg">
            <p class="text-2xl font-bold text-yellow-400">150</p>
            <p class="text-sm text-gray-600">Trajets effectués</p>
          </div>
          <div class="text-center p-4 bg-gray-50 rounded-lg">
            <p class="text-2xl font-bold text-yellow-400">4.0</p>
            <p class="text-sm text-gray-600">Note moyenne</p>
          </div>
          <div class="text-center p-4 bg-gray-50 rounded-lg">
            <p class="text-2xl font-bold text-yellow-400">98%</p>
            <p class="text-sm text-gray-600">Taux de satisfaction</p>
          </div>
          <div class="text-center p-4 bg-gray-50 rounded-lg">
            <p class="text-2xl font-bold text-yellow-400">5k</p>
            <p class="text-sm text-gray-600">Km parcourus</p>
          </div>
        </div>
      </div>

      </div>

      <!-- Avis récents -->
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
              
            </div>
          </div>
          
          <!-- Display the review text -->
          <p class="text-gray-700">{{ $review->comment}}</p>
        </div>
      @endforeach
      @endif

    </div>
    </div>
  </div>

  <script type="module" src="/main.js"></script>

@endsection