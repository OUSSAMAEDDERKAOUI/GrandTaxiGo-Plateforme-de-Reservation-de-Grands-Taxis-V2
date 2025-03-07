@extends('layouts.passenger')

@section('title', 'Historique des trajets')

@section('header', 'Historique des trajets')

@section('content')
<div x-data="tripsHistory()">

    <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form action="" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input 
                    name="location"
                        type="text" 
                        placeholder="Rechercher par lieu..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Période</label>
                    <select 
                    name="availability"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="all">Toutes les périodes</option>
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select 
                        x-model="statusFilter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Tous les statuts</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                        <option value="pending">En attente</option>
                        <option value="ongoing">En cours</option>
                    </select>
                </div>
            </div>
        </form>
 
    </div>

    <!-- Trips Table -->
    <div class="  bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Date</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Départ
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Destination
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Statut</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Payer
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                @foreach($reservations as $reservation)
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($reservation->announcement && $reservation->announcement->departure_date)
                                {{ $reservation->announcement->departure_date }} 
                            @else
                                {{ $reservation->departure_time }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{$reservation->pickup_location}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($reservation->announcement && $reservation->announcement->trip_end)
                                {{ $reservation->announcement->trip_end }}
                            @else
                                {{ $reservation->destination }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $reservation->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $reservation->status == 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $reservation->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $reservation->status == 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{$reservation->status}}
                            </span>
                        </td>
                       
                        <!-- Payer Button -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">
                            @if($reservation->announcement && $reservation->announcement->price && $reservation->status == 'confirmed')
                                <form method="POST" action="{{ route('payment.form', ['announcement_id' => $reservation->announcement_id, 'price' => $reservation->announcement->price]) }}">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-medium px-4 py-2 bg-green-200 rounded-lg transition-all duration-200 ease-in-out hover:bg-green-300">
                                        Payer
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">Pas de prix disponible</span>
                            @endif
                        </td>
    
                        <!-- Annuler Button -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 
                                {{ $reservation->status == 'completed' || $reservation->status == 'rejected' || $reservation->status == 'cancelled' ? 'hidden' : '' }}">
                            <form method="POST" action="{{ route('cancel.reservation', $reservation->id) }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium px-4 py-2 bg-red-200 rounded-lg transition-all duration-200 ease-in-out hover:bg-red-300">
                                    Annuler
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 
                        {{ $reservation->status === 'completed' ? '' : 'hidden' }}">
                        <button  data-driver="{{$reservation->driver_id}}" class="showReview text-blue-600 hover:text-blue-900 font-medium px-4 py-2 bg-blue-200 rounded-lg transition-all duration-200 ease-in-out hover:bg-blue-300 inline-block text-center">
                            Review
                        </button>
                        
                         
                    </td>
                    

                    </tr>
                </tbody>
                @endforeach
    
                @if(session('error'))
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-red-500">
                        {{ session('error') }}
                    </td>
                </tr>
                @endif
            </table>
            <div class="px-6 py-4">
                {{ $reservations->links() }}
            </div>
            
        </div>
    </div>
</div>
<div id="reviewModal" class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4  items-center justify-center p-4 hidden">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full relative">
      <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Évaluation du Service</h1>

      <!-- Formulaire -->
      <form id="reviewForm" action="{{route('storeReview')}}" method="POST">
        @csrf
        <input id="id_driver" name="driver_id" type="hidden" value="">

      <div id="stars" class="flex justify-center gap-2 mb-4"></div>

        <input type="hidden" name="rating" id="rating" value="0">
        <div class="space-y-2">
          <label for="comment" class="block text-sm font-medium text-gray-700">Commentaire</label>
          <textarea id="comment" name="comment" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Partagez votre expérience..." required></textarea>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-3 rounded-md hover:bg-indigo-700">
          Envoyer l'évaluation
        </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
<script>
 document.querySelectorAll('.showReview').forEach(btn => {
        
        btn.onclick = function() {
            console.log('ahmed');
            document.getElementById('reviewModal').classList.remove('hidden');

            document.getElementById('id_driver').value = btn.dataset.driver;

        };

    })

let currentRating = 0;

// Fonction pour créer les étoiles
function createStarRating() {
  const starsContainer = document.getElementById('stars');
  for (let i = 1; i <= 5; i++) {
    const star = document.createElement('button');
    star.type = 'button';
    star.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 transition-colors duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                      </svg>`;
    
    // Événements pour modifier l'apparence des étoiles au survol et au clic
    star.addEventListener('mouseover', () => updateStars(i, true));
    star.addEventListener('mouseout', () => updateStars(currentRating, false));
    star.addEventListener('click', () => {
      currentRating = i;
      document.getElementById('rating').value = currentRating; // Met à jour la valeur du champ caché
      updateStars(i, false);
    });

    starsContainer.appendChild(star);
  }
}

// Fonction pour mettre à jour l'apparence des étoiles
function updateStars(rating, isHover) {
  const stars = document.querySelectorAll('#stars button svg');
  stars.forEach((star, index) => {
    if (index < rating) {
      star.classList.add('text-yellow-400', 'fill-yellow-400');
      star.classList.remove('text-gray-300');
    } else {
      star.classList.remove('text-yellow-400', 'fill-yellow-400');
      star.classList.add('text-gray-300');
    }
  });
}

// Initialisation des étoiles lors du chargement de la page
document.addEventListener('DOMContentLoaded', createStarRating);
</script>
@endsection
