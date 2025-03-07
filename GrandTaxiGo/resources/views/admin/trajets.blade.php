@extends('layouts.admin')
@section('titre','trajes')
@section('content')

<div id="trips" class="tab-content hidden">
      <h2 class="text-2xl font-bold text-gray-800">Gestion des trajets</h2>
      <p class="text-gray-600">Suivi des réservations et trajets</p>
    </div>

    <!-- Trips Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Trajets en cours</h3>
        <p class="text-3xl font-bold text-yellow-400">24</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">En attente</h3>
        <p class="text-3xl font-bold text-yellow-400">12</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Complétés aujourd'hui</h3>
        <p class="text-3xl font-bold text-yellow-400">89</p>
      </div>
    </div>

    <!-- Trips Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Trajet</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chauffeur</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        @foreach($announcements as $announcement )
        <tbody class="bg-white divide-y divide-gray-200">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{$announcement->driver->id}}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-8 w-8">
                  <img class="h-8 w-8 rounded-full" src="{{asset('storage/'.$announcement ->driver->profile_picture)}}" alt="">
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{$announcement->driver->f_name}} {{$announcement->driver->l_name}}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{$announcement->trip_start}} --> {{$announcement ->trip_end}} </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                {{$announcement ->status}}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <button class="text-indigo-600 hover:text-indigo-900">Détails</button>
            </td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
        @endforeach
      </table>
    </div>




@endsection
