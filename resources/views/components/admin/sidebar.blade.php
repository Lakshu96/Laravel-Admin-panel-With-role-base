<div class="bg-gray-800 text-white w-64 flex-shrink-0">
    <div class="flex items-center justify-center h-16 bg-gray-900">
        <h1 class="text-xl font-bold">Admin Panel</h1>
    </div>
    
    <nav class="mt-8">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white border-r-4 border-blue-500' : '' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        
        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white border-r-4 border-blue-500' : '' }}">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>
        
        <div class="border-t border-gray-700 mt-8 pt-4">
            <form method="POST" action="{{ route('logout') }}" class="px-6">
                @csrf
                <button type="submit" class="flex items-center w-full text-left text-gray-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</div>
