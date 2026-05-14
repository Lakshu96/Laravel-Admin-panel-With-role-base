@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products (sample)')

@section('content')
<div class="space-y-6">
    <p class="text-gray-600">This listing demonstrates <code class="bg-gray-100 px-1 rounded">ProductPolicy</code> with permissions <code class="bg-gray-100 px-1 rounded">products.view</code>.</p>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                </tr>
                @empty
                <tr><td colspan="2" class="px-6 py-8 text-center text-gray-500">No products yet. Seed or create records in <code>products</code>.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($products->hasPages())
        <div class="px-6 py-4 border-t">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection
