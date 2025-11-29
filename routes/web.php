<?php

use App\Livewire\User\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Admin\Orders;
use App\Livewire\Auth\Register;
use App\Livewire\Cart\CartPage;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Profile\Profile;
use App\Livewire\Checkout\Payment;
use App\Livewire\Admin\OrderDetail;
use App\Livewire\Shop\OrderDetail as OrderDetailUser;
use App\Livewire\Checkout\Checkout;
use App\Livewire\Address\AddAddress;
use App\Livewire\Address\EditAddress;
use App\Livewire\Auth\EmailVerificationNotice;
use App\Livewire\Products\AddProduct;
use App\Livewire\Profile\ProfileEdit;
use Illuminate\Support\Facades\Route;
use App\Livewire\Products\EditProduct;
use App\Livewire\Profile\ProfileAdmin;
use App\Livewire\Categories\Categories;
use App\Livewire\Products\ListProducts;
use App\Livewire\Shop\ListProductsUser;
use App\Livewire\Categories\AddCategory;
use App\Livewire\Products\DetailProduct;
use App\Livewire\Shop\DetailProductUser;
use App\Livewire\Categories\EditCategory;
use App\Livewire\Profile\ProfileAdminEdit;
use App\Livewire\Transaction\Transactions;
use App\Livewire\Shop\Orders as OrdersUser;
use App\Livewire\User\Services;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::get('/email/verify', EmailVerificationNotice::class)->name('verification.notice')->middleware('auth');
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {

    if (! URL::hasValidSignature($request)) {
        abort(403, 'Invalid or expired link');
    }

    $user = User::findOrFail($id);

    // Cek hash email
    if ($hash !== sha1($user->email)) {
        abort(403, 'Invalid verification');
    }

    // Update email_verified_at + status
    if ($user->email_verified_at === null) {
        $user->email_verified_at = now();
        $user->status = 'active';
        $user->save();
    }

    return redirect('/login')->with('verified', true);
})
->middleware('signed')
->name('verification.verify');


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
    Route::get('/profile', ProfileAdmin::class)->name('profile.admin');
    Route::get('/profile/edit', ProfileAdminEdit::class)->name('profile.admin.edit');
});

Route::get('/', Home::class)->name('home');

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/shop', ListProductsUser::class)->name('shop');
    Route::get('/services', Services::class)->name('services');
    Route::get('/detail/product/{slug}', DetailProductUser::class)->name('user.product.detail');
    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('edit.profile');
    Route::get('/add/address', AddAddress::class)->name('add.address');
    Route::get('/edit/address/{id}', EditAddress::class)->name('edit.address');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/payment/{orderId}', Payment::class)->name('user.payment');
    Route::get('/orders', OrdersUser::class)->name('orders');
    Route::get('/order/detail/{hashid}', OrderDetailUser::class)
    ->name('user.order.detail');
});
