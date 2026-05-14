@extends('layouts.admin')

@section('title', $truck->name)
@section('page-title', 'Truck details')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold text-gray-900">{{ $truck->name }}</h2>
            <div class="flex flex-wrap gap-2">
                @canAccess('trucks.edit')
                <a href="{{ route('admin.trucks.edit', $truck) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                @endcanAccess
                <a href="{{ route('admin.trucks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm">Back to list</a>
            </div>
        </div>

        <dl class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <dt class="text-sm font-medium text-gray-500">Units on truck</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->units_on_truck }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Cost of truck</dt>
                <dd class="mt-1 text-sm text-gray-900">${{ number_format($truck->cost_of_truck, 2) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Arrival date</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->arrival_date ? $truck->arrival_date : '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $truck->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($truck->status) }}
                    </span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Notes</dt>
                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $truck->notes ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Created by</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->creator?->name ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Last updated by</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->updater?->name ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Created at</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->created_at->format('M j, Y g:i A') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Updated at</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $truck->updated_at->format('M j, Y g:i A') }}</dd>
            </div>
        </dl>

        @canAccess('trucks.delete')
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <form action="{{ route('admin.trucks.destroy', $truck) }}" method="POST" onsubmit="return confirm('Delete this truck?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                    <i class="fas fa-trash mr-1"></i>Delete truck
                </button>
            </form>
        </div>
        @endcanAccess
    </div>
</div>
@endsection
