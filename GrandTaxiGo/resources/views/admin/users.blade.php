@extends('layouts.admin');
@section('title','users');
@section('content')
          <!-- Search and Filter -->
          <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
            <div class="flex flex-col md:flex-row gap-4">
              <div class="flex-1">
                <input type="text" placeholder="Rechercher un utilisateur..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
              </div>
              <div class="flex gap-2">
                <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                  <option>Tous les rôles</option>
                  <option>Chauffeurs</option>
                  <option>Passagers</option>
                </select>
                <button class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500">Filtrer</button>
              </div>
            </div>
          </div>

          <!-- Users Table -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              @foreach($users as $user)
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" src="{{asset('storage/'.$user->profile_picture)}}" alt="">
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{$user->f_name}} {{$user->l_name}}</div>
                        <div class="text-sm text-gray-500">{{$user->email}} </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        {{ implode(', ', $user->getRoleNames()->toArray()) }}
                    </span>
                    
                    
                    
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      
                      @if($user->is_available=='true') 
                      Active
                      @else
                      Inactive
                      @endif
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <form method="POST" action="{{route("admin.delete.user",$user->id)}}">
                        @csrf
                        <button class="ml-4 text-red-600 hover:text-red-900">Suspendre</button>

                    </form>
                  </td>

                </tr>
              </tbody>
              @endforeach
            </table>
            <div class="px-6 py-4">
                {{ $users->links() }}
            </div>
          </div>
        </div>


@endsection
