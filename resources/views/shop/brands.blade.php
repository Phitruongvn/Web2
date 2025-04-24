<x-layout-site>
<div class="container py-5">
    <h1 class="text-center mb-5">Tất cả thương hiệu</h1>
    
    <div class="row g-4">
        @foreach($brands as $brand)
        <div class="col-md-4">
            <div class="category-card">
                <a href="{{ route('shop.product.brand', ['brandSlug' => $brand->slug]) }}" 
                   class="category-link">
                    <div class="category-name">
                        {{ $brand->name }}
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.category-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.category-link {
    text-decoration: none;
    color: #333;
    display: block;
}

.category-name {
    padding: 20px;
    font-size: 1.2rem;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-name i {
    color: #007bff;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.category-card:hover .category-name i {
    opacity: 1;
    transform: translateX(0);
}

.category-card:hover .category-name {
    color: #007bff;
}
</style>
</x-layout-site> 