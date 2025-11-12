<?php

use App\Livewire\User\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Checkout\Payment;
use App\Livewire\Profile\Profile;
use App\Livewire\Auth\Register;
use App\Livewire\Cart\CartPage;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\OrderDetail;
use App\Livewire\Admin\Orders;
use App\Livewire\Address\AddAddress;
use App\Livewire\Address\EditAddress;
use App\Livewire\Profile\ProfileEdit;
use App\Livewire\Products\AddProduct;
use Illuminate\Support\Facades\Route;
use App\Livewire\Products\EditProduct;
use App\Livewire\Categories\Categories;
use App\Livewire\Products\ListProducts;
use App\Livewire\Shop\ListProductsUser;
use App\Livewire\Categories\AddCategory;
use App\Livewire\Products\DetailProduct;
use App\Livewire\Shop\DetailProductUser;
use App\Livewire\Categories\EditCategory;
use App\Livewire\Checkout\Checkout;
use App\Livewire\Transaction\Transactions;
use App\Livewire\Shop\Orders as OrdersUser;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/list/products', ListProducts::class)->name('products');
    Route::get('/add/product', AddProduct::class)->name('product.add');
    Route::get('/edit/product/{id}', EditProduct::class)->name('product.edit');
    Route::get('/detail/product/{id}', DetailProduct::class)->name('product.detail');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/add/category', AddCategory::class)->name('category.add');
    Route::get('/edit/category/{id}', EditCategory::class)->name('category.edit');
    Route::get('/orders', Orders::class)->name('list.orders');
    Route::get('/order/detail/{id}', OrderDetail::class)->name('order.detail');
    Route::get('/transactions', Transactions::class)->name('transactions');
});

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/shop', ListProductsUser::class)->name('shop');
    Route::get('/detail/product/{slug}', DetailProductUser::class)->name('user.product.detail');
    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('edit.profile');
    Route::get('/add/address', AddAddress::class)->name('add.address');
    Route::get('/edit/address/{id}', EditAddress::class)->name('edit.address');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/payment/{orderId}', Payment::class)->name('user.payment');
    Route::get('/orders', OrdersUser::class)->name('orders');
});
