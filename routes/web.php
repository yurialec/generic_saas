<?php
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\LogoController;
use App\Http\Controllers\Site\MainTextController;
use App\Http\Controllers\Site\SiteAboutController;
use App\Http\Controllers\Site\SiteCarouselController;
use App\Http\Controllers\Site\SocialMediaController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Tenants\AuthTenantController;
use App\Http\Controllers\Tenants\FinanceController;
use App\Http\Controllers\Tenants\PatientController;
use App\Http\Controllers\Tenants\TenantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [SiteController::class, 'index'])->name('index.site');
Route::get('/sobre', [SiteController::class, 'about'])->name('about');
Route::get('/contato', [SiteController::class, 'contact'])->name('contact');
Route::get('/faca-parte', [SiteController::class, 'facaParte'])->name('faca-parte');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin/')->group(function () {
        //dont need acl
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('menus', [MenuController::class, 'menus'])->name('menus');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/profile-view', [UserController::class, 'profileView'])->name('profile.view');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');

        Route::middleware(['acl:manter-usuarios'])->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('users.index');
                Route::get('/list', [UserController::class, 'list'])->name('users.list');
                Route::get('/create', [UserController::class, 'create'])->name('users.create');
                Route::post('/store', [UserController::class, 'store'])->name('users.store');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
                Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
                Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
            });
        });

        Route::middleware(['acl:manter-perfis'])->group(callback: function () {
            Route::prefix('roles')->group(function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
                Route::get('/list', [RoleController::class, 'list'])->name('roles.list');
                Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
                Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
                Route::post('/update/{id}', [RoleController::class, 'update'])->name('roles.update');
                Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
                Route::get('/list-permissions', [RoleController::class, 'listPermissions'])->name('roles.list.permissions');
            });
        });

        Route::middleware(['acl:manter-permissoes'])->group(callback: function () {
            Route::prefix('permissions')->group(function () {
                Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
                Route::get('/list', [PermissionController::class, 'list'])->name('permissions.list');
                Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
                Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
                Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
                Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
                Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
            });
        });

        Route::middleware(['acl:manter-menus'])->group(callback: function () {
            Route::prefix('menu')->group(function () {
                Route::get('/', [MenuController::class, 'index'])->name('menu.index');
                Route::get('/list', [MenuController::class, 'list'])->name('menu.list');
                Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
                Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
                Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
                Route::post('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
                Route::delete('/delete/{id}', [MenuController::class, 'delete'])->name('menu.delete');
                Route::post('/change-order-menu/{id}', [MenuController::class, 'changeOrderMenu'])->name('menu.changeOrderMenu');
            });
        });

        Route::prefix('site/')->group(function () {
            Route::middleware(['acl:manter-logo'])->group(callback: function () {
                Route::prefix('logo')->group(function () {
                    Route::get('/', [LogoController::class, 'index'])->name('site.logo.index');
                    Route::get('/list', [LogoController::class, 'list'])->name('site.logo.list');
                    Route::get('/create', [LogoController::class, 'create'])->name('site.logo.create');
                    Route::post('/store', [LogoController::class, 'store'])->name('site.logo.store');
                    Route::get('/edit/{id}', [LogoController::class, 'edit'])->name('site.logo.edit');
                    Route::post('/update/{id}', [LogoController::class, 'update'])->name('site.logo.update');
                    Route::delete('/delete/{id}', [LogoController::class, 'delete'])->name('site.logo.delete');
                });
            });
            Route::middleware(['acl:manter-textoprincipal'])->group(callback: function () {
                Route::prefix('main-text')->group(function () {
                    Route::get('/', [MainTextController::class, 'index'])->name('site.maintext.index');
                    Route::get('/list', [MainTextController::class, 'list'])->name('site.maintext.list');
                    Route::get('/create', [MainTextController::class, 'create'])->name('site.maintext.create');
                    Route::post('/store', [MainTextController::class, 'store'])->name('site.maintext.store');
                    Route::get('/edit/{id}', [MainTextController::class, 'edit'])->name('site.maintext.edit');
                    Route::post('/update/{id}', [MainTextController::class, 'update'])->name('site.maintext.update');
                    Route::delete('/delete/{id}', [MainTextController::class, 'delete'])->name('site.maintext.delete');
                });
            });
            Route::middleware(['acl:manter-carousel'])->group(callback: function () {
                Route::prefix('carousel')->group(function () {
                    Route::get('/', [SiteCarouselController::class, 'index'])->name('site.carousel.index');
                    Route::get('/list', [SiteCarouselController::class, 'list'])->name('site.carousel.list');
                    Route::get('/create', [SiteCarouselController::class, 'create'])->name('site.carousel.create');
                    Route::post('/store', [SiteCarouselController::class, 'store'])->name('site.carousel.store');
                    Route::get('/edit/{id}', [SiteCarouselController::class, 'edit'])->name('site.carousel.edit');
                    Route::post('/update/{id}', [SiteCarouselController::class, 'update'])->name('site.carousel.update');
                    Route::delete('/delete/{id}', [SiteCarouselController::class, 'delete'])->name('site.carousel.delete');
                });
            });
            Route::middleware(['acl:manter-sobre'])->group(callback: function () {
                Route::prefix('site-about')->group(function () {
                    Route::get('/', [SiteAboutController::class, 'index'])->name('site.about.index');
                    Route::get('/list', [SiteAboutController::class, 'list'])->name('site.about.list');
                    Route::get('/create', [SiteAboutController::class, 'create'])->name('site.about.create');
                    Route::post('/store', [SiteAboutController::class, 'store'])->name('site.about.store');
                    Route::get('/edit/{id}', [SiteAboutController::class, 'edit'])->name('site.about.edit');
                    Route::post('/update/{id}', [SiteAboutController::class, 'update'])->name('site.about.update');
                    Route::delete('/delete/{id}', [SiteAboutController::class, 'delete'])->name('site.about.delete');
                });
            });
            Route::middleware(['acl:manter-contato'])->group(callback: function () {
                Route::prefix('contact')->group(function () {
                    Route::get('/', [ContactController::class, 'index'])->name('site.contact.index');
                    Route::get('/list', [ContactController::class, 'list'])->name('site.contact.list');
                    Route::get('/create', [ContactController::class, 'create'])->name('site.contact.create');
                    Route::post('/store', [ContactController::class, 'store'])->name('site.contact.store');
                    Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('site.contact.edit');
                    Route::post('/update/{id}', [ContactController::class, 'update'])->name('site.contact.update');
                    Route::delete('/delete/{id}', [ContactController::class, 'delete'])->name('site.contact.delete');
                });
            });
            Route::middleware(['acl:manter-redes'])->group(callback: function () {
                Route::prefix('social-media')->group(function () {
                    Route::get('/', [SocialMediaController::class, 'index'])->name('site.socialmedia.index');
                    Route::get('/list', [SocialMediaController::class, 'list'])->name('site.socialmedia.list');
                    Route::get('/create', [SocialMediaController::class, 'create'])->name('site.socialmedia.create');
                    Route::post('/store', [SocialMediaController::class, 'store'])->name('site.socialmedia.store');
                    Route::get('/edit/{id}', [SocialMediaController::class, 'edit'])->name('site.socialmedia.edit');
                    Route::post('/update/{id}', [SocialMediaController::class, 'update'])->name('site.socialmedia.update');
                    Route::delete('/delete/{id}', [SocialMediaController::class, 'delete'])->name('site.socialmedia.delete');
                });
            });
        });

        Route::middleware(['acl:manter-clientes'])->group(callback: function () {
            Route::prefix('clients')->group(function () {
                Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
                Route::get('/list', [ClientsController::class, 'list'])->name('clients.list');
                Route::get('/create', [ClientsController::class, 'create'])->name('clients.create');
                Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');
                Route::get('/edit/{id}', [ClientsController::class, 'edit'])->name('clients.edit');
                Route::get('/get-client-by-id/{id}', [ClientsController::class, 'getClientById'])->name('clients.getclientbyid');
                Route::put('/update/{id}', [ClientsController::class, 'update'])->name('clients.update');
                Route::delete('/delete/{id}', [ClientsController::class, 'delete'])->name('clients.delete');
            });
        });

        Route::prefix('financial/')->group(function () {
            Route::middleware(['acl:manter-planos'])->group(callback: function () {
                Route::prefix('plan')->group(function () {
                    Route::get('/', [PlanController::class, 'index'])->name('plan.index');
                    Route::get('/list', [PlanController::class, 'list'])->name('plan.list');
                    Route::get('/create', [PlanController::class, 'create'])->name('plan.create');
                    Route::post('/store', [PlanController::class, 'store'])->name('plan.store');
                    Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('plan.edit');
                    Route::get('/get-plan-by-id/{id}', [PlanController::class, 'getPlanById'])->name('clients.getplanbyid');
                    Route::put('/update/{id}', [PlanController::class, 'update'])->name('plan.update');
                    Route::delete('/delete/{id}', [PlanController::class, 'delete'])->name('plan.delete');
                });
            });

            Route::middleware(['acl:manter-inscricoes'])->group(callback: function () {
                Route::prefix('subscriptions')->group(function () {
                    Route::get('/', [SubscriptionsController::class, 'index'])->name('subscriptions.index');
                    Route::get('/list', [SubscriptionsController::class, 'list'])->name('subscriptions.list');
                    Route::get('/create', [SubscriptionsController::class, 'create'])->name('subscriptions.create');
                    Route::post('/store', [SubscriptionsController::class, 'store'])->name('subscriptions.store');
                    Route::get('/edit/{id}', [SubscriptionsController::class, 'edit'])->name('subscriptions.edit');
                    Route::post('/update/{id}', [SubscriptionsController::class, 'update'])->name('subscriptions.update');
                    Route::delete('/delete/{id}', [SubscriptionsController::class, 'delete'])->name('subscriptions.delete');
                });
            });

            Route::middleware(['acl:manter-pagamentos'])->group(callback: function () {
                Route::prefix('payments')->group(function () {
                    Route::get('/', [PaymentsController::class, 'index'])->name('payments.index');
                    Route::get('/list', [PaymentsController::class, 'list'])->name('payments.list');
                    Route::get('/create', [PaymentsController::class, 'create'])->name('payments.create');
                    Route::post('/store', [PaymentsController::class, 'store'])->name('payments.store');
                    Route::get('/edit/{id}', [PaymentsController::class, 'edit'])->name('payments.edit');
                    Route::post('/update/{id}', [PaymentsController::class, 'update'])->name('payments.update');
                    Route::delete('/delete/{id}', [PaymentsController::class, 'delete'])->name('payments.delete');
                });
            });
        });
    });
});

Route::get('/cep/{cep}', function ($cep) {
    $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
    return $response->json();
});

Route::prefix('{tenant}')->group(function () {

    Route::get('/', [AuthTenantController::class, 'showLoginForm'])->name('tenant.login.form');
    Route::post('/login', [AuthTenantController::class, 'login'])->name('tenant.login');

    Route::middleware(['AuthTenant'])->group(function () {
        Route::get('/get-menu', [TenantController::class, 'getMenu'])->name('tenant.getmenu');
        Route::get('/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
        Route::get('/profile', [TenantController::class, 'profile'])->name(name: 'tenant.profile');
        Route::get('/view-profile', [TenantController::class, 'viewProfile'])->name(name: 'tenant.viewProfile');

        Route::prefix('finance')->group(function () {
            Route::get('/', [FinanceController::class, 'index'])->name('tenant.finance.index');
            Route::get('/create', [FinanceController::class, 'create'])->name('tenant.finance.create');
        });

        Route::prefix('patients')->group(function () {
            Route::get('/', [PatientController::class, 'index'])->name('tenant.patient.index');
            Route::get('/list', [PatientController::class, 'list'])->name('tenant.patient.list');
            Route::get('/create', [PatientController::class, 'create'])->name('tenant.patient.create');
            Route::post('/store', [PatientController::class, 'store'])->name('tenant.patient.store');
            Route::post('/disable', [PatientController::class, 'disable'])->name('tenant.patient.disable');
            Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('tenant.patient.edit');
            Route::get('/get-patient-by-id/{id}', [PatientController::class, 'getPatientById'])->name('tenant.patient.getPatientById');
            Route::put('/update/{id}', [PatientController::class, 'update'])->name('tenant.patient.update');
        });

        Route::get('/reports', [TenantController::class, 'reports'])->name('tenant.reports');
        Route::get('/appointments', [TenantController::class, 'appointments'])->name('tenant.appointments');
        Route::get('/configuration', [TenantController::class, 'configuration'])->name('tenant.configuration');
        Route::get('/logout', [AuthTenantController::class, 'logout'])->name('tenant.logout');
    });
});

