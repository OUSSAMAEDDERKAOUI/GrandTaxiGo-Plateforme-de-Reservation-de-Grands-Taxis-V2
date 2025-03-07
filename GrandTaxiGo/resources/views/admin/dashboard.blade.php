@extends('layouts.admin')

@section('Title', 'Dashboard')
@section('content') 

    <!-- Mobile menu button -->
    <button id="mobile-menu-button" class="sm:hidden mb-4 p-2 rounded-lg hover:bg-gray-100">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>

    <!-- Dashboard Tab -->
    <div id="dashboard" class="tab-content">
      <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
        <p class="text-gray-600">Vue d'ensemble des activités</p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold text-gray-600">Utilisateurs actifs</h3>
          <p class="text-3xl font-bold text-yellow-400">{{$allUsers}}</p>
          <p class="text-sm text-gray-500">+12% ce mois</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold text-gray-600">Trajets aujourd'hui</h3>
          <p class="text-3xl font-bold text-yellow-400">{{$allAnouncements}}</p>
          <p class="text-sm text-gray-500">+5% vs hier</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold text-gray-600">Revenu mensuel</h3>
          <p class="text-3xl font-bold text-yellow-400">{{$revenu_parse}} DH</p>
          <p class="text-sm text-gray-500">+8% vs dernier mois</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold text-gray-600">Note moyenne</h3>
          <p class="text-3xl font-bold text-yellow-400">4.8</p>
          <p class="text-sm text-gray-500">Sur 5 étoiles</p>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-semibold mb-4">Activité récente</h3>
        <div class="space-y-4">
          <div class="flex items-center p-4 bg-gray-50 rounded-lg">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-400 flex items-center justify-center text-white">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-900">Nouveau chauffeur inscrit</p>
              <p class="text-sm text-gray-500">Il y a 5 minutes</p>
            </div>
          </div>
          <div class="flex items-center p-4 bg-gray-50 rounded-lg">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-400 flex items-center justify-center text-white">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-900">Trajet complété</p>
              <p class="text-sm text-gray-500">Il y a 12 minutes</p>
            </div>
          </div>
        </div>
      </div>


@endsection