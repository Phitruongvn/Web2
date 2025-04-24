<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shop\HomeController as TrangchuController;
use App\Http\Controllers\shop\ProductController as SanPhamController;
use App\Http\Controllers\shop\ContactController as LienheController;
use App\Http\Controllers\admin\BannerController as AdminBannerController;
use App\Http\Controllers\admin\BrandController as AdminBrandController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\ContactController as AdminContactController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\UserController as AdminUserController;

use App\Http\Controllers\admin\TopicController as AdminTopicController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\MenuController as AdminMenuController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\shop\AuthController as ThanhVienController;
use App\Http\Controllers\shop\PostController as BaiVietController;
use App\Http\Controllers\shop\OrderController;
use App\Http\Controllers\shop\SearchController;

use App\Http\Controllers\shop\CartController;
use App\Http\Controllers\admin\HomeController;


Route::get('/', [TrangchuController::class, 'index'])->name('shop.home');
Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.product');
Route::get('/danh-muc', [SanPhamController::class, 'allCategories'])->name('shop.category.all');
Route::get('/bai-viet', [BaiVietController::class, 'index'])->name('shop.post');
Route::get('/bai-viet-moi', [BaiVietController::class, 'new'])->name('shop.post.new');
Route::get('/chi-tiet-bai-viet/{slug}', [BaiVietController::class, 'detail'])->name('shop.post.detail');
Route::get('/tim-kiem', [TrangchuController::class, 'search'])->name('shop.search');
Route::get('/danh-muc/{categorySlug}', [SanPhamController::class, 'productsByCategory'])->name('shop.product.category');
Route::get('chi-tiet-san-pham/{slug}', [SanphamController::class, 'detail'])->name('shop.product.detail');
Route::get('/lien-he', [LienheController::class, 'showContactForm'])->name('shop.contact');
Route::post('/lien-he', [LienheController::class, 'submitContactForm']);
Route::get('/dangnhap', [ThanhVienController::class, 'login'])->name('shop.login');
Route::post('/dangnhap', [ThanhVienController::class, 'dologin'])->name('shop.dologin');
Route::get('/dangki', [ThanhVienController::class, 'registration'])->name('shop.registration');
Route::post('/dangki', [ThanhVienController::class, 'doregistration'])->name('shop.doregistration');
Route::post('/dangxuat', [ThanhVienController::class, 'logout'])->name('shop.logout');
Route::get('/profile', [ThanhVienController::class, 'profile'])->name('shop.profile');
Route::post('/them-gio-hang/{id}', [CartController::class, 'addcart'])->name('shop.addcart');
Route::get('/gio-hang', [CartController::class, 'index'])->name('shop.cart');
Route::post('/cap-nhat-gio-hang', [CartController::class, 'updatecart'])->name('shop.updatecart');
Route::get('/xoa-san-pham/{id?}', [CartController::class, 'delcart'])->name('shop.delcart');
Route::get('/xoa-gio-hang', [CartController::class, 'clear'])->name('shop.clear');
Route::get('/thuong-hieu', [SanPhamController::class, 'allBrands'])->name('shop.brand.all');
Route::get('/thuong-hieu/{brandSlug}', [SanPhamController::class, 'productsByBrand'])->name('shop.product.brand');

Route::get('/thanks', [OrderController::class, 'thanks'])->name('shop.thanks');
Route::get('/thanh-toan', [OrderController::class, 'checkout'])->name('shop.checkout');
Route::post('/dat-hang', [OrderController::class, 'placeOrder'])->name('shop.placeorder');
Route::get('/don-hang', [OrderController::class, 'userOrders'])->name('shop.orders');
Route::get('/chi-tiet-don-hang/{id}', [OrderController::class, 'orderDetail'])->name('shop.order-detail');

// Admin routes that don't require authentication
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'dologin'])->name('admin.dologin');
    Route::get('/current-user', [AuthController::class, 'getCurrentUser'])->name('admin.current-user');
});

// Protected admin routes
Route::prefix('admin')->middleware('login-admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Product Routes
    Route::get('/san-pham', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/them-san-pham', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/them-san-pham', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::get('/sua-san-pham/{slug}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/sua-san-pham/{slug}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::get('/danh-sach-san-pham-da-xoa', [AdminProductController::class, 'trash'])->name('admin.product.trash');
    Route::get('/xoa-tam-san-pham/{id}', [AdminProductController::class, 'delete'])->name('admin.product.delete');
    Route::delete('/xoa-san-pham/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/khoi-phuc-san-pham/{id}', [AdminProductController::class, 'restore'])->name('admin.product.restore');
    Route::get('/san-pham/{product}', [AdminProductController::class, 'show'])->name('admin.product.show');
    Route::get('/trang-thai-san-pham/{product}', [AdminProductController::class, 'status'])->name('admin.product.status');

    // Brand Routes
    Route::get('/thuong-hieu', [AdminBrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/them-thuong-hieu', [AdminBrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/them-thuong-hieu', [AdminBrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/sua-thuong-hieu/{slug}', [AdminBrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/sua-thuong-hieu/{slug}', [AdminBrandController::class, 'update'])->name('admin.brand.update');
    Route::get('/danh-sach-thuong-hieu-da-xoa', [AdminBrandController::class, 'trash'])->name('admin.brand.trash');
    Route::get('/xoa-tam-thuong-hieu/{id}', [AdminBrandController::class, 'delete'])->name('admin.brand.delete');
    Route::delete('/xoa-thuong-hieu/{id}', [AdminBrandController::class, 'destroy'])->name('admin.brand.destroy');
    Route::get('/khoi-phuc-thuong-hieu/{id}', [AdminBrandController::class, 'restore'])->name('admin.brand.restore');
    Route::get('/thuong-hieu/{brand}', [AdminBrandController::class, 'show'])->name('admin.brand.show');
    Route::get('/trang-thai-thuong-hieu/{brand}', [AdminBrandController::class, 'status'])->name('admin.brand.status');

    // Banner Routes
    Route::get('/banner', [AdminBannerController::class, 'index'])->name('admin.banner.index');
    Route::get('/them-banner', [AdminBannerController::class, 'create'])->name('admin.banner.create');
    Route::post('/them-banner', [AdminBannerController::class, 'store'])->name('admin.banner.store');
    Route::get('/sua-banner/{id}', [AdminBannerController::class, 'edit'])->name('admin.banner.edit');
    Route::put('/sua-banner/{id}', [AdminBannerController::class, 'update'])->name('admin.banner.update');
    Route::get('/danh-sach-banner-da-xoa', [AdminBannerController::class, 'trash'])->name('admin.banner.trash');
    Route::get('/xoa-tam-banner/{id}', [AdminBannerController::class, 'delete'])->name('admin.banner.delete');
    Route::delete('/xoa-banner/{id}', [AdminBannerController::class, 'destroy'])->name('admin.banner.destroy');
    Route::get('/khoi-phuc-banner/{id}', [AdminBannerController::class, 'restore'])->name('admin.banner.restore');
    Route::get('/banner/{banner}', [AdminBannerController::class, 'show'])->name('admin.banner.show');
    Route::get('/trang-thai-banner/{banner}', [AdminBannerController::class, 'status'])->name('admin.banner.status');

    // Post Routes
    Route::get('/bai-viet', [AdminPostController::class, 'index'])->name('admin.post.index');
    Route::get('/them-bai-viet', [AdminPostController::class, 'create'])->name('admin.post.create');
    Route::post('/them-bai-viet', [AdminPostController::class, 'store'])->name('admin.post.store');
    Route::get('/sua-bai-viet/{slug}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
    Route::put('/sua-bai-viet/{slug}', [AdminPostController::class, 'update'])->name('admin.post.update');
    Route::get('/danh-sach-bai-viet-da-xoa', [AdminPostController::class, 'trash'])->name('admin.post.trash');
    Route::get('/xoa-tam-bai-viet/{id}', [AdminPostController::class, 'delete'])->name('admin.post.delete');
    Route::delete('/xoa-bai-viet/{id}', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
    Route::get('/khoi-phuc-bai-viet/{id}', [AdminPostController::class, 'restore'])->name('admin.post.restore');
    Route::get('/bai-viet/{post}', [AdminPostController::class, 'show'])->name('admin.post.show');
    Route::get('/trang-thai-bai-viet/{post}', [AdminPostController::class, 'status'])->name('admin.post.status');

    // Topic Routes
    Route::get('/chu-de', [AdminTopicController::class, 'index'])->name('admin.topic.index');
    Route::get('/them-chu-de', [AdminTopicController::class, 'create'])->name('admin.topic.create');
    Route::post('/them-chu-de', [AdminTopicController::class, 'store'])->name('admin.topic.store');
    Route::get('/sua-chu-de/{slug}', [AdminTopicController::class, 'edit'])->name('admin.topic.edit');
    Route::put('/sua-chu-de/{slug}', [AdminTopicController::class, 'update'])->name('admin.topic.update');
    Route::get('/danh-sach-chu-de-da-xoa', [AdminTopicController::class, 'trash'])->name('admin.topic.trash');
    Route::get('/xoa-tam-chu-de/{id}', [AdminTopicController::class, 'delete'])->name('admin.topic.delete');
    Route::delete('/xoa-chu-de/{id}', [AdminTopicController::class, 'destroy'])->name('admin.topic.destroy');
    Route::get('/khoi-phuc-chu-de/{id}', [AdminTopicController::class, 'restore'])->name('admin.topic.restore');
    Route::get('/chu-de/{topic}', [AdminTopicController::class, 'show'])->name('admin.topic.show');
    Route::get('/trang-thai-chu-de/{topic}', [AdminTopicController::class, 'status'])->name('admin.topic.status');

    // Order Routes
    Route::get('/don-hang', [AdminOrderController::class, 'index'])->name('admin.order.index');
    Route::get('/them-don-hang', [AdminOrderController::class, 'create'])->name('admin.order.create');
    Route::post('/them-don-hang', [AdminOrderController::class, 'store'])->name('admin.order.store');
    Route::get('/sua-don-hang/{id}', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
    Route::put('/sua-don-hang/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    Route::get('/danh-sach-don-hang-da-xoa', [AdminOrderController::class, 'trash'])->name('admin.order.trash');
    Route::get('/xoa-tam-don-hang/{id}', [AdminOrderController::class, 'delete'])->name('admin.order.delete');
    Route::delete('/xoa-don-hang/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('/khoi-phuc-don-hang/{id}', [AdminOrderController::class, 'restore'])->name('admin.order.restore');
    Route::get('/don-hang/{order}', [AdminOrderController::class, 'show'])->name('admin.order.show');
    Route::get('/trang-thai-don-hang/{order}', [AdminOrderController::class, 'status'])->name('admin.order.status');

    // User Routes
    Route::get('/nguoi-dung', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/them-nguoi-dung', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/them-nguoi-dung', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('/sua-nguoi-dung/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/sua-nguoi-dung/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::get('/danh-sach-nguoi-dung-da-xoa', [AdminUserController::class, 'trash'])->name('admin.user.trash');
    Route::get('/xoa-tam-nguoi-dung/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
    Route::delete('/xoa-nguoi-dung/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/khoi-phuc-nguoi-dung/{id}', [AdminUserController::class, 'restore'])->name('admin.user.restore');
    Route::get('/nguoi-dung/{user}', [AdminUserController::class, 'show'])->name('admin.user.show');
    Route::get('/trang-thai-nguoi-dung/{user}', [AdminUserController::class, 'status'])->name('admin.user.status');

    // Contact Routes
    Route::get('/lien-he', [AdminContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/them-lien-he', [AdminContactController::class, 'create'])->name('admin.contact.create');
    Route::post('/them-lien-he', [AdminContactController::class, 'store'])->name('admin.contact.store');
    Route::get('/sua-lien-he/{id}', [AdminContactController::class, 'edit'])->name('admin.contact.edit');
    Route::put('/sua-lien-he/{id}', [AdminContactController::class, 'update'])->name('admin.contact.update');
    Route::get('/danh-sach-lien-he-da-xoa', [AdminContactController::class, 'trash'])->name('admin.contact.trash');
    Route::get('/xoa-tam-lien-he/{id}', [AdminContactController::class, 'delete'])->name('admin.contact.delete');
    Route::delete('/xoa-lien-he/{id}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');
    Route::get('/khoi-phuc-lien-he/{id}', [AdminContactController::class, 'restore'])->name('admin.contact.restore');
    Route::get('/lien-he/{contact}', [AdminContactController::class, 'show'])->name('admin.contact.show');
    Route::get('/trang-thai-lien-he/{contact}', [AdminContactController::class, 'status'])->name('admin.contact.status');

    // Menu Routes with Vietnamese URLs
    Route::get('/menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/them-menu', [AdminMenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/them-menu', [AdminMenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/sua-menu/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/sua-menu/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
    Route::get('/danh-sach-menu-da-xoa', [AdminMenuController::class, 'trash'])->name('admin.menu.trash');
    Route::get('/xoa-tam-menu/{id}', [AdminMenuController::class, 'delete'])->name('admin.menu.delete');
    Route::delete('/xoa-menu/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::get('/khoi-phuc-menu/{id}', [AdminMenuController::class, 'restore'])->name('admin.menu.restore');
    Route::get('/menu/{menu}', [AdminMenuController::class, 'show'])->name('admin.menu.show');
    Route::get('/trang-thai-menu/{menu}', [AdminMenuController::class, 'status'])->name('admin.menu.status');

    Route::get('/danh-muc', [AdminCategoryController::class, 'index'])->name('admin.category.index');

    // Route cho tạo danh mục
    Route::get('/them-danh-muc', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/them-danh-muc', [AdminCategoryController::class, 'store'])->name('admin.category.store');

    // Route cho sửa danh mục
    Route::get('/sua-danh-muc/{slug}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/sua-danh-muc/{slug}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/danh-sach-danh-muc-da-xoa', [AdminCategoryController::class, 'trash'])->name('admin.category.trash');
    Route::get('/xoa-tam-danh-muc/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    // Route cho xóa danh mục
    Route::delete('/xoa-danh-muc/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('{category}/status', [AdminCategoryController::class, 'status'])->name('admin.category.status');
    Route::get('{category}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/khoi-phuc-danh-muc/{id}', [AdminCategoryController::class, 'restore'])->name('admin.category.restore');
});

Route::post('/store-user-session', [AuthController::class, 'storeUserSession'])->name('shop.store-user-session');
Route::post('/clear-user-session', [AuthController::class, 'clearUserSession'])->name('shop.clear-user-session');


