<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GrandTaxiGo - @yield('titre')</title>
    <link rel="stylesheet" href="/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
  </head>
  <body class="bg-gray-100">
    <div class="min-h-screen">
      <!-- Sidebar -->
      <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r">
          <div class="mb-8 px-2">
            <h1 class="text-2xl font-bold text-gray-800">GrandTaxiGo</h1>
            <p class="text-sm text-gray-600">Administration</p>
          </div>
          <ul class="space-y-2">
            <li>
              <a href="{{route("dashboard")}}" data-tab="dashboard" class="tab-btn flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100 active-tab">
                <svg class="w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ml-3">Tableau de bord</span>
              </a>
            </li>
            <li>
              <a href="{{route('admin.view.all.users')}}" data-tab="users" class="tab-btn flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                  <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="ml-3">Utilisateurs</span>
              </a>
            </li>
            <li>
              <a href="{{route("admin.view.trajets")}}" data-tab="trips" class="tab-btn flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                  <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 4a2 2 0 1 1 4 0v1H7V4Zm-.5 5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"/>
                </svg>
                <span class="ml-3">Trajets</span>
              </a>
            </li>
            <li>
              <a href="{{route('admin.view.reviews')}}" data-tab="reviews" class="tab-btn flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM13.5 6a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm-7 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm3.5 9.5A5.5 5.5 0 0 1 4.6 11h10.81A5.5 5.5 0 0 1 10 15.5Z"/>
                </svg>
                <span class="ml-3">Avis</span>
              </a>
            </li>
            <div class="mt-4">
                <form action="{{route("logout")}}" method="POST">
                    @csrf
                    <button name="logout"  class="w-full flex   py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Déconnexion
                    </button>
                </form>
               
            </div>
          </ul>
        </div>
      </aside>
      <div class="lg:pl-64">
        <div class="min-h-screen">
            <!-- Top Navigation -->
            <div class="hidden lg:block bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">@yield('header')</h1>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Page Content -->
            <main class="py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>